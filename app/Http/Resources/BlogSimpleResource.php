<?php

namespace App\Http\Resources;

use App\Models\BlogSeen;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class BlogSimpleResource extends JsonResource
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
                'ar'=>Str::limit($this->note_ar,50),
                'en'=>Str::limit($this->note_en,50),
            ],
            'published_at'=>Carbon::parse($this->created_at)->diffForHumans(),
            'seen'=>BlogSeen::where('blog_id',$this->id)->count(),
            'media'=>$this->media
        ];
    }
}
