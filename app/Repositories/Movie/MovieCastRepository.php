<?php

namespace App\Repositories\Movie;

use App\Models\Movie\MovieCast;

class MovieCastRepository
{
    public function __construct(private MovieCast $movieCast){}

    public function updateOrCreate(array $data): MovieCast
    {
        return $this->movieCast->query()->updateOrCreate
        (
            [
                'tmdb_id' => $data['id']
            ],
            [
                'name' => $data['name'],
                'original_name' => $data['original_name'],
                'profile_path' => $data['profile_path']
            ]
        );
    }
}