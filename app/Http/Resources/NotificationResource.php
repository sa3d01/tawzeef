<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $arr['id']=(int)$this->id;
        $arr['type']=$this->type;
        $arr['model']=$this->model;
        $arr['model_id']=$this->model_id;
        $arr['read']=$this->read == 'true';
        $note['ar']=$this->note_ar;
        $note['en']=$this->note_en;
        $arr['note']=$note;
        $arr['published_from']=Carbon::parse($this->created_at)->diffForHumans();
        return $arr;
    }
}
