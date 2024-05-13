<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    protected $table = "teachers";

    protected $fillable = [
        'user_id',   
        'class_id',   
        'subject',  
        'full_name',   
        'religion_id',   
        'born',  
        'date_birth',   
        'created_at',   
        'address',   	
        'gender',   	
        'tele_id',   	
    ];

}
