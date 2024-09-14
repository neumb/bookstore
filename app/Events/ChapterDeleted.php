<?php

namespace App\Events;

use App\Models\Chapter;

final class ChapterDeleted
{
    public function __construct(
        public readonly Chapter $chapter,
    ) {}
}
