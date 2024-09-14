<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Chapter;

final class CharsCounterService
{
    public function __invoke(Book $book): int
    {
        return $book->chapters->sum(function (Chapter $chapter): int {
            return mb_strlen($chapter->content);
        });
    }
}
