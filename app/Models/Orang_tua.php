<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orang_tua extends Model
{
    use HasFactory;
    protected $table = "parents";

    protected $fillable = [
        'user_id',   
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
