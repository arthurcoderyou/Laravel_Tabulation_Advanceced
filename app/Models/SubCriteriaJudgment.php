<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCriteriaJudgment extends Model
{
    use HasFactory;
    protected $table = 'sub_criteria_judgments';
    protected $fillable = [
        'criteria_id',
        'judge_id',
        'contestant_id',
        'contestant_score'
    ];
}
