<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SocialResourse extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'facebook' =>$this->facebook??"",
            'twitter' =>$this->twitter??"",
            'insta' =>$this->insta??"",
            'site' =>$this->site??"",
            'medium' =>$this->medium??"",

        ];
    }
}
