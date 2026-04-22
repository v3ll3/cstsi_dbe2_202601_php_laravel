<?php

namespace App\Http\Controllers\Api;

use Exception;

class Controller
{
    protected function errorHandler(string $message, Exception $error)
    {
        $httpStatus = 500;
        $response = [
            "data" => [
                "message" => $message,
                "error" => true,
            ]
        ];
        if (env("APP_DEBUG"))
            $response['data'] = [
                "message" => $error->getMessage(),
                "trace" => $error->getTrace()
            ];
        return  response()->json($response, $httpStatus);
    }
}
