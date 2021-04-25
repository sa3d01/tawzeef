<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MajorResourse extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => (int)$this->id,
            'name' =>[
                'ar'=>$this->name_ar,
                'en'=>$this->name_en
            ],
        ];
    }
}
