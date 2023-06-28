<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $table = 'criterias';
    protected $fillable = [
        'contest_id',
        'criteria_name',
        'criteria_description',
        'criteria_percent'
    ];  

}
