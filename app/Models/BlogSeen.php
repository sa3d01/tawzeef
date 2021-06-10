<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogSeen extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'blog_id',
    ];
    public function user(): object
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function blog(): object
    {
        return $this->belongsTo(Blog::class,'blog_id','id');
    }
}
