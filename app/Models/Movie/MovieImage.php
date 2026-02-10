<?php

namespace App\Models\Movie;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MovieImage extends Model
{
    protected $fillable = ['movie_id', 'type_id', 'file_path', 'width', 'height',
        'height',
        'type_id'
    ];

    // Relations

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    public function type(): BelongsTo
    {
        return $this->hasMany(MovieImageType::class);
    }
}
