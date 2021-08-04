<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'premium',
        'sex',
        'job_title',
        'birthdate',
        'social_status',
        'drive_licence_nationality_id',
        'sub_majors',
        'nationality_id',
        'working_type',
        'foundation_name',
        'address',
        'location',
        'description',
        'commercial_file',
        'cover',
    ];
    protected $casts = [
        'birthdate' => 'datetime',
        'sub_majors' => 'array',
        'location' => 'json',
    ];

    public function user():object
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function nationality():object
    {
        return $this->belongsTo(Country::class,'nationality_id','id');
    }
    public function driveLicenceNationality():object
    {
        return $this->belongsTo(Country::class,'drive_licence_nationality_id','id');
    }
//    protected function getLocationAttribute()
//    {
//        try {
//            $arr['lat']=$this->attributes['location'];
////            $arr['lng']=$this->attributes['location']['lng'];
////            $arr['address']=$this->attributes['location']['address'];
//        } catch (\Exception $e) {
//            $arr['lat']='';
//            $arr['lng']='';
//            $arr['address']='';
//        }
//        return $arr;
//    }
    protected function setCommercialFileAttribute()
    {
        $image = request('commercial_file');
        if (is_file($image)) {
            $filename = $this->upload_file($image);
            $this->attributes['commercial_file'] = $filename;
        }
    }
    protected function getCommercialFileAttribute(): string
    {
        try {
            if ($this->attributes['commercial_file'])
                return asset('media/files/commercial_file') . '/' . $this->attributes['commercial_file'];
            return "";
        } catch (\Exception $e) {
            return "";
        }
    }
    private function upload_file($file)
    {
        $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
        $file->move('media/files/commercial_file/', $filename);
        return $filename;
    }

    function deleteFileFromServer($filePath)
    {
        if ($filePath != null) {
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
    }

    protected function setCoverAttribute()
    {
        $image = request('cover');
        $filename = null;
        if (is_file($image)) {
            $filename = $this->upload_file($image);
        } elseif (filter_var($image, FILTER_VALIDATE_URL) === True) {
            $filename = $image;
        }
        $this->attributes['cover'] = $filename;
    }
    protected function getCoverAttribute(): string
    {
        try {
            if ($this->attributes['cover'])
                return asset('media/images/user') . '/' . $this->attributes['cover'];
            return "";
        } catch (\Exception $e) {
            return "";
        }
    }

}
