<?php

namespace App\Http\Controllers\Api\V1\Test;

use App\Http\Controllers\Controller;
use App\Models\Genre\Genre;
use App\Services\Genre\GenreService;
use App\Services\Movie\MovieService;
use Illuminate\Http\JsonResponse;

class TestController extends Controller
{
    public function __construct
    (
        private GenreService $genreService,
        private MovieService $movieService
    ){}

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

    public function testMovies(Genre $genre): JsonResponse
    {
        $movies = $this->movieService->syncMovies(genre: $genre, limit: 100);

        return response()->json
        (
            [
                'code' => JsonResponse::HTTP_OK,
                'message' => 'Синхронизация успешна. Получено: ' . $movies . ' фильмов.'
            ]
        );
    }
}
