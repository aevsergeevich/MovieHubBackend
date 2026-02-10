<?php

namespace App\Services\Movie;

use App\Models\Genre\Genre;
use App\Repositories\Genre\GenreRepository;
use App\Repositories\Movie\MovieRepository;
use App\Services\MovieClientService;

class MovieService
{
    public function __construct
    (
        private MovieClientService $movieClientService,
        private MovieRepository $movieRepository,
        private GenreRepository $genreRepository
    ){}

    public function syncMovies(Genre $genre, int $limit): int
    {
        $ids = [];

        $page = 1;

        $imported = 0;

        do
        {
            $movies = $this->getMovies(genreId: $genre->tmdb_id, page: $page);

            if (empty($movies['results']))
            {
                break;
            }

            foreach ($movies['results'] as $movie)
            {
                if ($imported >= $limit)
                {
                    break 2;
                }

                $data = $this->movieRepository->updateOrCreate(data: $movie);

                $ids[] = $data->id;

                $imported ++;
            }

            $page ++;

        } while ($imported < $limit);

        if ($ids)
        {
            $this->genreRepository->attachMovies(genre: $genre, ids: $ids);
        }

        return $imported;
    }

    private function getMovies(int $genreId, int $page): array
    {
        return $this->movieClientService->fetchMovies(genreId: $genreId, page: $page);
    }
}