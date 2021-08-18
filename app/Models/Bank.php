<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Bank extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'logo',
        'name_ar',
        'name_en',
        'account_number',
        'banned',
    ];
    private function upload_file($file)
    {
        $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
        $file->move('media/images/bank/', $filename);
        return $filename;
    }
    protected function setLogoAttribute()
    {
        $logo = request('logo');
        if (is_file($logo)) {
            $filename = $this->upload_file($logo);
            $this->attributes['logo'] = $filename;
        }
    }
    protected function getLogoAttribute(): string
    {
        try {
            if ($this->attributes['logo'])
                return asset('media/images/bank') . '/' . $this->attributes['logo'];
            return asset('media/images/logo.png');
        } catch (\Exception $e) {
            return asset('media/images/logo.png');
        }
    }
}
