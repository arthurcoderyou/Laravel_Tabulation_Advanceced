<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubContestAward extends Model
{
    use HasFactory;
    protected $table = 'sub_contest_awards';
    protected $fillable = [
        'award_name',
        'sub_contest_id',
        'contestant_id'
    ];
}
