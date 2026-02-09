<?php

namespace App\Repositories\Genre;

use App\Models\Genre\Genre;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class GenreRepository
{
    public function __construct(private Genre $genre){}

    public function getAll(): Collection
    {
        return $this->genre->query()->get();
    }

    public function updateOrCreate(array $data): Genre
    {
        return $this->genre->query()->updateOrCreate
        (
            [
                'tmdb_id' => $data['id']
            ],
            [
                'name' => mb_ucfirst($data['name']),
                'slug' => Str::slug($data['name'])
            ]
        );
    }

    public function attachMovies(Genre $genre, array $ids): void
    {
        $genre->movies()->syncWithoutDetaching($ids);
    }
}
