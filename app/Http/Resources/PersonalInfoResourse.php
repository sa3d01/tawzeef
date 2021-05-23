<?php

namespace App\Http\Resources;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PersonalInfoResourse extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'premium'=>$this->profile->premium==1,
            'first_name' => $this->profile->first_name,
            'last_name' => $this->profile->last_name,
            'birthdate' => $this->profile->birthdate?Carbon::parse($this->profile->birthdate)->format('Y-m-d'):"",
            'country' => new CountryResourse($this->country),
            'city' => new CityResourse($this->city),
            'nationality' => $this->profile->nationality?new CountryResourse($this->profile->nationality):"",
            'sex' =>$this->profile->sex??"",
            'social_status' =>$this->profile->social_status??"",
            'members_count' =>$this->members_count,
            'drive_licence_nationality' =>$this->profile->nationality?new CountryResourse($this->profile->driveLicenceNationality):"",
        ];
    }
}
