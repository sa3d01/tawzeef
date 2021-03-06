<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'contact_type_id',
        'name',
        'phone',
        'message',
        'read',
    ];
    public function user():object
    {
        return $this->belongsTo(User::class);
    }
    public function contactType():object
    {
        return $this->belongsTo(ContactType::class);
    }
}
