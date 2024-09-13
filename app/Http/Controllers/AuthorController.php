<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Queries\AuthorQueries;
use Illuminate\Http\Request;

final class AuthorController extends Controller
{
    public function index(AuthorQueries $queries)
    {
        return $queries->paginateQuery()->paginate();
    }

    public function store(Request $request)
    {
    }

    public function show(Author $author)
    {
        //
    }

    public function update(Request $request, Author $author)
    {
        //
    }

    public function destroy(Author $author)
    {
        //
    }
}
