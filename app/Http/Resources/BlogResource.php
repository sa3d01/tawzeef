<?php

namespace App\Http\Resources;

use App\Models\BlogSeen;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class BlogResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => (int)$this->id,
            'writer' => $this->writer->name()??"",
            'title' => [
                'ar' => $this->title_ar,
                'en' => $this->title_en
            ],
            'note' => [
                'ar' => $this->note_ar,
                'en' => $this->note_en,
            ],
            'published_at' => Carbon::parse($this->created_at)->diffForHumans(),
            'seen' => BlogSeen::where('blog_id', $this->id)->count(),
            'media' => $this->media
        ];
    }
}
