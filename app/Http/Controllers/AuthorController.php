<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use App\Queries\AuthorQueries;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

final class AuthorController extends Controller
{
    public function index(AuthorQueries $queries): LengthAwarePaginator
    {
        return $queries->paginateQuery()->paginate();
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

    public function show(Author $author): void
    {
        //
    }

    public function update(Request $request, Author $author): void
    {
        //
    }

    public function destroy(Author $author): void
    {
        //
    }
}
