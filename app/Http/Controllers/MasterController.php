<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use DataTables;


class MasterController extends Controller
{
    // function kelas(Request $request) {
    //     if ($request->ajax()) {
    //         $data = Kelas::select('*');
    //         return Datatables::of($data)
    //                 ->addIndexColumn()
    //                 ->addColumn('action', function($row){
     
    //                        $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
    
    //                         return $btn;
    //                 })
    //                 ->rawColumns(['action'])
    //                 ->make(true);
    //     }
    //     return view('master.kelas');
        
    // }


       // Kelas
       function kelas(Request $request) {
        if ($request->ajax()) {
            $data = Kelas::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn = '<a href="'.url('user/kelas/edit/'.$row->id).'" class="edit btn btn-primary btn-sm pe-2">Edit</a> <a href="javascript:void(0)" onClick="deleteData('.$row->id.')" class="edit btn btn-danger btn-sm ps-2">Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('master.kelas');
        
    }
    function addKelas(Request $request) {
       
        $user = "";
        return view('master.kelas-form',compact('user'));
    }
    public function editKelas($id)
    {
        $user = Kelas::select('*')->where('id',$id)->first();
        return view('master.kelas-form', compact('user'));
    }

    
    public function storeKelas(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        if($request->id != null){
           
            Kelas::where('id', $request->id)->update([
                'name' => $request->name,
            ]);
          
            return redirect()->route('master.kelas');

        }else{
            Kelas::create([
                'name' => $request->name,
            ]);
            return redirect()->route('master.kelas');
           
        }
    }
    public function deleteKelas($id)
    {
         Kelas::where('id',$id)->delete();
    }



    function agama() {

        return view('master.agama');
        
    }
}
