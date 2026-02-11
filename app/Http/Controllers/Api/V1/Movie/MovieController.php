<?php

namespace App\Http\Controllers\Api\V1\Movie;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1Movie\IndexMovieRequest;
use App\Http\Resources\V1\Movie\IndexMovieResource;
use App\Http\Resources\V1\Movie\ShowMovieResource;
use App\Models\Movie\Movie;
use App\Repositories\Movie\MovieRepository;
use App\Services\JsonResponseService;
use Illuminate\Http\JsonResponse;

class MovieController extends Controller
{
    public function __construct
    (
        private JsonResponseService $jsonResponseService,
        private MovieRepository $movieRepository
    ){}

    public function index(IndexMovieRequest $request): JsonResponse
    {
        $movies = $this->movieRepository->getAllWithPagination(filters: $request->validated());

        return $this->jsonResponseService->success
        (
            code: JsonResponse::HTTP_OK,
            data: IndexMovieResource::collection($movies),
            meta: $movies
        );
    }

    public function show(Movie $movie): JsonResponse
    {
        $movie = $this->movieRepository->find(id: $movie->id);

        return $this->jsonResponseService->success
        (
            code: JsonResponse::HTTP_OK,
            data: ShowMovieResource::make($movie)
        );
    }
}
