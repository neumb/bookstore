<?php

namespace App\Events;

use App\Models\Chapter;

final class ChapterCreated
{
    public function __construct(
        public readonly Chapter $chapter,
    ) {}
}
