<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contestant extends Model
{
    use HasFactory;

    protected $table = 'contestants';

    protected $fillable = [
        'user_id',
        'contest_id',
        'contestant_number',
        'contestant_message',
        'contestant_representing'
    ];
}
