<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResourse;
use App\Models\Notification;
use Edujugon\PushNotification\PushNotification;
use Illuminate\Http\Resources\Json\JsonResource;
use phpDocumentor\Reflection\Types\Object_;

abstract class MasterController extends Controller
{
    protected $model;

    public function __construct()
    {
    }

    public function sendResponse($result, $message = null)
    {
        $response = [
            'status' => 200,
            'message' => $message ? $message : '',
            'data' => $result,
        ];
        return response()->json($response);
    }

    public function sendError($error,$data=[], $code = 422)
    {
        $response = [
            'status' => $code,
            'message' => $error,
            'data' => $data,
        ];
        return response()->json($response, $code);
    }
}
