<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

    public function sendError($error,$data=null, $code = 422)
    {
        $errors[$data]=(array)$error;
        $response = [
            'status' => $code,
            'message' => $error,
            'errors' => $errors,
        ];
        return response()->json($response, $code);
    }
}
