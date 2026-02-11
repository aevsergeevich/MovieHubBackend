<?php

namespace App\Http\Resources\V1\Movie;

use App\Http\Resources\V1\Genre\IndexGenreResource;
use App\Http\Resources\V1\Movie\Cast\IndexMovieCastResource;
use App\Http\Resources\V1\Movie\Crew\IndexMovieCrewResource;
use App\Http\Resources\V1\Movie\Image\IndexMovieImageResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowMovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'tmdb_id' => $this->tmdb_id,
            'title' => $this->title,
            'slug' => $this->slug,
            'overview' => $this->overview,
            'poster_path' => $this->poster_path,
            'release_date' => $this->release_date,

            'genres' => IndexGenreResource::collection
            (
                $this->whenLoaded('genres')
            ),

            'casts' => IndexMovieCastResource::collection
            (
                $this->whenLoaded('actors')
            ),

            'crews' => IndexMovieCrewResource::collection
            (
                $this->whenLoaded('crews')
            ),

            'images' => IndexMovieImageResource::collection
            (
                $this->whenLoaded('images')
            )
        ];
    }
}
