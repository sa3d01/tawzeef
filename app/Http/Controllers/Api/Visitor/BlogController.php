<?php

namespace App\Http\Controllers\Api\Visitor;

use App\Http\Controllers\Api\MasterController;
use App\Http\Resources\BlogCommentResource;
use App\Http\Resources\BlogResource;
use App\Http\Resources\BlogSimpleResource;
use App\Models\Blog;
use App\Models\BlogComment;
use App\Models\BlogSeen;
use App\Models\User;
use Illuminate\Http\Request;

class BlogController extends MasterController
{
    public function news(): object
    {
        $rows = Blog::whereType('new')->latest()->paginate(10);
        return BlogSimpleResource::collection($rows);
    }

    public function blogs(): object
    {
        $rows = Blog::whereType('blog')->latest()->paginate(10);
        return BlogSimpleResource::collection($rows);
    }

    public function show($id): object
    {
        $row = Blog::find($id);
        if (auth('api')->check()){
            BlogSeen::create([
               'blog_id'=>$id,
               'user_id'=>auth('api')->id()
            ]);
        }
        return $this->sendResponse(new BlogResource($row));
    }

    public function comments($id):object
    {
        $row = Blog::find($id);
        $comments=$row->comments()->latest()->paginate(10);
        return BlogCommentResource::collection($comments);
    }
    public function related($id):object
    {
        $row = Blog::find($id);
        $rows = Blog::whereType($row->type)->latest()->take(10)->get();
        return BlogSimpleResource::collection($rows);
    }

    public function storeComment($id,Request $request):object
    {
        $this->validate($request, ['comment' => 'required']);
        BlogComment::create([
           'user_id'=>auth('api')->id(),
           'blog_id'=>$id,
           'comment'=>$request['comment']
        ]);
        $row = Blog::find($id);
        $comments=$row->comments()->latest()->paginate(10);
        return BlogCommentResource::collection($comments);
    }


    function getCountry($user)
    {
        if ($user->country_id==1)
        {
            $country_id=59;
        }else{
            $country_id=178;
        }
        return $country_id;
    }
    function getCity($user)
    {
        if ($user->city_id==2){
            $city_id=3083;
        }elseif ($user->city_id==3){
            $city_id=3089;
        }elseif ($user->city_id==4 || $user->city_id==7){
            $city_id=3087;
        }elseif ($user->city_id==5){
            $city_id=3088;
        }elseif ($user->city_id==6){
            $city_id=3082;
        }else{
            $city_id=934;
        }
        return $city_id;
    }
    public function updateLocation()
    {
        $users=User::where('country_id','!=',null)->get();
        foreach ($users as $user) {
            $user->update([
                'country_id'=>$this->getCountry($user),
                'city_id'=>$this->getCity($user),
            ]);
        }
        return 'ok';
    }
}
