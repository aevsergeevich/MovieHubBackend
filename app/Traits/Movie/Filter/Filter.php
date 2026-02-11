<?php

namespace App\Traits\Movie\Filter;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

trait Filter
{
    public function scopeApplyFilters(Builder $query, array $filters): Builder
    {
        if (!empty($filters['genres']))
        {
            $query->filterByGenre($filters['genres']);
        }

        if (!empty($filters['dateFrom']) || !empty($filters['dateTo']))
        {
            $query->filterByReleaseDate
            (
                $filters['dateFrom'] ?? null,
                $filters['dateTo'] ?? null
            );
        }

        return $query;
    }

    public function scopeFilterByGenre(Builder $query, array|string $genres): Builder
    {
        $genres = is_array($genres) ? $genres : [$genres];

        return $query->whereHas('genres', function (Builder $query) use ($genres)
        {
            $query->whereIn('genre_id', $genres);
        });
    }

    public function scopeFilterByReleaseDate(Builder $query, ?string $dateFrom, ?string $dateTo): Builder
    {
        if ($dateFrom)
        {
            $query->where('release_date', '>=', Carbon::parse($dateFrom)->startOfDay());
        }

        if ($dateTo)
        {
            $query->where('release_date', '<=', Carbon::parse($dateTo)->endOfDay());
        }

        return $query;
    }
}