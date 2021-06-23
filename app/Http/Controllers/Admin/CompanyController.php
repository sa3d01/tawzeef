<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;

class CompanyController extends MasterController
{
    public function __construct(User $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    public function index()
    {
        $rows = $this->model->where('type','COMPANY')->latest()->get();
        return view('Dashboard.company.index', compact('rows'));
    }
    public function show($id):object
    {
        $user=$this->model->find($id);
        return view('Dashboard.company.show', compact('user'));
    }
    public function ban($id):object
    {
        $user=$this->model->find($id);
        $user->update(
            [
                'banned'=>1,
            ]
        );
        $user->refresh();
        $user->refresh();
        return redirect()->back()->with('updated');
    }
    public function activate($id):object
    {
        $user=$this->model->find($id);
        $user->update(
            [
                'banned'=>0,
            ]
        );
        $user->refresh();
        $user->refresh();
        return redirect()->back()->with('updated');
    }

}
