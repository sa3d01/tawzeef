<?php

namespace App\Http\Controllers\Admin;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends MasterController
{
    public function __construct(Job $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    public function index()
    {
        $rows = $this->model->latest()->get();
        return view('Dashboard.job.index', compact('rows'));
    }


    public function ban($id): object
    {
        $job = $this->model->find($id);
        $job->update(
            [
                'status' => 'rejected',
            ]
        );
        $job->refresh();
        $job->refresh();
        return redirect()->back()->with('updated');
    }

    public function activate($id): object
    {
        $job = $this->model->find($id);
        $job->update(
            [
                'status' => 'approved',
            ]
        );
        $job->refresh();
        $job->refresh();
        return redirect()->back()->with('updated');
    }
    public function edit($id): object
    {
        $row = $this->model->find($id);
        return view('Dashboard.job.edit', compact('row'));
    }

    public function update($id, Request $request)
    {
        $city = $this->model->find($id);
        $city->update($request->all());
        return redirect()->back()->with('updated');

    }
}
