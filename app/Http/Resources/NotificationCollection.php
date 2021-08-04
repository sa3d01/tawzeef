<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;

class NotificationCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data=[];
        foreach ($this as $obj){
            $arr['id']=(int)$obj->id;
            $arr['type']=$obj->type;
            $arr['model']=$obj->model;
            $arr['model_id']=$obj->model_id;
            $arr['read']=$obj->read == 'true';
            $note['ar']=$obj->note_ar;
            $note['en']=$obj->note_en;
            $arr['note']=$note;
            $arr['published_from']=Carbon::parse($obj->created_at)->diffForHumans();
            $data[]=$arr;
        }
        return $data;
    }
}
