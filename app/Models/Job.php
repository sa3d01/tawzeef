<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Job extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'major_id',
        'job_title',
        'qualification_type',
        'level',
        'working_type',
        'start_date',
        'end_date',
        'sex',
        'experience_years',
        'expected_salary',
        'country_id',
        'city_id',
        'description',
        'location',
        'show_company',
        'pay_type',
        'invoice_image',
        'status',
    ];
    protected $casts = [
        'location' => 'json',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];
    public function country():object
    {
        return $this->belongsTo(Country::class);
    }
    public function company():object
    {
        return $this->belongsTo(User::class,'company_id','id');
    }
    public function city():object
    {
        return $this->belongsTo(City::class);
    }
    public function major():object
    {
        return $this->belongsTo(Major::class);
    }

    private function upload_file($file)
    {
        $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
        $file->move('media/images/transfer/', $filename);
        return $filename;
    }

    protected function setInvoiceImageAttribute()
    {
        $image = request('invoice_image');
        $filename = null;
        if (is_file($image)) {
            $filename = $this->upload_file($image);
        } elseif (filter_var($image, FILTER_VALIDATE_URL) === True) {
            $filename = $image;
        }
        $this->attributes['invoice_image'] = $filename;
    }
    protected function getInvoiceImageAttribute(): string
    {
        try {
            if ($this->attributes['invoice_image'])
                return asset('media/images/transfer') . '/' . $this->attributes['invoice_image'];
            return "";
        } catch (\Exception $e) {
            return "";
        }
    }
    public function getStatusArabic():string
    {
        if ($this['end_date']< Carbon::now()){
            return "جديد";
        }else{
            return "منتهي";
        }
    }
}
