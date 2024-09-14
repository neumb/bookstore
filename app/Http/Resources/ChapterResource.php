<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Chapter
 */
final class ChapterResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->getKey(),
            'title' => $this->title,
            'index' => $this->index,
            'content' => $this->unless(in_array('content', $this->getHidden()), $this->content),
            'book' => BookResource::make($this->whenLoaded('book')),
        ];
    }
}
