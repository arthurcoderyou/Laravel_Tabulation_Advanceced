<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Judge extends Model
{
    use HasFactory;

    protected $table = 'judges';

    protected $fillable =[
        'user_id',
        'contest_id',
        'judge_description'
    ];

}
