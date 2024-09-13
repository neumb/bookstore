<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use App\Queries\AuthorQueries;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class AuthorController extends Controller
{
    public function index(AuthorQueries $queries): AnonymousResourceCollection
    {
        return AuthorResource::collection($queries->paginateQuery()->paginate());
    }

    public function store(StoreAuthorRequest $request): AuthorResource
    {
        // TODO: move logic to dedicated service
        $author = tap(new Author, function (Author $author) use ($request): void {
            $author->fill($request->safe()->all());
            $author->save();
        });

        return AuthorResource::make($author);
    }

    public function show(Author $author): AuthorResource
    {
        return tap(AuthorResource::make($author))->load('books');
    }

    public function update(UpdateAuthorRequest $request, Author $author): AuthorResource
    {
        $author = tap($author, function (Author $author) use ($request): void {
            $author->fill($request->safe()->all());
            $author->save();
        });

        return AuthorResource::make($author);
    }
}
