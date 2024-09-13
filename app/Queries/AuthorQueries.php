<?php

namespace App\Queries;

use App\Models\Author;
use Illuminate\Database\Eloquent\Builder;

final class AuthorQueries
{
    /**
     * @return Builder<Author>
     */
    public function paginateQuery(): Builder
    {
        return Author::query()
            ->withCount('books')
            ->orderBy('books_count');
    }
}
