<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ftw_ms_question extends Model
{
    use HasFactory;

    protected $primaryKey = 'que_id';
    public $timestamps = false;

    protected $fillable = ['qur_id', 'que_text', 'que_type', 'que_required', 'que_points'];

    public function options()
    {
        return $this->hasMany(ftw_ms_option::class, 'que_id');
    }

    public function questionnaire()
    {
        return $this->belongsTo(ftw_ms_questionnaire::class, 'qur_id');
    }
}
