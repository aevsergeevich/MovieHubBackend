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

        $imported = 0;

        if (empty($genres))
        {
            return 0;
        }

        foreach ($genres as $genre)
        {
            $this->genreRepository->updateOrCreate(data: $genre);

            $imported++;
        }

        return $imported;
    }

    private function getGenres(): array
    {
        return $this->movieClientService->fetchGenres();
    }
}
