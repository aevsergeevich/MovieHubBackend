<?php

namespace App\Http\Controllers\Api\V1\Test;

use App\Http\Controllers\Controller;
use App\Models\Genre\Genre;
use App\Models\Movie\Movie;
use App\Services\Genre\GenreService;
use App\Services\Movie\MovieCastService;
use App\Services\Movie\MovieCrewService;
use App\Services\Movie\MovieImageService;
use App\Services\Movie\MovieService;
use Illuminate\Http\JsonResponse;

class TestController extends Controller
{
    public function __construct
    (
        private GenreService $genreService,
        private MovieService $movieService,
        private MovieCastService $movieCastService,
        private MovieCrewService $movieCrewService,
        private MovieImageService $movieImageService
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

    public function testMovieCasts(Movie $movie): JsonResponse
    {
        $casts = $this->movieCastService->syncMovieCasts(movie: $movie);

        return response()->json
        (
            [
                'code' => JsonResponse::HTTP_OK,
                'message' => 'Синхронизация успешна. Получено: ' . $casts . ' актеров.'
            ]
        );
    }

    public function testMovieCrews(Movie $movie): JsonResponse
    {
        $casts = $this->movieCrewService->syncMovieCrews(movie: $movie);

        return response()->json
        (
            [
                'code' => JsonResponse::HTTP_OK,
                'message' => 'Синхронизация успешна. Получено: ' . $casts . ' членов команды.'
            ]
        );
    }

    public function testMovieImages(Movie $movie): JsonResponse
    {
        $images = $this->movieImageService->syncMovieImages(movie: $movie);

        return response()->json
        (
            [
                'code' => JsonResponse::HTTP_OK,
                'message' => 'Синхронизация успешна. Получено: ' . $images . ' картинок.'
            ]
        );
    }
}
