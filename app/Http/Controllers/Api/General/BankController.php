<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Api\MasterController;
use App\Http\Resources\BankCollection;
use App\Http\Resources\PageResourse;
use App\Models\Bank;
use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BankController extends MasterController
{
    protected $model;

    public function __construct(Bank $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    public function index()
    {
        $banks = Bank::where('user_id', null)->whereBanned(0)->get();
        $result=[];
        $result['accounts']=new BankCollection($banks);
        $result['page']=new PageResourse(Page::where('type','bank')->latest()->first());
        return $this->sendResponse($result);
    }

}
