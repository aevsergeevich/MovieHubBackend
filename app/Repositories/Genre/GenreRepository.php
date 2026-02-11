<?php

namespace App\Repositories\Genre;

use App\Constants\Query;
use App\Models\Genre\Genre;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class GenreRepository
{
    public function __construct(private Genre $genre){}

    public function getAll(): Collection
    {
        return $this->genre->query()->get();
    }

    public function getAllWithPagination(array $filters): LengthAwarePaginator
    {
        return $this->genre->query()
            ->applySort($filters['sort'] ?? null)
            ->orderBy(Query::ID_COLUMN, Query::SORT_DESC)
            ->paginate($filters['perPage'] ?? Query::PER_PAGE);
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
