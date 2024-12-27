<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ftw_ms_mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'ftw_ms_mahasiswas';
    protected $primaryKey = 'mhs_id';
    public $incrementing = false;
    protected $keyType = 'char';

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
