<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class HiringLaw extends Model
{
    use HasFactory;
    protected $fillable = ['title_ar','title_en','note_ar','note_en','image'];
    private function upload_file($file)
    {
        $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
        $file->move('media/images/law/', $filename);
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

    protected function setImageAttribute()
    {
        $image = request('image');
        $filename = null;
        if (is_file($image)) {
            $filename = $this->upload_file($image);
        } elseif (filter_var($image, FILTER_VALIDATE_URL) === True) {
            $filename = $image;
        }
        $this->attributes['image'] = $filename;
    }
    protected function getImageAttribute(): string
    {
        try {
            if ($this->attributes['image'])
                return asset('media/images/law') . '/' . $this->attributes['image'];
            return "https://tawzeef-fundementals.herokuapp.com/_nuxt/img/logo.19a1d44.svg";
        } catch (\Exception $e) {
            return "https://tawzeef-fundementals.herokuapp.com/_nuxt/img/logo.19a1d44.svg";
        }
    }
}
