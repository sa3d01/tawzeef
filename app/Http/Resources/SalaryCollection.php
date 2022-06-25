<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SalaryCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        $data = [];
        foreach ($this as $obj) {
            $arr['id'] = (int)$obj->id;
            $arr['major'] = $obj->major_id;//new MajorResourse($obj->major);
            $arr['position'] = $obj->position;
            $arr['average_experience'] = $obj->average_experience;
            $arr['average_lowest_salary'] = $obj->average_lowest_salary;
            $arr['average_salary'] = $obj->average_salary;
            $arr['average_highest_salary'] = $obj->average_highest_salary;
            $data[] = $arr;
        }
        return $data;
    }
}
