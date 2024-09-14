<?php

namespace App\Services;

use App\DataTransferObjects\CreateChapterData;
use App\DataTransferObjects\UpdateChapterData;
use App\Events\ChapterCreated;
use App\Events\ChapterDeleted;
use App\Events\ChapterUpdated;
use App\Models\Book;
use App\Models\Chapter;

final class ChapterService
{
    public function __construct(
        private readonly CharsCounterService $charsCounter,
    ) {}

    public function createChapter(Book $book, CreateChapterData $data): Chapter
    {
        return tap(new Chapter, function (Chapter $chapter) use ($book, $data): void {
            $chapter->book()->associate($book);
            $chapter->fill($data->toArray());
            $chapter->save();

            $this->recalculateBookChars($book);

            event(new ChapterCreated($chapter));
        });
    }

    public function updateChapter(Chapter $chapter, UpdateChapterData $data): Chapter
    {
        $chapter->fill($data->toArray());
        $chapter->save();

        $this->recalculateBookChars($chapter->book);

        event(new ChapterUpdated($chapter));

        return $chapter;
    }

    public function deleteChapter(Chapter $chapter): void
    {
        $chapter->delete();

        $this->recalculateBookChars($chapter->book);

        event(new ChapterDeleted($chapter));
    }

    private function recalculateBookChars(Book $book): void
    {
        $book->chars_count = ($this->charsCounter)($book);
        $book->save();
    }
}
