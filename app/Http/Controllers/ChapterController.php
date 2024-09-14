<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChapterRequest;
use App\Http\Requests\UpdateChapterRequest;
use App\Http\Resources\ChapterResource;
use App\Models\Book;
use App\Models\Chapter;
use App\Services\ChapterService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

final class ChapterController extends Controller
{
    public function store(StoreChapterRequest $request, ChapterService $service, Book $book): ChapterResource
    {
        return ChapterResource::make(
            $service->createChapter($book, $request->resolveData())
        );
    }

    public function list(Book $book): AnonymousResourceCollection
    {
        return ChapterResource::collection(
            $book->chapters
        );
    }

    public function show(Book $book, Chapter $chapter): ChapterResource
    {
        return ChapterResource::make($chapter);
    }

    public function update(UpdateChapterRequest $request, ChapterService $service, Book $book, Chapter $chapter): ChapterResource
    {
        return ChapterResource::make(
            $service->updateChapter($chapter, $request->resolveData())
        );
    }

    public function destroy(ChapterService $service, Book $book, Chapter $chapter): Response
    {
        $service->deleteChapter($chapter);

        return response(status: 204);
    }
}
