<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bank;
use App\Models\Category;
use App\Models\ContactType;
use App\Models\HearBy;
use App\Models\User;
use Illuminate\Http\Request;

class HearByController extends MasterController
{
    public function __construct(HearBy $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    public function index()
    {
        $rows = $this->model->latest()->get();
        return view('Dashboard.hear-by.index', compact('rows'));
    }
    public function create()
    {
        return view('Dashboard.hear-by.create');
    }
    public function store(Request $request)
    {
        $data=$request->all();
        $this->model->create($data);
        return redirect()->route('admin.hear_by.index')->with('created');
    }

    public function ban($id):object
    {
        $type=$this->model->find($id);
        $type->update(
            [
                'banned'=>1,
            ]
        );
        $type->refresh();
        return redirect()->back()->with('updated');
    }
    public function activate($id):object
    {
        $type=$this->model->find($id);
        $type->update(
            [
                'banned'=>0,
            ]
        );
        $type->refresh();
        return redirect()->back()->with('updated');
    }
    public function edit($id): object
    {
        $row = $this->model->find($id);
        return view('Dashboard.hear-by.edit', compact('row'));
    }

    public function update($id, Request $request)
    {
        $row = $this->model->find($id);
        $row->update($request->all());
        return redirect()->back()->with('updated');

    }
}
