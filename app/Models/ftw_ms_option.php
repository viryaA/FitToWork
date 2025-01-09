<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ftw_ms_option extends Model
{
    use HasFactory;

    protected $primaryKey = 'opt_id';
    public $timestamps = false;

    protected $fillable = ['qur_id','que_id', 'opt_text', 'opt_is_correct'];

    public function question()
    {
        return $this->belongsTo(ftw_ms_question::class, 'que_id');
    }
}
