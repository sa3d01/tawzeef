<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'experience_years',
        'company_name',
        'previous_experience',
        'job_title',
        'major_id',
        'country_id',
        'job_description',
        'start_date',
        'end_date',
        'foundation_name',
        'foundation_major_id',
        'foundation_members_count',
        'latest_salary',
    ];
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];
    public function country():object
    {
        return $this->belongsTo(Country::class);
    }
    public function major():object
    {
        return $this->belongsTo(Major::class);
    }
    public function foundationMajor():object
    {
        return $this->belongsTo(Major::class,'foundation_major_id','id');
    }
}
