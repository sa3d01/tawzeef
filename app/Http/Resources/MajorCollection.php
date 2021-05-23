<?php

namespace App\Http\Resources;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MajorCollection extends ResourceCollection
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
            $arr['image']=$obj->image;
            $arr['users_count']=User::whereType('USER')->where('major_id',$obj->id)->count();
            $arr['jobs_count']=Job::where('major_id',$obj->id)->count();
            $data[] = $arr;
        }
        return $data;
    }
}
