<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'sex',
        'job_title',
        'birthdate',
        'social_status',
        'drive_licence_nationality_id',
        'sub_majors',
        'nationality_id',
        'working_type',
        'foundation_name',
        'address',
        'description',
        'commercial_file',
    ];
    protected $casts = [
        'birthdate' => 'datetime',
        'sub_majors' => 'array',
    ];

    public function user():object
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function nationality():object
    {
        return $this->belongsTo(Country::class,'nationality_id','id');
    }
    public function driveLicenceNationality():object
    {
        return $this->belongsTo(Country::class,'drive_licence_nationality_id','id');
    }
    protected function getCommercialFileAttribute(): string
    {
        try {
            if ($this->attributes['commercial_file'])
                return asset('media/files/commercial_file') . '/' . $this->attributes['commercial_file'];
            return "";
        } catch (\Exception $e) {
            return "";
        }
    }

}
