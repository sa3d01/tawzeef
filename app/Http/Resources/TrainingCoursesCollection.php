<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TrainingCoursesCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        $data = [];
        foreach ($this as $obj) {
            $arr['type'] = $obj->type;
            $arr['title'] = $obj->title??"";
            $arr['foundation_name'] = $obj->foundation_name??"";
            $arr['total_hours'] = $obj->total_hours??"";
            $arr['start_date'] =Carbon::parse($obj->start_date)->format('Y-m-d')??"";
            $arr['end_date'] = Carbon::parse($obj->end_date)->format('Y-m-d')??"";
            $arr['graduation_file'] = $obj->graduation_file;
            $data[] = $arr;
        }
        return $data;
    }
}
