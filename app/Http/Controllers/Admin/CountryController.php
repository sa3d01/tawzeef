<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends MasterController
{
    public function __construct(Country $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    public function index()
    {
        $rows = $this->model->latest()->get();
        return view('Dashboard.country.index', compact('rows'));
    }

    public function create()
    {
        return view('Dashboard.country.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->id();
        $this->model->create($data);
        return redirect()->route('admin.country.index')->with('created');
    }

    public function edit($id): object
    {
        $country = $this->model->find($id);
        return view('Dashboard.country.edit', compact('country'));
    }

    public function update($id, Request $request)
    {
        $country = $this->model->find($id);
        $country->update($request->all());
        return redirect()->back()->with('updated');

    }

    public function ban($id): object
    {
        $country = $this->model->find($id);
        $country->update(
            [
                'banned'=>1,
            ]
        );
        $country->refresh();
        return redirect()->back()->with('updated');
    }

    public function activate($id): object
    {
        $country = $this->model->find($id);
        $country->update(
            [
                'banned'=>0,
            ]
        );
        $country->refresh();
        return redirect()->back()->with('updated');
    }

}
