<?php

namespace App\Models\Movie;

use App\Models\Genre\Genre;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Movie extends Model
{
    protected $fillable =
        [
            'tmdb_id',
            'title',
            'original_title',
            'slug',
            'overview',
            'poster_path',
            'release_date'
        ];

    // Relations

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'genre_movie');
    }
}
