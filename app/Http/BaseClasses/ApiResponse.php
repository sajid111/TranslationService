<?php

    namespace App\Http\BaseClasses;
    use Illuminate\Http\JsonResponse;

    class ApiResponse
    {

        public static function success($data = [], string $message = 'Success', int $statusCode = 200): JsonResponse
        {
            return response()->json([
                'status' => true,
                'message' => $message,
                'data' => $data,
            ], $statusCode);
        }

        public static function error(string $message = 'Error', int $statusCode = 400, $errors = []): JsonResponse
        {
            return response()->json([
                'status' => false,
                'message' => $message,
                'errors' => $errors,
            ], $statusCode);
        }
    }


?>
