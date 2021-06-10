<?php

namespace App\Http\Resources;

use App\Models\BlogSeen;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class BlogCommentResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => (int)$this->id,
            'user' => new SimpleUserResourse($this->user),
            'comment'=>$this->comment,
            'published_at' => Carbon::parse($this->created_at)->diffForHumans(),
        ];
    }
}
