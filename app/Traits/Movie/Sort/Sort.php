<?php

namespace App\Traits\Movie\Sort;

use App\Constants\Query;
use Illuminate\Database\Eloquent\Builder;

trait Sort
{
    public function scopeApplySort(Builder $query, ?string $sort): Builder
    {
        return match($sort)
        {
            'title_asc' => $query->sortByTitle(Query::SORT_ASC),
            'title_desc' => $query->sortByTitle(Query::SORT_DESC),

            'release_date_asc' => $query->sortByReleaseDate(Query::SORT_ASC),
            'release_date_desc' => $query->sortByReleaseDate(Query::SORT_DESC),

            'id_asc' => $query->sortById(Query::SORT_ASC),
            'id_desc' => $query->sortById(Query::SORT_DESC),

            default => $query->orderBy(Query::ID_COLUMN, Query::SORT_DESC)
        };
    }

    public function scopeSortById(Builder $query, string $direction = Query::SORT_DESC): Builder
    {
        return $query->orderBy('id', $direction);
    }

    public function scopeSortByTitle(Builder $query, string $direction = Query::SORT_DESC): Builder
    {
        return $query->orderBy('title', $direction);
    }

    public function scopeSortByReleaseDate(Builder $query, string $direction = Query::SORT_DESC): Builder
    {
        return $query->orderBy('release_date', $direction);
    }
}