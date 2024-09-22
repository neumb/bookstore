<?php

namespace App\DataTransferObjects;

use App\DataTransferObjects\Traits\SerializesProperties;

final readonly class CreateBookData
{
    use SerializesProperties;

    public function __construct(
        public string $title,
        public int $author_id,
        public ?string $annotation,
        public string $published_at,
    ) {}
}
