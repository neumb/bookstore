<?php

namespace App\Http\Controllers;

use App\Queries\BookQueries;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class BookController extends Controller
{
    public function index(BookQueries $queries): LengthAwarePaginator
    {
        return $queries->paginateQuery()->paginate();
    }
}
