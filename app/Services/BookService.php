<?php

namespace App\Services;

use App\DataTransferObjects\CreateBookData;
use App\DataTransferObjects\UpdateBookData;
use App\Models\Book;

final class BookService
{
    public function createBook(CreateBookData $data): Book
    {
        return tap(new Book, function (Book $book) use ($data): void {
            $book->fill($data->toArray());
            $book->save();
        });
    }

    public function updateBook(Book $book, UpdateBookData $data): Book
    {
        return tap($book, function (Book $book) use ($data): void {
            $book->fill($data->toArray());
            $book->save();
        });
    }
}
