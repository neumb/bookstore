<?php

namespace App\DataTransferObjects;

use App\DataTransferObjects\Traits\SerializesProperties;

final readonly class UpdateChapterData
{
    use SerializesProperties;

    public function __construct(
        public string $title,
        public string $content,
        public int $index,
    ) {}
}
