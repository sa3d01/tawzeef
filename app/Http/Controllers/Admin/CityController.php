<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends MasterController
{
    public function __construct(City $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    public function index()
    {
        $rows = $this->model->latest()->get();
        return view('Dashboard.city.index', compact('rows'));
    }

    public function create()
    {
        return view('Dashboard.city.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->id();
        $this->model->create($data);
        return redirect()->route('admin.city.index')->with('created');
    }

    public function edit($id): object
    {
        $city = $this->model->find($id);
        return view('Dashboard.city.edit', compact('city'));
    }

    public function update($id, Request $request)
    {
        $city = $this->model->find($id);
        $city->update($request->all());
        return redirect()->back()->with('updated');

    }

    public function ban($id): object
    {
        $city = $this->model->find($id);
        $city->update(
            [
                'banned' => 1,
            ]
        );
        $city->refresh();
        return redirect()->back()->with('updated');
    }

    public function activate($id): object
    {
        $city = $this->model->find($id);
        $city->update(
            [
                'banned' => 0,
            ]
        );
        $city->refresh();
        return redirect()->back()->with('updated');
    }

}
