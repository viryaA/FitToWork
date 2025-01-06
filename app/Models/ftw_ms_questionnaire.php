<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ftw_ms_questionnaire extends Model
{
    use HasFactory;

    protected $primaryKey = 'qur_id';

    protected $fillable = ['qur_title', 'qur_description'];

    public function questions()
    {
        return $this->hasMany(Question::class, 'qur_id');
    }
}
