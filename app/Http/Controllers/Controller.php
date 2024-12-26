<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function returnResponse($status = false, $code = 404, $message = "", $data = [], $action = "")
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $code);
    }
    public function returnSuccessResponse($message = "", $data = null)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ], 200);
    }

    public function returnFailedResponse($message = "", $data = null)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => $data,
        ], 404);
    }
}
