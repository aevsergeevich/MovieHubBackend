<?php

namespace App\Models\Genre;

use App\Models\Movie\Movie;
use App\Traits\Genre\Sort\Sort;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Genre extends Model
{
    use Sort;

    protected $fillable = ['tmdb_id', 'name', 'slug'];

    // Relations

    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class, 'genre_movie');
    }
}
