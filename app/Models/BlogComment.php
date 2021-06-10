<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'blog_id',
        'comment',
    ];
    public function user(): object
    {
        return $this->belongsTo(User::class);
    }
    public function blog(): object
    {
        return $this->belongsTo(Blog::class);
    }
}
