<?php

namespace App\Http\Resources;

use App\Models\Major;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SimpleJobResourse extends JsonResource
{
    public function toArray($request): array
    {
        $arr['id'] = (int)$this->id;
        $arr['company'] = new SimpleCompanyResourse($this->company);
        $arr['major'] = new MajorResourse($this->major);
        $arr['job_title'] = $this->job_title;
        $arr['country']=new CountryResourse($this->country);
        $arr['city']=new CityResourse($this->city);
        return $arr;
    }
}
