<?php

namespace App\Services\Movie;

use App\Models\Movie\Movie;
use App\Repositories\Movie\MovieCastRepository;
use App\Repositories\Movie\MovieRepository;
use App\Services\MovieClientService;

class MovieCastService
{
    public function __construct
    (
        private MovieClientService $movieClientService,
        private MovieCastRepository $movieCastRepository,
        private MovieRepository $movieRepository
    ){}

    public function syncMovieCasts(Movie $movie): int
    {
        $casts = $this->getMovieCasts($movie->tmdb_id);

        $ids = [];

        $imported = 0;

        if (empty($casts['cast']))
        {
            return 0;
        }

        foreach ($casts['cast'] as $cast)
        {
            $data = $this->movieCastRepository->updateOrCreate(data: $cast);

            $ids[$data->id] = ['character' => $cast['character']];

            $imported++;
        }

        $this->movieRepository->attachCasts(movie: $movie, ids: $ids);

        return $imported;
    }

    public function getMovieCasts(int $movieId): array
    {
        return $this->movieClientService->fetchMovieCasts($movieId);
    }
}