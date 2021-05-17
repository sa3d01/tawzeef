<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PageResourse extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => (int)$this->id,
            'title' =>[
                'ar'=>$this->title_ar,
                'en'=>$this->title_en
            ],
            'note' =>[
                'ar'=>$this->note_ar,
                'en'=>$this->note_en
            ],
            'media'=>$this->media
        ];
    }
}
