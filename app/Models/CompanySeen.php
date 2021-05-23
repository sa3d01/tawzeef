<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanySeen extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'company_id',
    ];
    public function user(): object
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function company(): object
    {
        return $this->belongsTo(User::class,'company_id','id');
    }

}
