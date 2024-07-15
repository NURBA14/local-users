<?php

namespace App\Http\Responders;

use Illuminate\Http\JsonResponse;

class Responder
{
    public function __construct()
    {
    }

    /**
     * @param $success
     * @param $message
     * @param $data
     * @param $statusCode
     * @return JsonResponse
     */
    private function respond($success, $message, $errors = [], $data = [], $statusCode)
    {
        return response()->json([
            "status" => $success,
            "message" => $message,
            "errors" => $errors,
            "data" => $data
        ], $statusCode);
    }
    public function success($message = null, $errors = [], $data = [], $statusCode = 200): JsonResponse
    {
        return $this->respond(true, $message, $errors, $data, $statusCode);
    }

    public function error($message, $errors = [], $data = [], $statusCode = 400): JsonResponse
    {
        return $this->respond(false, $message, $errors, $data, $statusCode);
    }


    /**
     * response
     *
     * @param bool status
     * @param string message
     * @param array errors
     * @param array data
     * @param int statusCode
     *
     * @return void
     */
    public static function response(bool $status, string $message, array $errors = [], array $data = [], int $statusCode)
    {
        return response()->json([
            "status" => $status,
            "message" => $message,
            "errors" => $errors,
            "data" => $data
        ], $statusCode);
    }
}

