<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ftw_ms_question extends Model
{
    use HasFactory;

    protected $primaryKey = 'que_id';

    protected $fillable = ['qur_id', 'que_text', 'que_type', 'que_required', 'que_points'];

    public function options()
    {
        return $this->hasMany(Option::class, 'que_id');
    }

    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class, 'qur_id');
    }
}
