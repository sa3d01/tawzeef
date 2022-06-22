<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Salary extends Model
{
    use HasFactory;
    protected $fillable = [
        'major_id',
        'position',
        'average_experience',
        'average_lowest_salary',
        'average_salary',
        'average_highest_salary',
    ];
    public function major(): object
    {
        return $this->belongsTo(Major::class,'major_id','id');
    }
}
