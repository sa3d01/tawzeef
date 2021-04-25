<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SkillCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        $data = [];
        foreach ($this as $obj) {
            $arr['level'] = $obj->level;
            $arr['name'] = $obj->name;
            $data[] = $arr;
        }
        return $data;
    }
}
