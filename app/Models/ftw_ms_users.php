<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ftw_ms_users extends Model
{
    use HasFactory;

    /**
     * 
     * 
     * @var array
     */

     protected $fillable = [
        'usr_ID',
        'rol_id',
        'usr_STATUS',
        'usr_created_by',
        'usr_created_date',
    ];
    
}
