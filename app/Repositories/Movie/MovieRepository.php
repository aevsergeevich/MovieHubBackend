<?php

namespace App\Repositories\Movie;

use App\Constants\Query;
use App\Models\Movie\Movie;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class MovieRepository
{
    private const array RELATIONS =
        [
            'genres',
            'actors',
            'crews',
            'images',
            'images.type'
        ];

    public function __construct(private Movie $movie){}

    public function getAll(): Collection
    {
        return $this->movie->query()->get();
    }

    public function getAllWithPagination(array $filters): LengthAwarePaginator
    {
        return $this->movie->query()
            ->applySort($filters['sort'] ?? null)
            ->with(self::RELATIONS)
            ->orderBy(Query::ID_COLUMN, Query::SORT_DESC)
            ->paginate($filters['perPage'] ?? Query::PER_PAGE);
    }

    public function find(int $id): Movie
    {
        return $this->movie->query()->with(self::RELATIONS)->findOrFail($id);
    }

    public function updateOrCreate(array $data): Movie
    {
        return $this->movie->query()->updateOrCreate
        (
            [
                'tmdb_id' => $data['id']
            ],
            [
                'title' => mb_ucfirst($data['title']),
                'original_title' => $data['original_title'],
                'slug' => Str::slug($data['title']),
                'overview' => $data['overview'],
                'poster_path' => $data['poster_path'],
                'release_date' => $data['release_date']
            ]
        );
    }

    public function attachCasts(Movie $movie, array $ids): void
    {
        $movie->actors()->syncWithoutDetaching($ids);
    }

    public function attachCrews(Movie $movie, array $ids): void
    {
        $movie->crews()->syncWithoutDetaching($ids);
    }
}