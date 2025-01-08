<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ftw_ms_role extends Model
{
    use HasFactory;

    /**
     * 
     * 
     * @var array
     */

    protected $fillable = [
        'rol_id',
        'rol_deskripsi',
        'rol_status',
        'rol_created_by',
        'rol_created_date',
    ];
}
