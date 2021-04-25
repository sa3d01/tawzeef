<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MembershipCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        $data = [];
        foreach ($this as $obj) {
            $arr['foundation_name'] = $obj->foundation_name;
            $arr['role_name'] = $obj->role_name;
            $arr['member_from'] = $obj->member_from;
            $data[] = $arr;
        }
        return $data;
    }
}
