<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bank;
use App\Models\Category;
use App\Models\Setting;
use App\Models\Socials;
use App\Models\User;
use Illuminate\Http\Request;

class SettingController extends MasterController
{
    public function __construct(Setting $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    public function showConfig():object
    {
        $setting=$this->model->first();
        return view('Dashboard.setting.edit', compact('setting'));
    }
    public function updateConfing(Request $request)
    {
        $setting=$this->model->first();
        $setting->update($request->all());
        $social_model=Socials::where('user_id',null)->first();
        $socials['facebook']=$request['facebook'];
        $socials['twitter']=$request['twitter'];
        $socials['insta']=$request['insta'];
        $socials['youtube']=$request['youtube'];
        $social_model->update($socials);
        return redirect()->back()->with('updated');

    }
}
