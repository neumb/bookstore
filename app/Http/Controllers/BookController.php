<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Queries\BookQueries;
use App\Services\BookService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class BookController extends Controller
{
    public function index(BookQueries $queries): AnonymousResourceCollection
    {
        return BookResource::collection(
            $queries->paginateQuery()->paginate(
                perPage: 10 // TODO: move to a config file
            )
        );
    }

    public function store(StoreBookRequest $request, BookService $service): BookResource
    {
        return tap(BookResource::make(
            $service->createBook($request->resolveData()))
        )->load('author');
    }

    public function update(UpdateBookRequest $request, BookService $service, Book $book): BookResource
    {
        return tap(BookResource::make(
            $service->updateBook($book, $request->resolveData()))
        )->load('author');
    }

    public function show(Book $book): BookResource
    {
        return tap(BookResource::make($book))->load('author', 'chapters');
    }
}
