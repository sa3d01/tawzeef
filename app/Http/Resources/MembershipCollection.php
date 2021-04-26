<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MembershipCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        $data = [];
        foreach ($this as $obj) {
            $arr['foundation_name'] = $obj->foundation_name;
            $arr['role_name'] = $obj->role_name;
            $arr['member_from'] = Carbon::parse($obj->member_from)->format('Y-m-d');
            $data[] = $arr;
        }
        return $data;
    }
}
