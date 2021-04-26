<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobRequired extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_title',
        'job_role_title',
        'major_id',
        'job_target',
        'level',
        'country_id',
        'expected_salary',
        'notice_period',
        'working_type',
    ];
    public function major():object
    {
        return $this->belongsTo(Major::class);
    }
    public function country():object
    {
        return $this->belongsTo(Country::class);
    }
}
