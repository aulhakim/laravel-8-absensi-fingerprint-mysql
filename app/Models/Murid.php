<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Murid extends Model
{
    use HasFactory;
    protected $table = "students";

    protected $fillable = [
        'user_id',   
        'class_id',   
        'parent_id',   
        'nis',  
        'full_name',   
        'religion_id',   
        'born',  
        'date_birth',   
        'created_at',   
        'address',   	
        'gender',   	
        'isconnect',   	
    ];
}
