<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ExperienceResourse extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'experience_years'=>$this->experience_years??"",
            'job_title'=>$this->job_title??"",
            'company_name'=>$this->company_name??"",
            'previous_experience'=>$this->previous_experience??"",
            'major' => new MajorResourse($this->major),
            'country' => new CountryResourse($this->country),
            'job_description'=>$this->job_description??"",
            'start_date'=>$this->start_date??"",
            'end_date'=>$this->end_date??"",
            'foundation_name'=>$this->foundation_name??"",
            'foundation_major' => new MajorResourse($this->foundationMajor),
            'foundation_members_count'=>$this->foundation_members_count??"",
            'latest_salary'=>$this->latest_salary??"",
        ];
    }
}
