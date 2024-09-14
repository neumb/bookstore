<?php

namespace App\Services;

use App\DataTransferObjects\CreateChapterData;
use App\DataTransferObjects\UpdateChapterData;
use App\Events\ChapterCreated;
use App\Events\ChapterUpdated;
use App\Events\ChapterDeleted;
use App\Models\Book;
use App\Models\Chapter;

final class ChapterService
{
    public function createChapter(Book $book, CreateChapterData $data): Chapter
    {
        return tap(new Chapter, function (Chapter $chapter) use ($book, $data): void {
            $chapter->book()->associate($book);
            $chapter->fill($data->toArray());
            $chapter->save();
            event(new ChapterCreated($chapter));
        });
    }

    public function updateChapter(Chapter $chapter, UpdateChapterData $data): Chapter
    {
        $chapter->fill($data->toArray());
        $chapter->save();
        event(new ChapterUpdated($chapter));

        return $chapter;
    }

    public function deleteChapter(Chapter $chapter): void
    {
        $chapter->delete();
        event(new ChapterDeleted($chapter));
    }
}
