<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Queries\BookQueries;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class BookController extends Controller
{
    public function index(BookQueries $queries): AnonymousResourceCollection
    {
        return BookResource::collection($queries->paginateQuery()->paginate());
    }

    public function store(StoreBookRequest $request): BookResource
    {
        $book = tap(new Book, function (Book $book) use ($request): void {
            $book->fill($request->safe()->all());
            $book->save();
        });

        return tap(BookResource::make($book))->load('author');
    }

    public function update(UpdateBookRequest $request, Book $book): BookResource
    {
        $book = tap($book, function (Book $book) use ($request): void {
            $book->fill($request->safe()->all());
            $book->save();
        });

        return tap(BookResource::make($book))->load('author');
    }

    public function show(Book $book): BookResource
    {
        return tap(BookResource::make($book))->load('author');
    }
}
