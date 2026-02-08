<?php

namespace App\Http\Controllers\Api\V1\Test;

use App\Http\Controllers\Controller;
use App\Services\Genre\GenreService;
use Illuminate\Http\JsonResponse;

class TestController extends Controller
{
    public function __construct(private GenreService $genreService){}

    public function testGenres(): JsonResponse
    {
        $genres = $this->genreService->syncGenres();

        return response()->json
        (
            [
                'code' => JsonResponse::HTTP_OK,
                'message' => 'Синхронизация успешна. Получено: ' . $genres . ' жанров.'
            ]
        );
    }
}
