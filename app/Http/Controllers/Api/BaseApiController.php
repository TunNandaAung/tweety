<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class BaseApiController extends Controller
{
    public function sendResponse($result, $message = "", $code = 200)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];


        return response()->json($response, $code);
    }


    /**
     * return error response.
     *
     * @param $message
     * @param array $errorMessages
     * @param int $code
     * @return JsonResponse
     */
    public function sendError($message, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => empty($errorMessages) ? $message : $errorMessages
        ];

        return response()->json($response, $code);
    }
}
