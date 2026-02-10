<?php

namespace App\Services\Movie;

use App\Models\Movie\Movie;
use App\Repositories\Movie\MovieImageRepository;
use App\Repositories\Movie\MovieImageTypeRepository;
use App\Services\MovieClientService;

class MovieImageService
{
    private const array IMAGE_TYPES =
        [
            'backdrops' => 'backdrop',
            'logos'     => 'logo',
            'posters'   => 'poster'
        ];

    public function __construct
    (
        private MovieClientService $movieClientService,
        private MovieImageRepository $movieImageRepository,
        private MovieImageTypeRepository $movieImageTypeRepository
    ){}

    public function syncMovieImages(Movie $movie): int
    {
        $images = $this->getMovieImages(movieId: $movie->tmdb_id);

        $imported = 0;

        if (empty($images))
        {
            return 0;
        }

        foreach (self::IMAGE_TYPES as $key => $value)
        {
            $typeId = $this->movieImageTypeRepository->findIdByType(type: $value);

            foreach ($images[$key] as $image)
            {
                $this->movieImageRepository->create(movieId: $movie->id, data: [
                    'type_id' => $typeId,
                    'file_path'=> $image['file_path'],
                    'width'    => $image['width'],
                    'height'   => $image['height']
                ]);

                $imported++;
            }
        }

        return $imported;
    }

    private function getMovieImages(int $movieId): array
    {
        return $this->movieClientService->fetchMovieImages(movieId: $movieId);
    }
}