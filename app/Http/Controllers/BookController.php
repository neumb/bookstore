<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Queries\BookQueries;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class BookController extends Controller
{
    public function index(BookQueries $queries): AnonymousResourceCollection
    {
        return BookResource::collection($queries->paginateQuery()->paginate());
    }
}
