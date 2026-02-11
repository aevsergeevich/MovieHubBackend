<?php

namespace App\Http\Controllers\Api\V1\Genre;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Genre\IndexGenreRequest;
use App\Http\Resources\V1\Genre\IndexGenreResource;
use App\Repositories\Genre\GenreRepository;
use App\Services\JsonResponseService;
use Illuminate\Http\JsonResponse;

class GenreController extends Controller
{
    public function __construct
    (
        private JsonResponseService $jsonResponseService,
        private GenreRepository $genreRepository
    ){}

    public function index(IndexGenreRequest $request): JsonResponse
    {
        $genres = $this->genreRepository->getAllWithPagination(filters: $request->validated());

        return $this->jsonResponseService->success
        (
            code: JsonResponse::HTTP_OK,
            data: IndexGenreResource::collection($genres),
            meta: $genres
        );
    }
}
