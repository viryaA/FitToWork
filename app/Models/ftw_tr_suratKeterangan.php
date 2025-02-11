<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ftw_tr_suratKeterangan extends Model
{
    use HasFactory;
    
    protected $table = 'ftw_tr_surat_Keterangan';
    
    protected $fillable = [
        'usr_id',
        'skn_berkas',
        'skn_status',
        'skn_created_by',
        'skn_created_date',
    ];
}

