<?php

namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\User;
use App\Models\Guru;
use App\Models\Orang_tua;
use App\Models\Murid;
use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;

class AbsensiExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        // return Absensi::all();
        $user = Auth::user();

        $guru = Guru::where('user_id',$user->id)->first();
        $murid = Murid::where('user_id',$user->id)->first();
        $ortu = Orang_tua::where('user_id',$user->id)->first();


        $data = Absensi::select('attendance.nis',
        't.full_name as siswa',
        \DB::raw('CASE
                    WHEN attendance.status_check = 1 THEN "Masuk"
                    WHEN attendance.status_check = 2 THEN "Pulang"
                    WHEN attendance.status_check = 3 THEN "Dengan Keterangan"
                    ELSE "Tanpa Keterangan"
                END as status_description'
        ),
        \DB::raw('CASE
                    WHEN attendance.status_attend = 1 THEN "Hadir"
                    WHEN attendance.status_attend = 2 THEN "Izin"
                    WHEN attendance.status_attend = 3 THEN "Sakit"
                    ELSE "Tanpa Keterangan"
                END as status_attend'),
        'attendance.date',
        'attendance.hour',
    )
          
        
        ->leftJoin('students as t','attendance.nis','t.nis')
        ->orderBy('attendance.date','desc')
        ->orderBy('attendance.hour','desc');
            if($user->user_type == 1){
            $data->where('t.class_id',$guru->class_id);
            }
            if($user->user_type == 2){
            $data->where('attendance.nis',$murid->nis);
            }
            if($user->user_type == 3){
            $data->where('t.parent_id',$ortu->id);
            }
            if ($this->startDate && $this->endDate) {
                $data->whereBetween('attendance.date', [$this->startDate, $this->endDate]);
            }
        return $data->get();

    }
}
