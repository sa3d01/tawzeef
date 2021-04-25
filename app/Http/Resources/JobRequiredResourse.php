<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class JobRequiredResourse extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'job_title'=>$this->job_title??"",
            'job_role_title'=>$this->job_role_title??"",
            'level'=>$this->level??"",
            'major' => new MajorResourse($this->major),
            'country' => new CountryResourse($this->country),
            'expected_salary'=>$this->expected_salary??"",
            'job_target'=>$this->job_target??"",
            'notice_period'=>$this->notice_period??"",
            'working_type'=>$this->working_type??"",
        ];
    }
}
