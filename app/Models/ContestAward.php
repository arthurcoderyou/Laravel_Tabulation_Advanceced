<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContestAward extends Model
{
    use HasFactory;
    protected $table = 'contest_awards';
    protected $fillable =[
        'award_name',
        'contestant_id',
        'contest_id'
    ];

}
