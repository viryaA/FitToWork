<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ftw_ms_questionnaire extends Model
{
    use HasFactory;

    protected $primaryKey = 'qur_id';
    public $timestamps = false;
    protected $fillable = ['qur_title', 'qur_description','qur_created_by'];

    public function questions()
    {
        return $this->hasMany(ftw_ms_question::class, 'qur_id');
    }
}
