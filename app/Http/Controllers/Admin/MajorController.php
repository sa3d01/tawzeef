<?php

namespace App\Http\Controllers\Admin;

use App\Models\Major;
use App\Models\User;
use Illuminate\Http\Request;

class MajorController extends MasterController
{
    public function __construct(Major $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    public function index()
    {
        $rows = $this->model->latest()->get();
        return view('Dashboard.major.index', compact('rows'));
    }
    public function show($id):object
    {
        $major=$this->model->find($id);
        return view('Dashboard.major.show', compact('major'));
    }
    public function ban($id):object
    {
        $major=$this->model->find($id);
        $major->update(
            [
                'banned'=>1,
            ]
        );
        $major->refresh();
        $major->refresh();
        return redirect()->back()->with('updated');
    }
    public function activate($id):object
    {
        $major=$this->model->find($id);
        $major->update(
            [
                'banned'=>0,
            ]
        );
        $major->refresh();
        $major->refresh();
        return redirect()->back()->with('updated');
    }
    public function create()
    {
        return view('Dashboard.major.create');
    }
    public function store(Request $request)
    {
        $data=$request->all();
        $this->model->create($data);
        return redirect()->route('admin.major.index')->with('created');
    }
}
