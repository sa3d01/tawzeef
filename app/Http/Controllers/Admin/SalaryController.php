<?php

namespace App\Http\Controllers\Admin;


use App\Models\Salary;
use Illuminate\Http\Request;

class SalaryController extends MasterController
{
    public function __construct(Salary $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    public function index()
    {
        $rows = $this->model->latest()->get();
        return view('Dashboard.salary.index', compact('rows'));
    }

    public function create()
    {
        return view('Dashboard.salary.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $this->model->create($data);
        return redirect()->back()->with('created');
    }

    public function edit($id): object
    {
        $row = $this->model->find($id);
        return view('Dashboard.salary.edit', compact('row'));
    }

    public function update($id, Request $request)
    {
        $salary = $this->model->find($id);
        $salary->update($request->all());
        return redirect()->back()->with('updated');

    }


}
