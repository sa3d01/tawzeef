<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSubscribe extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'job_id',
        'cv_id',
        'message',
    ];
    public function user():object
    {
        return $this->belongsTo(User::class);
    }
    public function job():object
    {
        return $this->belongsTo(Job::class);
    }
    public function cv():object
    {
        return $this->belongsTo(Cv::class);
    }
}
