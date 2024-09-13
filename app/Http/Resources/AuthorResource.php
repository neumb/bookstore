<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Author
 */
final class AuthorResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->getKey(),
            'name' => $this->name,
            'books_count' => $this->books_count, // TODO: impl
            'information' => $this->information,
            'birthday' => $this->birthday?->format('d-m-Y'),
            'books' => $this->whenLoaded('books'),
        ];
    }
}
