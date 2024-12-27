<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class ftw_ms_role extends Model
{
    use HasFactory;

    protected $table = 'ftw_ms_roles';
    protected $primaryKey = 'rol_id';
    public $incrementing = false;
    protected $keyType = 'char';

    protected $fillable = [
        'rol_id',
        'rol_deskripsi',
        'rol_status',
        'rol_created_by',
        'rol_created_date',
    ];
}
