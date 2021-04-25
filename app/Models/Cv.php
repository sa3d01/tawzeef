<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','file'];
    protected function getFileAttribute(): string
    {
        try {
            if ($this->attributes['file'])
                return asset('media/files/cv') . '/' . $this->attributes['file'];
            return "";
        } catch (\Exception $e) {
            return "";
        }
    }

}
