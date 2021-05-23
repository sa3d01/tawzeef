<?php

namespace App\Http\Resources;

use App\Models\JobSubscribe;
use Illuminate\Http\Resources\Json\JsonResource;

class SimpleJobResourse extends JsonResource
{
    public function toArray($request): array
    {
        $arr['id'] = (int)$this->id;
        $arr['company'] = new SimpleCompanyResourse($this->company);
        $arr['major'] = new MajorResourse($this->major);
        $arr['job_title'] = $this->job_title;
        $arr['country'] = new CountryResourse($this->country);
        $arr['city'] = new CityResourse($this->city);
        $arr['subscribed'] = false;
        if (auth('api')->check()) {
            $subscribed = JobSubscribe::where([
                'user_id' => auth('api')->id(),
                'job_id' => $this->id,
            ])->first();
            if ($subscribed) {
                $arr['subscribed'] = true;
            }
        }
        return $arr;
    }
}
