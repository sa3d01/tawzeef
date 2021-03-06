<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BankCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        $data = [];
        foreach ($this as $obj) {
            $arr['id'] = (int)$obj->id;
            $arr['logo'] = $obj->logo;
            $arr['name'] =[
                'ar'=> $obj->name_ar,
                'en'=> $obj->name_en,
            ];
            $arr['account_number'] = $obj->account_number;
            $data[] = $arr;
        }
        return $data;
    }
}
