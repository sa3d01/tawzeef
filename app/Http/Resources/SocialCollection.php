<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SocialCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        $data = [];
        foreach ($this as $obj) {
            $arr['facebook'] = $obj->facebook??"";
            $arr['twitter'] = $obj->twitter??"";
            $arr['insta'] = $obj->insta??"";
            $arr['site'] = $obj->site??"";
            $arr['medium'] = $obj->medium??"";
            $data[] = $arr;
        }
        return $data;
    }
}
