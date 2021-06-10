<?php

namespace App\Http\Controllers\Api\Visitor;

use App\Http\Controllers\Api\MasterController;
use App\Http\Resources\BlogCommentResource;
use App\Http\Resources\BlogResource;
use App\Http\Resources\BlogSimpleResource;
use App\Models\Blog;
use App\Models\BlogComment;
use App\Models\BlogSeen;
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

}
