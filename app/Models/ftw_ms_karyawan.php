<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ftw_ms_karyawan extends Model
{
    use HasFactory;

    protected $table = 'ftw_ms_karyawans';
    protected $primaryKey = 'kry_id';
    public $incrementing = false;
    protected $keyType = 'char';

    protected $fillable = [
        'kry_id',
        'kry_nama_depan',
        'kry_nama_blk',
        'kry_tempat_lahir',
        'kry_tgl_lahir',
        'kry_jenis_kelamin',
        'kry_alamat',
        'kry_email',
    ];
}
