<?php

namespace App\Traits\Genre\Sort;

use App\Constants\Query;
use Illuminate\Database\Eloquent\Builder;

trait Sort
{
    public function scopeApplySort(Builder $query, ?string $sort): Builder
    {
        return match($sort)
        {
            'id_asc' => $query->sortById(Query::SORT_ASC),
            'id_desc' => $query->sortById(Query::SORT_DESC),

            default => $query->orderBy(Query::ID_COLUMN, Query::SORT_DESC)
        };
    }

    public function scopeSortById(Builder $query, string $direction = Query::SORT_DESC): Builder
    {
        return $query->orderBy('id', $direction);
    }
}