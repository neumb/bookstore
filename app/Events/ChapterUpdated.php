<?php

namespace App\Events;

use App\Models\Chapter;

final class ChapterUpdated
{
    public function __construct(
        public readonly Chapter $chapter,
    ) {}
}
