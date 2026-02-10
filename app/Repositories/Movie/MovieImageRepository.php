<?php

namespace App\Repositories\Movie;

use App\Models\Movie\MovieImage;

class MovieImageRepository
{
    public function __construct(private MovieImage $movieImage){}

    public function create(int $movieId, array $data): MovieImage
    {
        return $this->movieImage->query()->create
        (
            [
                'movie_id' => $movieId,
                'type_id' => $data['type_id'],
                'file_path' => $data['file_path'],
                'width' => $data['width'],
                'height' => $data['height']
            ]
        );
    }
}