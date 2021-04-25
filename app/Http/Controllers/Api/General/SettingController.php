<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Api\MasterController;
use App\Http\Resources\SocialCollection;
use App\Models\Setting;
use App\Models\Socials;

class SettingController extends MasterController
{
    protected $model;

    public function __construct(Setting $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    public function getSettings()
    {
        $setting = Setting::first();
        $data = [];
        $data['mobile'] = $setting->mobile;
        $data['email'] = $setting->email;
        $data['socials'] = new SocialCollection(Socials::where('user_id',null)->get());
        return $this->sendResponse($data);
    }
}
