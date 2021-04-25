<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Socials extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'facebook',
        'twitter',
        'insta',
        'site',
        'medium',
    ];
}
