<?php

namespace App\Core\Support\Traits;

use Illuminate\Http\JsonResponse;

trait ResponseJson
{
    /**
     * @param array $data
     * @param int $status
     * @return JsonResponse
     */
    protected function successJson(array $data, int $status = 200)
    {
        return response()->json([
            'data' => $data
        ], $status);
    }

    /**
     * @param string $message
     * @param \Throwable $e
     * @param int $status
     * @return JsonResponse
     */
    protected function errorJson(string $message, \Throwable $e, int $status)
    {
        return response()->json([
            'message' => $message,
            'error' => [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]
        ], $status);
    }
}
