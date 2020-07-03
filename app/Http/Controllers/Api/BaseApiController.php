<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class BaseApiController extends Controller
{
    public function sendResponse($result, $message = "", $code = 200)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];


        return response()->json($response, $code);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($message, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];


        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }
}
