<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Rats\Zkteco\Lib\ZKTeco;
use App\Models\User;
use App\Models\Murid;
use App\Models\Absensi;
use App\Models\Guru;
use App\Models\Orang_tua;
use Carbon\Carbon; 
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
       
     

    }
    
    function index(){


        // $ipToCheck = env('IP_FP');
        // $port = env('PORT_FP'); 
        // $socket = @fsockopen($ipToCheck, $port, $errno, $errstr, 2);
       
        // if ($socket) {

        //     $zk = new ZKTeco($ipToCheck,$port);
        //     $date = date('Y-m-d H:i:s');
        //     $zk->setTime($date); 
        // }
             

        
        $user = Auth::user();

        $guru = Guru::where('user_id',$user->id)->first();
        $murid = Murid::where('user_id',$user->id)->first();
        $ortu = Orang_tua::where('user_id',$user->id)->first();


        $jmlsiswa = Murid::select('*');
        if($user->user_type == 1){
            $jmlsiswa->where('students.class_id',$guru->class_id);
        }
        if($user->user_type == 2){
            $jmlsiswa->where('students.nis',$murid->nis);
        }
        if($user->user_type == 3){
            $jmlsiswa->where('students.parent_id',$ortu->id);
        }
        $jml_siswa = $jmlsiswa->count();
                
        $today = Carbon::now()->format('Y-m-d'); 


        $alfaSql = Absensi::where('status_attend', 0)
        ->whereDate('date', $today)
        ->where('status_check',0);

        $hadirSql = Absensi::where('status_attend', 1)
            ->whereDate('date', $today)
            ->where('status_check',1);

       
        
        $izinSql = Absensi::where('status_attend', 2)
            ->whereDate('date', $today)
            ->where('status_check',3);
           
        $sakitSql = Absensi::where('status_attend', 3)
            ->whereDate('date', $today)
            ->where('status_check',3);


        if($user->user_type == 1){
            $alfaSql->leftJoin('students as s','attendance.nis','s.nis');
            $alfaSql->where('s.class_id',$guru->class_id);

            $hadirSql->leftJoin('students as s','attendance.nis','s.nis');
            $hadirSql->where('s.class_id',$guru->class_id);

            $izinSql->leftJoin('students as s','attendance.nis','s.nis');
            $izinSql->where('s.class_id',$guru->class_id);

            $sakitSql->leftJoin('students as s','attendance.nis','s.nis');
            $sakitSql->where('s.class_id',$guru->class_id);
        }
        if($user->user_type == 2){
            $alfaSql->leftJoin('students as s','attendance.nis','s.nis');
            $alfaSql->where('s.nis',$murid->nis);

            $hadirSql->leftJoin('students as s','attendance.nis','s.nis');
            $hadirSql->where('s.nis',$murid->nis);

            $izinSql->leftJoin('students as s','attendance.nis','s.nis');
            $izinSql->where('s.nis',$murid->nis);

            $sakitSql->leftJoin('students as s','attendance.nis','s.nis');
            $sakitSql->where('s.nis',$murid->nis);
        }
        if($user->user_type == 3){
            $alfaSql->leftJoin('students as s','attendance.nis','s.nis');
            $alfaSql->where('s.parent_id',$ortu->id);

            $hadirSql->leftJoin('students as s','attendance.nis','s.nis');
            $hadirSql->where('s.parent_id',$ortu->id);

            $izinSql->leftJoin('students as s','attendance.nis','s.nis');
            $izinSql->where('s.parent_id',$ortu->id);

            $sakitSql->leftJoin('students as s','attendance.nis','s.nis');
            $sakitSql->where('s.parent_id',$ortu->id);
        }

        $alfa = $alfaSql->count();
        $hadir = $hadirSql->count();
        $izin = $izinSql->count();
        $sakit = $sakitSql->count();

            $categories = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Aug','Sept','Oct','Nov','Dec']; 
            if($user->user_type == 1){
              $where = "AND students.class_id = $guru->class_id";
            }else if($user->user_type == 2){
                $where = "AND students.nis =  $murid->nis ";

            }else if($user->user_type == 3){
                $where = "AND students.parent_id = $ortu->id";
            }else{
                $where = "";
            }

            $newsql = "SELECT 
              COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 1  AND status_attend = '0' AND attendance.status_check = 0 THEN 1 ELSE 0 END), 0) AS alfa_bulan_1,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 2  AND status_attend = '0' AND attendance.status_check = 0 THEN 1 ELSE 0 END), 0) AS alfa_bulan_2,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 3  AND status_attend = '0' AND attendance.status_check = 0 THEN 1 ELSE 0 END), 0) AS alfa_bulan_3,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 4  AND status_attend = '0' AND attendance.status_check = 0 THEN 1 ELSE 0 END), 0) AS alfa_bulan_4,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 5  AND status_attend = '0' AND attendance.status_check = 0 THEN 1 ELSE 0 END), 0) AS alfa_bulan_5,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 6  AND status_attend = '0' AND attendance.status_check = 0 THEN 1 ELSE 0 END), 0) AS alfa_bulan_6,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 7  AND status_attend = '0' AND attendance.status_check = 0 THEN 1 ELSE 0 END), 0) AS alfa_bulan_7,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 8  AND status_attend = '0' AND attendance.status_check = 0 THEN 1 ELSE 0 END), 0) AS alfa_bulan_8,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 9  AND status_attend = '0' AND attendance.status_check = 0 THEN 1 ELSE 0 END), 0) AS alfa_bulan_9,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 10  AND status_attend = '0' AND attendance.status_check = 0 THEN 1 ELSE 0 END), 0) AS alfa_bulan_10,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 11  AND status_attend = '0' AND attendance.status_check = 0 THEN 1 ELSE 0 END), 0) AS alfa_bulan_11,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 12  AND status_attend = '0' AND attendance.status_check = 0 THEN 1 ELSE 0 END), 0) AS alfa_bulan_12,

            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 1  AND status_attend = '1' AND attendance.status_check = 1 THEN 1 ELSE 0 END), 0) AS hadir_bulan_1,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 2  AND status_attend = '1' AND attendance.status_check = 1 THEN 1 ELSE 0 END), 0) AS hadir_bulan_2,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 3  AND status_attend = '1' AND attendance.status_check = 1 THEN 1 ELSE 0 END), 0) AS hadir_bulan_3,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 4  AND status_attend = '1' AND attendance.status_check = 1 THEN 1 ELSE 0 END), 0) AS hadir_bulan_4,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 5  AND status_attend = '1' AND attendance.status_check = 1 THEN 1 ELSE 0 END), 0) AS hadir_bulan_5,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 6  AND status_attend = '1' AND attendance.status_check = 1 THEN 1 ELSE 0 END), 0) AS hadir_bulan_6,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 7  AND status_attend = '1' AND attendance.status_check = 1 THEN 1 ELSE 0 END), 0) AS hadir_bulan_7,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 8  AND status_attend = '1' AND attendance.status_check = 1 THEN 1 ELSE 0 END), 0) AS hadir_bulan_8,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 9  AND status_attend = '1' AND attendance.status_check = 1 THEN 1 ELSE 0 END), 0) AS hadir_bulan_9,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 10  AND status_attend = '1' AND attendance.status_check = 1 THEN 1 ELSE 0 END), 0) AS hadir_bulan_10,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 11  AND status_attend = '1' AND attendance.status_check = 1 THEN 1 ELSE 0 END), 0) AS hadir_bulan_11,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 12  AND status_attend = '1' AND attendance.status_check = 1 THEN 1 ELSE 0 END), 0) AS hadir_bulan_12,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 1  AND status_attend = '2' AND attendance.status_check = 3 THEN 1 ELSE 0 END), 0) AS izin_bulan_1,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 2  AND status_attend = '2' AND attendance.status_check = 3 THEN 1 ELSE 0 END), 0) AS izin_bulan_2,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 3  AND status_attend = '2' AND attendance.status_check = 3 THEN 1 ELSE 0 END), 0) AS izin_bulan_3,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 4  AND status_attend = '2' AND attendance.status_check = 3 THEN 1 ELSE 0 END), 0) AS izin_bulan_4,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 5  AND status_attend = '2' AND attendance.status_check = 3 THEN 1 ELSE 0 END), 0) AS izin_bulan_5,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 6  AND status_attend = '2' AND attendance.status_check = 3 THEN 1 ELSE 0 END), 0) AS izin_bulan_6,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 7  AND status_attend = '2' AND attendance.status_check = 3 THEN 1 ELSE 0 END), 0) AS izin_bulan_7,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 8  AND status_attend = '2' AND attendance.status_check = 3 THEN 1 ELSE 0 END), 0) AS izin_bulan_8,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 9  AND status_attend = '2' AND attendance.status_check = 3 THEN 1 ELSE 0 END), 0) AS izin_bulan_9,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 10  AND status_attend = '2' AND attendance.status_check = 3 THEN 1 ELSE 0 END), 0) AS izin_bulan_10,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 11  AND status_attend = '2' AND attendance.status_check = 3 THEN 1 ELSE 0 END), 0) AS izin_bulan_11,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 12  AND status_attend = '2' AND attendance.status_check = 3 THEN 1 ELSE 0 END), 0) AS izin_bulan_12,
             COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 1  AND status_attend = '2' AND attendance.status_check = 3 THEN 1 ELSE 0 END), 0) AS sakit_bulan_1,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 2  AND status_attend = '3' AND attendance.status_check = 3 THEN 1 ELSE 0 END), 0) AS sakit_bulan_2,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 3  AND status_attend = '3' AND attendance.status_check = 3 THEN 1 ELSE 0 END), 0) AS sakit_bulan_3,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 4  AND status_attend = '3' AND attendance.status_check = 3 THEN 1 ELSE 0 END), 0) AS sakit_bulan_4,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 5  AND status_attend = '3' AND attendance.status_check = 3 THEN 1 ELSE 0 END), 0) AS sakit_bulan_5,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 6  AND status_attend = '3' AND attendance.status_check = 3 THEN 1 ELSE 0 END), 0) AS sakit_bulan_6,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 7  AND status_attend = '3' AND attendance.status_check = 3 THEN 1 ELSE 0 END), 0) AS sakit_bulan_7,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 8  AND status_attend = '3' AND attendance.status_check = 3 THEN 1 ELSE 0 END), 0) AS sakit_bulan_8,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 9  AND status_attend = '3' AND attendance.status_check = 3 THEN 1 ELSE 0 END), 0) AS sakit_bulan_9,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 10  AND status_attend = '3' AND attendance.status_check = 3 THEN 1 ELSE 0 END), 0) AS sakit_bulan_10,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 11  AND status_attend = '3' AND attendance.status_check = 3 THEN 1 ELSE 0 END), 0) AS sakit_bulan_11,
            COALESCE(SUM(CASE WHEN MONTH(attendance.date) = 12  AND status_attend = '3' AND attendance.status_check = 3 THEN 1 ELSE 0 END), 0) AS sakit_bulan_12
          FROM attendance 
          LEFT JOIN students ON attendance.nis = students.nis 
            where YEAR(attendance.date) = YEAR(CURRENT_DATE)  $where
            ";

        $qrcodeDataProduct = DB::select(DB::raw($newsql));
        $seriess = [];
        foreach ($qrcodeDataProduct as $row) {
            $seriess[] = [
                'name' => 'Hadir',
                'type' => 'line',
                'data' => [$row->hadir_bulan_1,$row->hadir_bulan_2,$row->hadir_bulan_3,$row->hadir_bulan_4,$row->hadir_bulan_5,$row->hadir_bulan_6,$row->hadir_bulan_7,$row->hadir_bulan_8,$row->hadir_bulan_9,$row->hadir_bulan_10,$row->hadir_bulan_11,$row->hadir_bulan_12],
            ];
            $seriess[] = [
                'name' => 'Izin',
                'type' => 'line',
                'data' => [$row->izin_bulan_1,$row->izin_bulan_2,$row->izin_bulan_3,$row->izin_bulan_4,$row->izin_bulan_5,$row->izin_bulan_6,$row->izin_bulan_7,$row->izin_bulan_8,$row->izin_bulan_9,$row->izin_bulan_10,$row->izin_bulan_11,$row->izin_bulan_12],
            ];
            $seriess[] = [
                'name' => 'Sakit',
                'type' => 'line',
                'data' => [$row->sakit_bulan_1,$row->sakit_bulan_2,$row->sakit_bulan_3,$row->sakit_bulan_4,$row->sakit_bulan_5,$row->sakit_bulan_6,$row->sakit_bulan_7,$row->sakit_bulan_8,$row->sakit_bulan_9,$row->sakit_bulan_10,$row->sakit_bulan_11,$row->sakit_bulan_12],
            ];
            $seriess[] = [
                'name' => 'Tidak Hadir',
                'type' => 'line',
                'data' => [$row->alfa_bulan_1,$row->alfa_bulan_2,$row->alfa_bulan_3,$row->alfa_bulan_4,$row->alfa_bulan_5,$row->alfa_bulan_6,$row->alfa_bulan_7,$row->alfa_bulan_8,$row->alfa_bulan_9,$row->alfa_bulan_10,$row->alfa_bulan_11,$row->alfa_bulan_12],
            ];
        }
    
        $series = $seriess;


        return view('dashboard.dashboard',compact('jml_siswa','hadir','izin','sakit','alfa','categories','series'));
    }

    public function createUserForm()
    {
        return view('dashboard.create-user');
    }

    public function storeUser(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            // Add validation rules for fingerprint data
        ]);

        $zk = new ZKTeco('192.168.1.10', 4370); // Replace with your device's IP and port

        if ($zk->connect()) {
            // // Connected successfully
            // // Capture fingerprint data (replace with appropriate method)
            // $fingerprintData = $zk->captureFingerprint();
            
            // $zk->disconnect(); // Disconnect after use

            // // Create a new user in the database
            // $user = new User();
            // $user->name = $request->input('name');
            // $user->fingerprint_data = $fingerprintData; // Store fingerprint data
            // $user->save();

            // return redirect()->route('create-user')->with('success', 'User created and fingerprint data stored');


            // $enrollmentData = [

            //     'uid' => 54,
            //      'userid' => '0987766',
            //      'name' => 'maman',
            //       'password' => '', 
            //       'role' =>  0,
            //        'cardno' =>  0

            //     // 'fingerprint_data' => [$fingerprintData], // Fingerprint data
            // ];

            $uid = 123; // Unique ID (max 65535)
            $userid = '456'; // ID in DB (max length = 9, only numbers - depends on device setting)
            $name = 'John Doe'; // User name (max length = 24)
            $password = '78901234'; // User password (max length = 8, only numbers - depends on device setting)
            $role = 0; // Default user role, replace Util::LEVEL_USER with the actual constant value
            $cardno = 0; // Default card number (max length = 10, only numbers)
            $result = $zk->setUser($uid, $userid, $name, $password, $role, $cardno);

            // Enroll the user
            // $enrollResult = $zk->setUser($enrollmentData);
            $zk->disconnect();
         
        } else {
            return redirect()->route('create-user')->with('error', 'Could not connect to the device');
        }
    }
}
