<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class QulificationResourse extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'qualification_type'=>$this->qualification_type??"",
            'foundation_name'=>$this->foundation_name??"",
            'country' => new CountryResourse($this->country),
            'city' => new CityResourse($this->city),
            'average_calculation_system'=>$this->average_calculation_system??"",
            'graduation_date'=>$this->graduation_date??"",
            'graduation_degree'=>$this->graduation_degree??"",
            'specialization'=>$this->specialization??"",
            'graduation_file'=>$this->graduation_file??"",
        ];
    }
}
