<?php

namespace App\Http\Resources;

use App\Models\Job;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MajorResourse extends JsonResource
{
    public function toArray($request): array
    {
        $users_count=User::whereType('USER')->where('major_id',$this->id)->count();
        $users=User::whereType('USER')->where('major_id',$this->id)->get();
        $jobs_count=Job::where('major_id',$this->id)->get();
        return [
            'id' => (int)$this->id,
            'name' =>[
                'ar'=>$this->name_ar,
                'en'=>$this->name_en
            ],
            'image'=>$this->image
        ];
    }
}
