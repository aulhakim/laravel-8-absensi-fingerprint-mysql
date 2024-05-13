<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Guru;
use App\Models\Orang_tua;
use App\Models\Murid;
use App\Models\User;
use App\Models\Kelas;
use Rats\Zkteco\Lib\ZKTeco;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Telegram\Bot\Api;


use App\Exports\AbsensiExport;
use Maatwebsite\Excel\Facades\Excel;

use DataTables;

class AbsensiController extends Controller
{

    protected $telegram;

    /**
     * Create a new controller instance.
     *
     * @param  Api  $telegram
     */
    public function __construct(Api $telegram)
    {
        $this->telegram = $telegram;
    }


    function index(Request $request) {

        
        // $response = $this->telegram->sendMessage([
        //     'chat_id' => env('chat_id'),
        //     'text' => 'Test'
        // ]);
        // $messageId = $response->getMessageId();


        $user = Auth::user();

        $guru = Guru::where('user_id',$user->id)->first();
        $murid = Murid::where('user_id',$user->id)->first();
        $ortu = Orang_tua::where('user_id',$user->id)->first();


        if ($request->ajax()) {


            $periode = $request->periode;
            if($periode != null) {
                $date = $periode;
            
                $parts = explode('-', $date);
                $dateCount = count($parts);
                if($dateCount == 1){

                    $startDate = Carbon::createFromFormat('d/m/Y', $date);
                    $startFormatted = $startDate->format('Y-m-d');

                    $endDate = Carbon::createFromFormat('d/m/Y', $date);
                    $endFormatted = $endDate->format('Y-m-d');

                    // $whereDate = "and scan_history.created_at between '$startFormatted 00:00:00' and '$endFormatted 23:59:59'";
                }else{

                    list($startDateString, $endDateString) = explode(' - ', $date);
                    $startDate = Carbon::createFromFormat('d/m/Y', $startDateString);
                    $startFormatted = $startDate->format('Y-m-d');
                    $endDate = Carbon::createFromFormat('d/m/Y', $endDateString);
                    $endFormatted = $endDate->format('Y-m-d');
                    // $whereDate = "and scan_history.created_at between '$startFormatted 00:00:00' and '$endFormatted 23:59:59'";

                }
            }else{
                $startDate = date('d/m/Y');
                $endDate = date('d/m/Y');
        
                $startDate = Carbon::createFromFormat('d/m/Y', $startDate);
                $startFormatted = $startDate->format('Y-m-d');
                $endDate = Carbon::createFromFormat('d/m/Y', $endDate);
                $endFormatted = $endDate->format('Y-m-d');
                // $whereDate = "and scan_history.created_at between '$startFormatted 00:00:00' and '$endFormatted 23:59:59'";
            }  



         

            $data = Absensi::select('attendance.*','t.full_name as siswa')
                        ->leftJoin('students as t','attendance.nis','t.nis')
                        ->orderBy('attendance.date','desc')->orderBy('attendance.hour','desc');
            if($user->user_type == 1){
                $data->where('t.class_id',$guru->class_id);
            }
            if($user->user_type == 2){
                $data->where('attendance.nis',$murid->nis);
            }
            if($user->user_type == 3){
                $data->where('t.parent_id',$ortu->id);
            }

            $data->whereBetween('attendance.date', [$startFormatted, $endFormatted]);

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('status_check', function($row){
                        if($row->status_check == 1){
                            return 'Masuk';
                        }elseif($row->status_check == 2){
                            return 'Pulang';
                        }elseif($row->status_check == 3){
                            return 'Dengan Keterangan';
                        }
                        return 'Tanpa Keterangan';
                    })
                    ->addColumn('status_attend', function($row){
                        if($row->status_attend == 1){
                            return 'Hadir';
                        }elseif($row->status_attend == 2){
                            return 'Izin';
                        }elseif($row->status_attend == 3){
                            return 'Sakit';
                        }
                        return 'Tanpa Keterangan';
                    })
                    ->addColumn('keterangan', function($row){
                        if($row->status_check == 3){
                            return $row->information;
                        }
                        return '-';
                    })
                    // ->addColumn('file', function($row){
                    //     return '<a href="javascript:void(0);" class="btn btn-sm btn-default"> <i class="fa fa-download"></i> Download</a>';
                            
                    // })
                    ->make(true);
        }


        return view('absensi.absensi');
        
    }

