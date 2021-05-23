<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PremiumRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'pay_type',
        'invoice_image',
        'status',
    ];
    public function user():object
    {
        return $this->belongsTo(User::class);
    }
    function uploadFile($file,$dest)
    {
        $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
        $file->move($dest, $filename);
        return $filename;
    }
    protected function setInvoiceImageAttribute()
    {
        $image = request('invoice_image');
        $filename = null;
        if (is_file($image)) {
            $filename = $this->uploadFile($image,'media/images/user/');
        } elseif (filter_var($image, FILTER_VALIDATE_URL) === True) {
            $filename = $image;
        }
        $this->attributes['invoice_image'] = $filename;
    }
    protected function getInvoiceImageAttribute(): string
    {
        try {
            if ($this->attributes['invoice_image'])
                return asset('media/images/user') . '/' . $this->attributes['invoice_image'];
            return "";
        } catch (\Exception $e) {
            return "";
        }
    }
}
