<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = ['receiver_id','model','model_id','note_ar','note_en','read','type','admin_notify_type','receivers','more_details'];
    protected $casts = [
        'receivers' => 'array',
        'more_details' => 'json'
    ];

    public function receiver():object
    {
        return $this->belongsTo(User::class,'receiver_id','id');
    }
}
