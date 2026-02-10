<?php

namespace App\Services\Movie;

use App\Models\Movie\Movie;
use App\Repositories\Movie\MovieCrewRepository;
use App\Repositories\Movie\MovieRepository;
use App\Services\MovieClientService;

class MovieCrewService
{
    public function __construct
    (
        private MovieClientService $movieClientService,
        private MovieCrewRepository $movieCrewRepository,
        private MovieRepository $movieRepository
    ){}

    public function syncMovieCrews(Movie $movie): int
    {
        $crews = $this->getMovieCrews(movieId: $movie->tmdb_id);

        $ids = [];

        $imported = 0;

        foreach ($crews['crew'] as $crew)
        {
            if (empty($crew))
            {
                continue;
            }

            $data = $this->movieCrewRepository->updateOrCreate(data: $crew);

            $ids[$data->id] = ['department' => $crew['department']];

            $imported++;
        }

        $this->movieRepository->attachCrews(movie: $movie, ids: $ids);

        return $imported;
    }

    private function getMovieCrews(int $movieId): array
    {
        return $this->movieClientService->fetchMovieCredits(movieId: $movieId);
    }
}