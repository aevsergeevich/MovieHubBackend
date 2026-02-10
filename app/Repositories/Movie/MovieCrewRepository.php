<?php

namespace App\Repositories\Movie;

use App\Models\Movie\MovieCrew;

class MovieCrewRepository
{
    public function __construct(private MovieCrew $movieCrew){}

    public function updateOrCreate(array $data): MovieCrew
    {
        return $this->movieCrew->query()->updateOrCreate
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