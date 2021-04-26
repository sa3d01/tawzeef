<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
    protected $casts = [
        'graduation_date' => 'datetime',
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
    protected function setGraduationFileAttribute()
    {
        $image = request('graduation_file');
        $filename = null;
        if (is_file($image)) {
            $filename = $this->upload_file($image);
        } elseif (filter_var($image, FILTER_VALIDATE_URL) === True) {
            $filename = $image;
        }
        $this->attributes['graduation_file'] = $filename;
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
    private function upload_file($file)
    {
        $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
        $file->move('media/files/graduation_file/', $filename);
        return $filename;
    }

    function deleteFileFromServer($filePath)
    {
        if ($filePath != null) {
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
    }
}
