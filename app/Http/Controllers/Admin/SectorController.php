<?php

namespace App\Http\Controllers\Admin;

use App\Models\Major;
use Illuminate\Http\Request;

class SectorController extends MasterController
{
    public function __construct(Major $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    public function index()
    {
        $rows = $this->model->where('type', 'sector')->latest()->get();
        return view('Dashboard.sector.index', compact('rows'));
    }

    public function show($id): object
    {
        $sector = $this->model->find($id);
        return view('Dashboard.sector.show', compact('sector'));
    }

    public function ban($id): object
    {
        $sector = $this->model->find($id);
        $sector->update(
            [
                'banned' => 1,
            ]
        );
        $sector->refresh();
        $sector->refresh();
        return redirect()->back()->with('updated');
    }

    public function activate($id): object
    {
        $sector = $this->model->find($id);
        $sector->update(
            [
                'banned' => 0,
            ]
        );
        $sector->refresh();
        $sector->refresh();
        return redirect()->back()->with('updated');
    }

    public function create()
    {
        return view('Dashboard.sector.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['type'] = 'sector';
        $this->model->create($data);
        return redirect()->route('admin.sector.index')->with('created');
    }
}
