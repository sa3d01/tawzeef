<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Integer;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, SoftDeletes, Notifiable, HasRoles;

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'avatar',
        'phone',
        'email',
        'email_verified_at',
        'password',
        'country_id',
        'city_id',
        'major_id',
        'members_count',
        'hear_by_id',
        'banned',
        'last_login_at',
        'last_ip',
        'approved',
        'reject_reason',
        'approved_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    protected $casts = [
//        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function completedProfileRatio(): int
    {
        $percent=20;
        if ($this->profile){
            $percent=$percent+10;
        }
        if ($this->experience){
            $percent=$percent+10;
        }
        if ($this->memberships->count() > 0){
            $percent=$percent+10;
        }
        if ($this->qualification){
            $percent=$percent+10;
        }
        if ($this->jobRequired){
            $percent=$percent+10;
        }
        if ($this->skills){
            $percent=$percent+10;
        }
        if ($this->TrainingCourses){
            $percent=$percent+10;
        }
        if ($this->socials){
            $percent=$percent+10;
        }
        return $percent;
    }

    public function country(): object
    {
        return $this->belongsTo(Country::class);
    }

    public function city(): object
    {
        return $this->belongsTo(City::class);
    }
    public function hear_by(): object
    {
        return $this->belongsTo(HearBy::class,'hear_by_id','id');
    }

    public function major(): object
    {
        return $this->belongsTo(Major::class);
    }

    protected function setPasswordAttribute($password)
    {
        if (isset($password)) {
            $this->attributes['password'] = bcrypt($password);
        }
    }
    private function upload_file($file)
    {
        $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
        $file->move('media/images/user/', $filename);
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

    protected function setAvatarAttribute()
    {
        $image = request('avatar');
        $filename = null;
        if (is_file($image)) {
            $filename = $this->upload_file($image);
        } elseif (filter_var($image, FILTER_VALIDATE_URL) === True) {
            $filename = $image;
        }
        $this->attributes['avatar'] = $filename;
    }
    protected function getAvatarAttribute(): string
    {
        try {
            if ($this->attributes['avatar'])
                return asset('media/images/user') . '/' . $this->attributes['avatar'];
            return asset('media/images/default.png');
        } catch (\Exception $e) {
            return asset('media/images/default.png');
        }
    }

    public function cv(): object
    {
        return $this->hasMany(Cv::class);
    }

    public function profile(): object
    {
        return $this->hasOne(Profile::class);
    }

    public function name()
    {
        if ($this->profile){
           return $this->profile->first_name.' '.$this->profile->last_name;
        }else{
            return '';
        }
    }

    public function experience(): object
    {
        return $this->hasOne(Experience::class);
    }

    public function memberships(): object
    {
        return $this->hasMany(Membership::class);
    }

    public function qualification(): object
    {
        return $this->hasOne(Qualification::class);
    }

    public function jobRequired(): object
    {
        return $this->hasOne(JobRequired::class);
    }

    public function skills(): object
    {
        return $this->hasMany(Skill::class);
    }

    public function socials(): object
    {
        return $this->hasOne(Socials::class);
    }

    public function TrainingCourses(): object
    {
        return $this->hasMany(TrainingCourse::class);
    }

    public function verifyUser(): object
    {
        return $this->hasOne(VerifyUser::class);
    }

}
