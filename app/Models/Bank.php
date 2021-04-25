<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'logo',
        'name_ar',
        'name_en',
        'account_number',
    ];
    protected function getLogoAttribute(): string
    {
        try {
            if ($this->attributes['logo'])
                return asset('media/images/bank') . '/' . $this->attributes['logo'];
            return "";
        } catch (\Exception $e) {
            return "";
        }
    }
}
