<?php

namespace App\Http\Resources\V1\Movie\Image;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexMovieImageResource extends JsonResource
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
            'type_id' => $this->type_id,
            'file_path' => $this->file_path,
            'width' => $this->width,
            'height' => $this->height,
            'created_at' => $this->created_at,

            'type' => new IndexMovieImageTypeResource
            (
                $this->whenLoaded('type')
            )
        ];
    }
}
