<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
