<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MessageCollection extends ResourceCollection
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
            if ($obj->sender->type=='USER'){
                $sender=new SimpleUserResourse($obj->sender);
            }else{
                $sender=new SimpleCompanyResourse($obj->sender);
            }
            $arr['id']=(int)$obj->id;
            $arr['sender']=$sender;
            $arr['message']=$obj->message;
            $arr['sent_at']=Carbon::parse($obj->created_at)->format('Y-m-d H:i');
            $data[]=$arr;
        }
        return $data;
    }
}
