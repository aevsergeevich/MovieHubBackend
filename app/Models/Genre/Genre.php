<?php

namespace App\Models\Genre;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = ['tmdb_id', 'name'];
}
