<?php

namespace App\Http\Controllers\Admin;


use App\Models\Blog;
use App\Models\HiringAgent;
use Illuminate\Http\Request;

class BlogController extends MasterController
{
    public function __construct(Blog $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    public function news()
    {
        $type='new';
        $rows = $this->model->where('type','new')->latest()->get();
        return view('Dashboard.blog.index', compact('rows','type'));
    }

    public function blogs()
    {
        $type='blog';
        $rows = $this->model->where('type','blog')->latest()->get();
        return view('Dashboard.blog.index', compact('rows','type'));
    }

    public function createNew()
    {
        $type='new';
        return view('Dashboard.blog.create',compact('type'));
    }

    public function createBlog()
    {
        $type='blog';
        return view('Dashboard.blog.create',compact('type'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $this->model->create($data);
        if ($request['type']=='new'){
            $type='new';
            $rows = $this->model->where('type','new')->latest()->get();
            return view('Dashboard.blog.index', compact('rows','type'));
        }else{
            $type='blog';
            $rows = $this->model->where('type','blog')->latest()->get();
            return view('Dashboard.blog.index', compact('rows','type'));
        }
    }
    public function edit($id): object
    {
        $row = $this->model->find($id);
        return view('Dashboard.blog.edit', compact('row'));
    }

    public function update($id, Request $request)
    {
        $city = $this->model->find($id);
        $city->update($request->all());
        return redirect()->back()->with('updated');

    }


}
