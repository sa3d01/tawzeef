<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlertJob extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'country_id',
        'city_id',
        'hashtags',
        'notify',
    ];
    protected $casts = [
        'hashtags' => 'array',
    ];

    public function user():object
    {
        return $this->belongsTo(User::class);
    }
    public function country():object
    {
        return $this->belongsTo(Country::class);
    }
    public function city():object
    {
        return $this->belongsTo(City::class);
    }
}
