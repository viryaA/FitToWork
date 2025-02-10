<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ftw_tr_response extends Model
{
    protected $table = 'ftw_tr_responses';
    protected $fillable = ['qur_id', 'res_responder_id'];
    public $timestamps = false;
    public function questionnaire()
    {
        return $this->belongsTo(FtwMsQuestionnaire::class, 'qur_id');
    }

    public function answers()
    {
        return $this->hasMany(FtwTrAnswer::class, 'res_id');
    }
}
