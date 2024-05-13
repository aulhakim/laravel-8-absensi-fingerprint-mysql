<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    protected $table = "attendance";

    protected $fillable = [
        'nis',   
        'date',   
        'hour',   
        'creted_at',   
        'updated_at',   
        'type',   
        'status_check',   
        'status_attend',   
        'file',   
        'information',   
       
    ];
}
