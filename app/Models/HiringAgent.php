<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class HiringAgent extends Model
{
    use HasFactory;
    protected $fillable = ['logo','status'];
    private function upload_file($file)
    {
        $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
        $file->move('media/images/agent/', $filename);
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

    protected function setLogoAttribute()
    {
        $image = request('logo');
        $filename = null;
        if (is_file($image)) {
            $filename = $this->upload_file($image);
        } elseif (filter_var($image, FILTER_VALIDATE_URL) === True) {
            $filename = $image;
        }
        $this->attributes['logo'] = $filename;
    }
    protected function getLogoAttribute(): string
    {
        try {
            if ($this->attributes['logo'])
                return asset('media/images/agent') . '/' . $this->attributes['logo'];
            return "https://tawzeef-fundementals.herokuapp.com/_nuxt/img/logo.19a1d44.svg";
        } catch (\Exception $e) {
            return "https://tawzeef-fundementals.herokuapp.com/_nuxt/img/logo.19a1d44.svg";
        }
    }
}
