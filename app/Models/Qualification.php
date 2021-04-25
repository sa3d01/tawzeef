<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'qualification_type',
        'foundation_name',
        'country_id',
        'city_id',
        'average_calculation_system',
        'graduation_date',
        'graduation_degree',
        'specialization',
        'graduation_file',
    ];

    public function user():object
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function country(): object
    {
        return $this->belongsTo(Country::class);
    }

    public function city(): object
    {
        return $this->belongsTo(City::class);
    }
    protected function getGraduationFileAttribute(): string
    {
        try {
            if ($this->attributes['graduation_file'])
                return asset('media/files/graduation_file') . '/' . $this->attributes['graduation_file'];
            return "";
        } catch (\Exception $e) {
            return "";
        }
    }
}
