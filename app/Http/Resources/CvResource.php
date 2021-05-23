<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CvResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => (int)$this->id,
            'file' => $this->file,
        ];
    }
}
