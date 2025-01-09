<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ftw_ms_karyawan extends Model
{
    /**
     * 
     * 
     * @var array
     */

    protected $fillable = [
        'kry_id',
        'kry_nama_depan',
        'kry_nama_blkng',
        'kry_username',
        'kry_tempat_lahir',
        'kry_tgl_lahir',
        'kry_jenis_kelamin',
        'kry_no_hp',
        'kry_alamat',
        'kry_email',
    ];
    

}
