<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ftw_ms_mahasiswa extends Model
{
    use HasFactory;

    /**
     * 
     * 
     * @var array
     */

    protected $fillable = [
        'mhs_id',
        'mhs_nama',
        'mhs_tempat_lahir',
        'mhs_tgl_lahir',
        'mhs_alamat',
        'mhs_hp',
        'mhs_jenis_kelamin',
        'mhs_email',
        'mhs_angkatan',
    ];
    
}
