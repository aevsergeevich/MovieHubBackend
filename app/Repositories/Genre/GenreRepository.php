<?php

namespace App\Repositories\Genre;

use App\Models\Genre\Genre;

class GenreRepository
{
    public function __construct(private Genre $genre){}

    public function updateOrCreate(int $tmdb_id, string $name): Genre
    {
        return $this->genre->query()->updateOrCreate(['tmdb_id' => $tmdb_id], ['name' => $name]);
    }
}
