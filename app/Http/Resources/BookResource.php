<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Book
 */
final class BookResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->getKey(),
            'title' => $this->title,
            'annotation' => $this->annotation,
            'author' => $this->whenLoaded('author'),
            'published_at' => $this->published_at?->format('d-m-Y'),
            'chars_count' => $this->chars_count,
            'chapters' => ChapterResource::collection($this->whenLoaded('chapters')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
