<?php

namespace App\Http\Controllers\Admin;


use App\Models\Blog;
use App\Models\HiringAgent;
use App\Models\HiringLaw;
use Illuminate\Http\Request;

class HiringLawController extends MasterController
{
    public function __construct(HiringLaw $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    public function index()
    {
        $rows = $this->model->latest()->get();
        return view('Dashboard.hiring-law.index', compact('rows'));
    }



    public function create()
    {
        return view('Dashboard.hiring-law.create');
    }


    public function store(Request $request)
    {
        $data = $request->all();
        $this->model->create($data);
        return redirect()->route('admin.hiring_law.index')->with('created');

    }
    public function edit($id): object
    {
        $row = $this->model->find($id);
        return view('Dashboard.hiring-law.edit', compact('row'));
    }

    public function update($id, Request $request)
    {
        $city = $this->model->find($id);
        $city->update($request->all());
        return redirect()->back()->with('updated');

    }


}
