<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TrainingCourse extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'type',
        'title',
        'foundation_name',
        'total_hours',
        'start_date',
        'end_date',
        'graduation_file',
    ];
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];
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

    protected function setGraduationFileAttribute($graduation_file)
    {
        $image = $graduation_file;
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
}