    function syncData() {
          $ipToCheck = env('IP_FP');
          $port = env('PORT_FP'); 
  
          $socket = @fsockopen($ipToCheck, $port, $errno, $errstr, 2);
  
          if (!$socket) {
           
                $data = [
                    'message'=>`IP address is not connected, IP : $ipToCheck , port : $port  `
                ];
            return json_encode($data);

          }


            $zk = new ZKTeco($ipToCheck,$port);
            if($zk){
                $zk->connect();  
                $attend = $zk->getAttendance();
                // $zk->clearAttendance(); 

                // $zk->disconnect();
                
                if (!empty($attend)) {
                    foreach ($attend as $attendanceRecord) {
                        $nis = $attendanceRecord['id'];
                        $timestamp = $attendanceRecord['timestamp'];
                        $type = $attendanceRecord['type'];

                        $newDate =  date("Y-m-d H:i:s", strtotime($timestamp));
                        $justDate =  date("Y-m-d", strtotime($timestamp));
                        $check = '0'; 
                        $attend = 0;
                        $status_check = "";

                        if ($newDate >= $justDate.' 00:00:00' && $newDate <= $justDate.' 11:59:59') {
                       
                            $recordCount = Absensi::where('status_check',1)->where('nis',$nis)->whereDate('date', date("Y-m-d", strtotime($timestamp)))->count();
                            if ($recordCount == 0) {
                                Absensi::create([
                                    'nis' => $nis,
                                    'status_check' => 1,
                                    'status_attend' => 1,
                                    'date' => $timestamp,
                                    'hour' => date("H:i:s", strtotime($timestamp)),
                                    'type' => $type,
                                ]);
                               
                            }
                            $status_check = "Masuk";
                            $status_attend = "Hadir";
                            
                        } elseif ($newDate >= $justDate.' 12:00:00' && $newDate <= $justDate.' 23:59:59') {
                          
                            $recordCount = Absensi::where('status_check',2)->where('nis',$nis)->whereDate('date', date("Y-m-d", strtotime($timestamp)))->count();
                            if ($recordCount == 0) {
                                Absensi::create([
                                    'nis' => $nis,
                                    'status_check' => 2,
                                    'status_attend' => 1,
                                    'date' => $timestamp,
                                    'hour' => date("H:i:s", strtotime($timestamp)),
                                    'type' => $type,
                                ]);

                             
                        
                            }

                            $status_check = "Pulang";
                            $status_attend = "Hadir";
                            
                        }

                        $murid = Murid::select('c.name as class','students.full_name','p.tele_id as tele_ortu','t.tele_id as tele_guru')
                        ->leftJoin('class as c','students.class_id','c.id')
                        ->leftJoin('parents as p','students.parent_id','p.id')
                        ->leftJoin('teachers as t','students.class_id','t.class_id')
                        ->where('nis',$nis)->first();
                        $tgl = date("Y-m-d H:i:s", strtotime($timestamp));
                        $attendanceInfo = "PRESENSI SDN PANCAWATi 02\n\nNAMA : $murid->full_name \nNIS: $nis \nKELAS : $murid->class \nTanggal: $tgl \nStatus: $status_check";


                        // $murid = Murid::select('c.name as class','students.full_name','p.tele_id as tele_ortu','t.tele_id as tele_guru')
                        //     ->leftJoin('class as c','students.class_id','c.id')
                        //     ->leftJoin('parents as p','students.parent_id','p.id')
                        //     ->leftJoin('teachers as t','students.class_id','t.class_id')
                        //     ->where('nis',$nis)->first();

                        // Check if $murid is null
                        // if ($murid) {
                        //     // Your existing code here
                        //     $tgl = date("Y-m-d H:i:s", strtotime($timestamp));
                        //     $attendanceInfo = "PRESENSI SDN PANCAWATi 02\n\nNAMA : $murid->full_name \nNIS: $nis \nKELAS : $murid->class \nTanggal: $tgl \nStatus: $status_check";
                        // } else {
                        //     // Handle the case where no record is found
                        //     echo "No record found for NIS: $nis";
                        // }


                        if($murid->tele_ortu != ''){
                            $response = $this->telegram->sendMessage([
                                'chat_id' => $murid->tele_ortu,
                                'text' => $attendanceInfo
                            ]);
                            $messageId = $response->getMessageId();
                        }

                        if($murid->tele_guru != ''){
                            $response = $this->telegram->sendMessage([
                                'chat_id' => $murid->tele_guru,
                                'text' => $attendanceInfo
                            ]);
                            $messageId = $response->getMessageId();
                        }
                       

                       
                                      
                    }
                }

                $zk->clearAttendance(); 

                $zk->disconnect();
              
            }



          $data = [
                'message'=>'IP address connected',
                'data'=>$attend,
          ];

        return json_encode($data);
  
        fclose($socket);

        info('This task ran at ' . now());
        
    }


