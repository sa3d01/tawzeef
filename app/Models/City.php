<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_ar',
        'name_en',
        'country_id',
        'banned',
    ];
    public function country(): object
    {
        return $this->belongsTo(Country::class);
    }

}
