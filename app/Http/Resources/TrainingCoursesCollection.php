<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TrainingCoursesCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        $data = [];
        foreach ($this as $obj) {
            $arr['type'] = $obj->type;
            $arr['title'] = $obj->title;
            $arr['foundation_name'] = $obj->foundation_name;
            $arr['total_hours'] = $obj->total_hours;
            $arr['start_date'] = $obj->start_date;
            $arr['end_date'] = $obj->end_date;
            $arr['graduation_file'] = $obj->graduation_file;
            $data[] = $arr;
        }
        return $data;
    }
}
