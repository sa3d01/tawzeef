<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Major extends Model
{
    use HasFactory;
    protected $fillable = ['name_ar','name_en','banned','parent_id','image'];
    private function upload_file($file)
    {
        $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
        $file->move('media/images/major/', $filename);
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
                return asset('media/images/major') . '/' . $this->attributes['image'];
            return asset('media/images/logo.png');
        } catch (\Exception $e) {
            return asset('media/images/logo.png');
        }
    }
}
