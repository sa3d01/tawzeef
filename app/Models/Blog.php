<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
    private function upload_file($file)
    {
        $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
        $file->move('media/images/blog/', $filename);
        return $filename;
    }
    protected function setMediaAttribute()
    {
        $logo = request('media');
        if (is_file($logo)) {
            $filename = $this->upload_file($logo);
            $this->attributes['media'] = $filename;
        }
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
