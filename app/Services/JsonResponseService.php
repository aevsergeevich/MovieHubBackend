<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;

class JsonResponseService
{
    public function success(int $code, mixed $data, mixed $meta = []): JsonResponse
    {
        $response = ['code' => $code];

        if ($data !== null)
        {
            $response['data'] = $data;
        }

        if ($meta instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator) {
            $response['meta'] = $this->prepareMeta($meta);
        }

        return response()->json
       (
           $response,
           $code
       );
    }

    public function error(int $code, string $message): JsonResponse
    {
        return response()->json
        (
            [
                'code' => $code,
                'message' => $message
            ]
        );
    }

    private function prepareMeta(mixed $data): array
    {
        return [
            'total' => $data->total(),
            'per_page' => $data->perPage(),
            'current_page' => $data->currentPage()
        ];
    }
}