    function kirimSurat(Request $request) {
        $user = Auth::user();

        $guru = Guru::where('user_id',$user->id)->first();
        $murid = Murid::where('user_id',$user->id)->first();
        $ortu = Orang_tua::where('user_id',$user->id)->first();

        if ($request->isMethod('post')) {
        
            $student_id = $request->student_id;
           
            $request->validate([
                'file_surat' => 'required|file|max:2048', 
            ]);

            if ($request->hasFile('file_surat')) {
                $file = $request->file('file_surat');
                $originalName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '_' . Str::slug(pathinfo($originalName, PATHINFO_FILENAME), '-') . '.' . $extension;
                // $file->storeAs('uploads', $filename); 
                $file->move(public_path('uploads'), $filename);
            }

            $murid = Murid::where('id',$student_id)->first();
            $recordCount = Absensi::where('status_check',3)->where('nis',$murid->nis)->whereDate('date', date('Y-m-d'))->count();


            if ($recordCount == 0) {
               $data = Absensi::create([
                    'nis' => $murid->nis,
                    'status_check' => 3,
                    'status_attend' => $request->alasan,
                    'date' => date("Y-m-d"),
                    'hour' => date("H:i:s"),
                    'type' => 0,
                    'file' => $filename,
                    'information' => $request->keterangan,
                ]);
               
            }
           
            return redirect('absensi')->with('success', 'File uploaded successfully.');
            
        } 

        $data = Murid::select('*');
        if($user->user_type == 1){
            $data->where('students.class_id',$guru->class_id);
        }
        if($user->user_type == 2){
            $data->where('students.nis',$murid->nis);
        }
        if($user->user_type == 3){
            $data->where('students.parent_id',$ortu->id);
        }

        $murid = $data->get();
      
        
        return view('absensi.form-surat',compact('murid'));
        
    }

    public function downloadAbsensi(Request $request) 
    {

        $periode = $request->periode;
        if($periode != null) {
            $date = $periode;
        
            $parts = explode('-', $date);
            $dateCount = count($parts);
            if($dateCount == 1){

                $startDate = Carbon::createFromFormat('d/m/Y', $date);
                $startFormatted = $startDate->format('Y-m-d');

                $endDate = Carbon::createFromFormat('d/m/Y', $date);
                $endFormatted = $endDate->format('Y-m-d');

            }else{

                list($startDateString, $endDateString) = explode(' - ', $date);
                $startDate = Carbon::createFromFormat('d/m/Y', $startDateString);
                $startFormatted = $startDate->format('Y-m-d');
                $endDate = Carbon::createFromFormat('d/m/Y', $endDateString);
                $endFormatted = $endDate->format('Y-m-d');

            }
        }else{
            $startDate = date('d/m/Y');
            $endDate = date('d/m/Y');
    
            $startDate = Carbon::createFromFormat('d/m/Y', $startDate);
            $startFormatted = $startDate->format('Y-m-d');
            $endDate = Carbon::createFromFormat('d/m/Y', $endDate);
            $endFormatted = $endDate->format('Y-m-d');
        }  



        $startDate = $startFormatted; 
        $endDate = $endFormatted; 
        return Excel::download(new AbsensiExport($startDate, $endDate), 'absensi-siswa.xlsx');
    }
}
