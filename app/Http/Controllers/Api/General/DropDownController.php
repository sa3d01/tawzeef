<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Api\MasterController;
use App\Http\Resources\CityCollection;
use App\Http\Resources\CountryCollection;
use App\Http\Resources\MajorCollection;
use App\Models\City;
use App\Models\Country;
use App\Models\HearBy;
use App\Models\Major;

class DropDownController extends MasterController
{
    protected $model;

    public function __construct(Country $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    public function countries(): object
    {
        return new CountryCollection(Country::where('banned', 0)->paginate());
        //return $this->sendResponse(new CountryCollection(Country::where('banned', 0)->get()));
    }

    public function cities($countryId): object
    {
        return $this->sendResponse(new CityCollection(City::where('country_id', $countryId)->where('banned', 0)->get()));
    }

    public function majors(): object
    {
        return $this->sendResponse(new MajorCollection(Major::where(['parent_id' => null, 'type' => 'major'])->where('banned', 0)->get()));
    }

    public function sectors(): object
    {
        return $this->sendResponse(new MajorCollection(Major::where(['parent_id' => null, 'type' => 'sector'])->where('banned', 0)->get()));
    }

    public function hearBy(): object
    {
        return $this->sendResponse(new CityCollection(HearBy::where('banned', 0)->get()));
    }

    public function subMajors($major_id): object
    {
        return $this->sendResponse(new MajorCollection(Major::where('parent_id', $major_id)->where('banned', 0)->get()));
    }

    public function subSectors($sector_id): object
    {
        return $this->sendResponse(new MajorCollection(Major::where('parent_id', $sector_id)->where('banned', 0)->get()));
    }
}
