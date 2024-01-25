<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    //
    public function sendResponse($data , $message, $others=[])
    {
        $response = [
            'success' => true,
            'data' => $data,
            'message' => $message,
            ...$others
        ];
        return response()->json($response, 200);
    }

    public function sendError($error , $message , $status = 400)
    {
        $response = [
            'success' => false,
            'message'=> $message,
            'errors' => $error,
        ];

        return response()->json($response, $status);
    }
}
