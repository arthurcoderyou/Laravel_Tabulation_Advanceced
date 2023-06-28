<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Judgement extends Model
{
    use HasFactory;

    protected $table = 'judgements';
    protected $fillable = [
        'contest_id',
        'judge_id',
        'contestant_id',
        'contestant_score'
    ];

}
