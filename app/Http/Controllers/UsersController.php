<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\Murid;
use App\Models\Orang_tua;
use Illuminate\Support\Facades\Hash;
use Rats\Zkteco\Lib\ZKTeco;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


use DataTables;

class UsersController extends Controller
{
    function guru(Request $request) {

        $user = Auth::user();
         if($user->user_type == 1){
            return redirect()->route('home');
        }
        

        if ($request->ajax()) {
            $data = User::select('users.id','users.name','users.email','users.phone_number','t.born','t.date_birth','t.gender','t.religion_id','t.address','t.class_id','t.subject','c.name as class')
                            ->leftJoin('teachers as t','users.id','t.user_id')
                            ->leftJoin('class as c','t.class_id','c.id')
                            ->where('users.user_type',1);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn = '<a href="'.url('user/guru/view/'.$row->id).'" class="edit btn btn-success btn-sm pe-2">View</a> <a href="'.url('user/guru/edit/'.$row->id).'" class="edit btn btn-primary btn-sm pe-2">Edit</a> <a href="javascript:void(0)" onClick="deleteData('.$row->id.')" class="edit btn btn-danger btn-sm ps-2">Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('user.guru');
        
    }
    function addGuru(Request $request) {
        $kelas = Kelas::all();
        $user = "";
        return view('user.guru-form',compact('kelas','user'));
    }
    public function editGuru($id)
    {
        
        $user = Auth::user();

        if($user->user_type != 0){
            if($user->id != $id){
                return redirect()->route('home');
            }
        }

        $user = User::select('users.id','users.name','users.email','users.phone_number','t.born','t.date_birth','t.gender','t.religion_id','t.address','t.class_id','t.subject','t.tele_id')
                        ->leftJoin('teachers as t','users.id','t.user_id')
                        ->where('users.id',$id)->first();
        $kelas = Kelas::all();
        return view('user.guru-form', compact('kelas','user'));
    }

    
    public function storeGuru(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
            'born' => 'required',
            'date_birth' => 'required',
            'gender' => 'required',
            'religion_id' => 'required',
            'address' => 'required',
            'class_id' => 'required',
            // 'subject' => 'required',
        ]);

