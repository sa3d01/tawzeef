<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CountryCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        $data = [];
        foreach ($this as $obj) {
            $arr['id'] = (int)$obj->id;
            $arr['name'] =[
                'ar'=> $obj->name_ar,
                'en'=> $obj->name_en,
            ];
            $data[] = $arr;
        }
        return $data;
    }
}
