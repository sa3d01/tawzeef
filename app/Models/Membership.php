<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'foundation_name',
        'role_name',
        'member_from',
    ];
    protected $casts=[
        'member_from'=>'datetime'
    ];
}
