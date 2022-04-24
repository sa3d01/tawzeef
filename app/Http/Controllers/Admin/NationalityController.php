<?php

namespace App\Http\Controllers\Admin;

use App\Models\Nationality;
use Illuminate\Http\Request;

class NationalityController extends MasterController
{
    public function __construct(Nationality $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    public function index()
    {
        $rows = $this->model->latest()->get();
        return view('Dashboard.nationality.index', compact('rows'));
    }

    public function create()
    {
        return view('Dashboard.nationality.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->id();
        $this->model->create($data);
        return redirect()->route('admin.nationality.index')->with('created');
    }

    public function edit($id): object
    {
        $nationality = $this->model->find($id);
        return view('Dashboard.nationality.edit', compact('nationality'));
    }

    public function update($id, Request $request)
    {
        $nationality = $this->model->find($id);
        $nationality->update($request->all());
        return redirect()->back()->with('updated');

    }

    public function ban($id): object
    {
        $nationality = $this->model->find($id);
        $nationality->update(
            [
                'banned'=>1,
            ]
        );
        $nationality->refresh();
        return redirect()->back()->with('updated');
    }

    public function activate($id): object
    {
        $nationality = $this->model->find($id);
        $nationality->update(
            [
                'banned'=>0,
            ]
        );
        $nationality->refresh();
        return redirect()->back()->with('updated');
    }

}
