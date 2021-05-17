<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'for',
        'title_ar',
        'title_en',
        'note_ar',
        'note_en',
        'media',
    ];
    protected function getMediaAttribute(): string
    {
        try {
            if ($this->attributes['media'])
                return asset('media/images/page') . '/' . $this->attributes['media'];
            return "";
        } catch (\Exception $e) {
            return "";
        }
    }
}
