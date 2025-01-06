<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ftw_tr_answer extends Model
{
    protected $table = 'ftw_tr_answers';

    public function response()
    {
        return $this->belongsTo(FtwTrResponse::class, 'res_id');
    }

    public function question()
    {
        return $this->belongsTo(FtwMsQuestion::class, 'que_id');
    }

    public function option()
    {
        return $this->belongsTo(FtwMsOption::class, 'opt_id');
    }
}
