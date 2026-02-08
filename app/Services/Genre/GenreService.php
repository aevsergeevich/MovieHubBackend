<?php

namespace App\Services\Genre;

use App\Repositories\Genre\GenreRepository;
use App\Services\MovieClientService;

class GenreService
{
    public function __construct
    (
        private MovieClientService $movieClientService,
        private GenreRepository $genreRepository
    ){}

    public function syncGenres(): int
    {
        $genres = $this->getGenres();

        if (empty($genres))
        {
            return 0;
        }

        foreach ($genres as $genre)
        {
            $this->genreRepository->updateOrCreate(tmdb_id: $genre['id'], name: $genre['name']);
        }

        return count($genres);
    }

    private function getGenres(): array
    {
        return $this->movieClientService->getMovieGenres();
    }
}