        if($request->id != null){
            if ($request->password != null) {
                if ($request->password == $request->confirm_password) {
                    User::where('id', $request->id)->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone_number' => $request->phone_number,
                        'password' => Hash::make($request->password),
                    ]);
                    Guru::where('user_id', $request->id)->update([
                        'full_name' => $request->name,
                        'born' => $request->born,
                        'date_birth' => $request->date_birth,
                        'gender' => $request->gender,
                        'religion_id' => $request->religion_id,
                        'address' => $request->address,
                        'class_id' => $request->class_id,
                        'tele_id' => $request->tele_id,
                        // 'subject' => $request->subject,
                    ]);
                    return redirect()->route('user.guru');

                }else{
                    return redirect()->back()
                    ->withInput($request->only('password', 'confirm_password'))
                    ->withErrors(['password' => 'Your passwords do not match']);
                }
            }
            User::where('id', $request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number
            ]);
            Guru::where('user_id', $request->id)->update([
                'full_name' => $request->name,
                'born' => $request->born,
                'date_birth' => $request->date_birth,
                'gender' => $request->gender,
                'religion_id' => $request->religion_id,
                'address' => $request->address,
                'class_id' => $request->class_id,
                // 'subject' => $request->subject,
                'tele_id' => $request->tele_id,

            ]);
            return redirect()->route('user.guru');

        }else{
            if ($request->password == $request->confirm_password) {
                $user =  User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'user_type' => 1,
                    'phone_number' => $request->phone_number,
                    'password' => Hash::make($request->password),
                ]);
                $lastInsertedId = $user->id;
                Guru::create([
                    'full_name' => $request->name,
                    'user_id' => $lastInsertedId,
                    'born' => $request->born,
                    'date_birth' => $request->date_birth,
                    'gender' => $request->gender,
                    'religion_id' => $request->religion_id,
                    'address' => $request->address,
                    'class_id' => $request->class_id,
                    'subject' => $request->subject,
                ]);
                return redirect()->route('user.guru');
            }
            return redirect()->back()
                ->withInput($request->only('password', 'confirm_password'))
                ->withErrors(['password' => 'Your passwords do not match']);
        }
    }
    public function deleteGuru($id)
    {
        $user = User::where('id',$id)->delete();
        $guru = Guru::where('user_id',$id)->delete();
    }


    // murid 

    function murid(Request $request) {

        // $ipToCheck = env('IP_FP');
        //     $port = env('PORT_FP'); 
        //     $socket = @fsockopen($ipToCheck, $port, $errno, $errstr, 2);
           
        //     if ($socket) {

        //         $zk = new ZKTeco($ipToCheck,$port);
        //         if($zk){
        //             $zk->connect();  

        //             // $uid = 1;
        //             // $dd = $zk->clearUsers(); 
        //             $carbonDate = Carbon::now(); // Replace with your Carbon instance
        //             $formattedDateTime = $carbonDate->format('Y-m-d H:i:s');

        //             $zk->setTime(date('Y-m-d H:i:s'));

        //             $time = $zk->getTime(); 

        //             $zk->disconnect();

        //             dd($time);

                  
        //         }
        //     }

        $user = Auth::user();
        if($user->user_type == 2){
           return redirect()->route('home');
       }
       

        $guru = Guru::where('user_id',$user->id)->first();
        $murid = Murid::where('user_id',$user->id)->first();
        $ortu = Orang_tua::where('user_id',$user->id)->first();


        if ($request->ajax()) {


            $data =  User::select('users.id','users.name','users.email','users.phone_number','s.born','s.date_birth','s.gender','s.religion_id','s.address','s.class_id','s.nis','s.isconnect','c.name as class','up.phone_number as number_ortu')
            ->leftJoin('students as s','users.id','s.user_id')
            ->leftJoin('class as c','s.class_id','c.id')
            ->leftJoin('parents as p','s.parent_id','p.id')
            ->leftJoin('users as up','p.user_id','up.id')
            ->where('users.user_type',2)
            ->orderBY('users.id','DESC');

            if($user->user_type == 1){
                $data->where('s.class_id',$guru->class_id);
            }
            if($user->user_type == 2){
                $data->where('s.nis',$murid->nis);
            }
            if($user->user_type == 3){
                $data->where('s.parent_id',$ortu->id);
            }


            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('isconnect', function($row){
                        if($row->isconnect == 1){
                            return 'Connected';
                        }
                        return 'Not Connected';

                        
                    })
                    ->addColumn('action', function($row){
                        $user = Auth::user();
                        $btn = '';
                        if($user->user_type == 0 || $user->user_type == 1){
                            $btn .= '<a href="'.url('user/murid/edit/'.$row->id).'" class="edit btn btn-primary btn-sm pe-2">Edit</a> <a href="javascript:void(0)" onClick="deleteData('.$row->id.')" class="edit btn btn-danger btn-sm ps-2">Delete</a>';
                        }else{
                            $btn .= '<a href="'.url('user/murid/edit/'.$row->id).'" class="edit btn btn-primary btn-sm pe-2">Lihat</a>';
                        }
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('user.murid');
        
    }
    function addMurid(Request $request) {
        $kelas = Kelas::all();
        $parent = Orang_tua::all();
        $user = "";
        return view('user.murid-form',compact('kelas','user','parent'));
    }
    public function editMurid($id)
    {
        $user = Auth::user();

        if($user->user_type != 0 && $user->user_type != 1 && $user->user_type != 3 ){
            if($user->id != $id){
                return redirect()->route('home');
            }
        }
       

        $user = User::select('users.id','users.name','users.email','users.phone_number','t.born','t.date_birth','t.gender','t.religion_id','t.parent_id','t.address','t.class_id','t.nis')
                        ->leftJoin('students as t','users.id','t.user_id')
                        ->where('users.id',$id)->first();
        $parent = Orang_tua::all();
        $kelas = Kelas::all();
        return view('user.murid-form', compact('kelas','user','parent'));
    }

    
    public function storeMurid(Request $request)
    {
        $request->validate([
            'name' => 'required',
            // 'email' => 'required|email',
            // 'phone_number' => 'required',
            'born' => 'required',
            'date_birth' => 'required',
            'gender' => 'required',
            'religion_id' => 'required',
            'parent_id' => 'required',
            'address' => 'required',
            'class_id' => 'required',
            'nis' => 'required',
        ]);

        if($request->id != null){
            // if ($request->password != null) {
            //     if ($request->password == $request->confirm_password) {
            //         User::where('id', $request->id)->update([
            //             'name' => $request->name,
            //             'email' => $request->email,
            //             'phone_number' => $request->phone_number,
            //             'password' => Hash::make($request->password),
            //         ]);
            //         Murid::where('user_id', $request->id)->update([
            //             'full_name' => $request->name,
            //             'born' => $request->born,
            //             'date_birth' => $request->date_birth,
            //             'gender' => $request->gender,
            //             'religion_id' => $request->religion_id,
            //             'parent_id' => $request->parent_id,
            //             'address' => $request->address,
            //             'class_id' => $request->class_id,
            //             'nis' => $request->nis,
            //         ]);
            //         return redirect()->route('user.murid');

            //     }else{
            //         return redirect()->back()
            //         ->withInput($request->only('password', 'confirm_password'))
            //         ->withErrors(['password' => 'Your passwords do not match']);
            //     }
            // }
            User::where('id', $request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number
            ]);
            murid::where('user_id', $request->id)->update([
                'full_name' => $request->name,
                'born' => $request->born,
                'date_birth' => $request->date_birth,
                'gender' => $request->gender,
                'religion_id' => $request->religion_id,
                'parent_id' => $request->parent_id,
                'address' => $request->address,
                'class_id' => $request->class_id,
                'nis' => $request->nis,
            ]);

            $ipToCheck = env('IP_FP');
            $port = env('PORT_FP'); 
            $socket = @fsockopen($ipToCheck, $port, $errno, $errstr, 2);
           
            if ($socket) {

                $zk = new ZKTeco($ipToCheck,$port);
               
                if($zk){
                    $zk->connect();  
                     $zk->removeUser($request->id);
                     
                     $uid =  $request->id; 
                     $userid = $request->nis; 
                     $name = $request->name; 
                     $password = null; 
                     $role = 0;
                     $cardno = 0; 
                     $result = $zk->setUser($uid, $userid, $name, $password, $role, $cardno);

                    $zk->disconnect();

                    murid::where('user_id',  $request->id)->update([
                        'isconnect' => 1,
                    ]);
                }
            }
           

            return redirect()->route('user.murid');

        }else{


            // if ($request->password == $request->confirm_password) {


                $user =  User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'user_type' => 2,
                    'phone_number' => $request->phone_number,
                    'password' => Hash::make($request->password),
                ]);
                $lastInsertedId = $user->id;
                Murid::create([
                    'full_name' => $request->name,
                    'user_id' => $lastInsertedId,
                    'born' => $request->born,
                    'date_birth' => $request->date_birth,
                    'gender' => $request->gender,
                    'religion_id' => $request->religion_id,
                    'address' => $request->address,
                    'class_id' => $request->class_id,
                    'nis' => $request->nis,
                ]);


                $ipToCheck = env('IP_FP');
                $port = env('PORT_FP'); 
                $socket = @fsockopen($ipToCheck, $port, $errno, $errstr, 2);
                if (!$socket) {
                    $isconnect = 0;
                }else{
                    $zk = new ZKTeco($ipToCheck,$port);
                    if($zk){
                        $zk->connect();  
                           $uid = $lastInsertedId; // Unique ID (max 65535)
                           $userid = $request->nis; // ID in DB (max length = 9, only numbers - depends on device setting)
                           $name = $request->name; // User name (max length = 24)
                           $password = null; // User password (max length = 8, only numbers - depends on device setting)
                           $role = 0; // Default user role, replace Util::LEVEL_USER with the actual constant value
                           $cardno = 0; // Default card number (max length = 10, only numbers)
                           $result = $zk->setUser($uid, $userid, $name, $password, $role, $cardno);
                        $zk->disconnect();
                    }
                    $isconnect = 1;
                }

                murid::where('user_id', $lastInsertedId)->update([
                    'isconnect' => $isconnect,
                ]);
                
                return redirect()->route('user.murid');
            // }
            // return redirect()->back()
            //     ->withInput($request->only('password', 'confirm_password'))
            //     ->withErrors(['password' => 'Your passwords do not match']);
        }
    }
    public function deleteMurid($id)
    {
        $user = User::where('id',$id)->delete();
        $murid = Murid::where('user_id',$id)->delete();

        $ipToCheck = env('IP_FP');
        $port = env('PORT_FP'); 
        $socket = @fsockopen($ipToCheck, $port, $errno, $errstr, 2);
       
        if ($socket) {

            $zk = new ZKTeco($ipToCheck,$port);
            if($zk){
                $zk->connect();  
                 $zk->removeUser($id);
                $zk->disconnect();

            }
        }


    }



    // Orang Tua 
    function orangTua(Request $request) {

        $user = Auth::user();

        if($user->user_type == 3){
           return redirect()->route('home');

       }

        if ($request->ajax()) {
            $data = User::select('users.id','users.name','users.email','users.phone_number','t.born','t.date_birth','t.gender','t.religion_id','t.address')
                    ->leftJoin('parents as t','users.id','t.user_id')->where('user_type',3);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn = '<a href="'.url('user/orang-tua/edit/'.$row->id).'" class="edit btn btn-primary btn-sm pe-2">Edit</a> <a href="javascript:void(0)" onClick="deleteData('.$row->id.')" class="edit btn btn-danger btn-sm ps-2">Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('user.orang-tua');
        
    }
    function addOrangTua(Request $request) {
       
        $user = "";
        return view('user.orang-tua-form',compact('user'));
    }
    public function editOrangTua($id)
    {

        $user = Auth::user();

        if($user->user_type != 0 && $user->user_type != 1){
            if($user->id != $id){
                return redirect()->route('home');
            }
        }
        $user = User::select('users.id','users.name','users.email','users.phone_number','t.born','t.date_birth','t.gender','t.religion_id','t.address','t.tele_id')
                        ->leftJoin('parents as t','users.id','t.user_id')
                        ->where('users.id',$id)->first();
      
        return view('user.orang-tua-form', compact('user'));
    }

    
    public function storeOrangTua(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
            'born' => 'required',
            'date_birth' => 'required',
            'gender' => 'required',
            'religion_id' => 'required',
            'address' => 'required',
        ]);

        if($request->id != null){
            if ($request->password != null) {
                if ($request->password == $request->confirm_password) {
                    User::where('id', $request->id)->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone_number' => $request->phone_number,
                        'password' => Hash::make($request->password),
                    ]);
                    Orang_tua::where('user_id', $request->id)->update([
                        'full_name' => $request->name,
                        'born' => $request->born,
                        'date_birth' => $request->date_birth,
                        'gender' => $request->gender,
                        'religion_id' => $request->religion_id,
                        'address' => $request->address,
                        'tele_id' => $request->tele_id,
                    ]);
                    return redirect()->route('user.orangtua');

                }else{
                    return redirect()->back()
                    ->withInput($request->only('password', 'confirm_password'))
                    ->withErrors(['password' => 'Your passwords do not match']);
                }
            }
            User::where('id', $request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number
            ]);
            Orang_tua::where('user_id', $request->id)->update([
                'full_name' => $request->name,
                'born' => $request->born,
                'date_birth' => $request->date_birth,
                'gender' => $request->gender,
                'religion_id' => $request->religion_id,
                'address' => $request->address,
                'tele_id' => $request->tele_id,
            ]);
            return redirect()->route('user.orangtua');

        }else{
            if ($request->password == $request->confirm_password) {
                $user =  User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'user_type' => 3,
                    'phone_number' => $request->phone_number,
                    'password' => Hash::make($request->password),
                ]);
                $lastInsertedId = $user->id;
                Orang_tua::create([
                    'full_name' => $request->name,
                    'user_id' => $lastInsertedId,
                    'born' => $request->born,
                    'date_birth' => $request->date_birth,
                    'gender' => $request->gender,
                    'religion_id' => $request->religion_id,
                    'address' => $request->address,
                    'tele_id' => $request->tele_id,
                ]);
                return redirect()->route('user.orangtua');
            }
            return redirect()->back()
                ->withInput($request->only('password', 'confirm_password'))
                ->withErrors(['password' => 'Your passwords do not match']);
        }
    }
    public function deleteOrangTua($id)
    {
        $user = User::where('id',$id)->delete();
        $orang_tua = Orang_tua::where('user_id',$id)->delete();
    }

}
