<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class ftw_ms_users extends Model
{
    use HasFactory;
    
    protected $table = 'ftw_ms_users';
    protected $primaryKey = 'usr_ID';
    public $incrementing = false;

    protected $fillable = [
        'usr_ID',
        'rol_id',
        'usr_STATUS',
        'usr_created_by',
        'usr_created_date',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'rol_id', 'rol_id');
    }
}
