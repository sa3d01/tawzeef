<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'writer_id',
        'title_ar',
        'title_en',
        'note_ar',
        'note_en',
        'media',
        'media_type',
    ];
    public function writer(): object
    {
        return $this->belongsTo(User::class,'writer_id','id');
    }
    public function comments(): object
    {
        return $this->hasMany(BlogComment::class,'blog_id','id');
    }
    protected function getMediaAttribute(): string
    {
        try {
            if ($this->attributes['media'])
                return asset('media/images/blog') . '/' . $this->attributes['media'];
            return "";
        } catch (\Exception $e) {
            return "";
        }
    }
}
