<?php

namespace App\Queries;

use App\Models\Book;
use Illuminate\Database\Eloquent\Builder;

final class BookQueries
{
    /**
     * @return Builder<Book>
     */
    public function paginateQuery(): Builder
    {
        return Book::query()
            ->with('author')
            ->latest();
    }
}
