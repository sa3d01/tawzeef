<?php

namespace App\Http\Resources;

use App\Models\Job;
use Illuminate\Http\Resources\Json\JsonResource;

class SimpleCompanyResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $jobs_count = Job::where('company_id', $this->id)->count();
        return [
            'id' => (int)$this->id,
            'type' => $this->type,
            'email' => $this->email,
            'email_main_domain' => $this->email,
            'phone' => $this->phone,
            'avatar' => $this->avatar,
            'cover' => $this->profile->cover,
            'foundation_name' => $this->profile->foundation_name,
            'description' => $this->profile->description,
            'jobs_count' => $jobs_count,
        ];
    }
}
