<?php

namespace App\Http\Controllers\Admin;


use App\Models\HiringAgent;
use Illuminate\Http\Request;

class HiringAgentController extends MasterController
{
    public function __construct(HiringAgent $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    public function index()
    {
        $rows = $this->model->latest()->get();
        return view('Dashboard.hiring-agent.index', compact('rows'));
    }

    public function create()
    {
        return view('Dashboard.hiring-agent.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $this->model->create($data);
        return redirect()->route('admin.hiring_agent.index')->with('created');
    }
    public function edit($id): object
    {
        $row = $this->model->find($id);
        return view('Dashboard.hiring-agent.edit', compact('row'));
    }

    public function update($id, Request $request)
    {
        $city = $this->model->find($id);
        $city->update($request->all());
        return redirect()->back()->with('updated');

    }
    public function ban($id): object
    {
        $type = $this->model->find($id);
        $type->update(
            [
                'status' => 0,
            ]
        );
        $type->refresh();
        return redirect()->back()->with('updated');
    }

    public function activate($id): object
    {
        $type = $this->model->find($id);
        $type->update(
            [
                'status' => 1,
            ]
        );
        $type->refresh();
        return redirect()->back()->with('updated');
    }

}
