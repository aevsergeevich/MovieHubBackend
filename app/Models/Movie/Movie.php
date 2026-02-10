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

    public function actors(): BelongsToMany
    {
        return $this->belongsToMany(MovieCast::class, 'cast_movie', 'movie_id', 'cast_id')
            ->withPivot('character');
    }

    public function crews(): BelongsToMany
    {
        return $this->belongsToMany(MovieCrew::class, 'crew_movie', 'movie_id', 'crew_id')
            ->withPivot('department');
    }
}
