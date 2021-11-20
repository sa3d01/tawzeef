<?php

namespace App\Http\Controllers\Admin;

use App\Models\Job;

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

}
