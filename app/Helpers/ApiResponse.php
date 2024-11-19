<?php

namespace App\Helpers;

class ApiResponse 
{
    /**
     * Return a success JSON response.
     *
     * @param string $message
     * @param mixed $data
     * @param string $token
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */

    public static function success(string $message, $data = null, string $token = null, int $statusCode = 200) {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
            'token' => $token
        ], $statusCode);
    }

    /**
     * Return an error JSON response.
     *
     * @param string $message
     * @param array|null $errors
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */

    public static function error(string $message, array $errors = null, int $statusCode = 400) {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'errors' => $errors
        ], $statusCode);
    }
}