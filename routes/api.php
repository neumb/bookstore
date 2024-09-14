<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ChapterController;
use Illuminate\Support\Facades\Route;

Route::get('/authors', [AuthorController::class, 'index'])->name('authors.paginate');
Route::get('/authors/{author}', [AuthorController::class, 'show'])->name('authors.show');
Route::post('/authors', [AuthorController::class, 'store'])->name('authors.store');
Route::patch('/authors/{author}', [AuthorController::class, 'update'])->name('authors.update');

Route::get('/books', [BookController::class, 'index'])->name('books.paginate');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
Route::post('/books', [BookController::class, 'store'])->name('books.store');
Route::patch('/books/{book}', [BookController::class, 'update'])->name('books.update');

Route::get('/books/{book}/chapters', [ChapterController::class, 'list'])->name('chapters.list');
Route::post('/books/{book}/chapters', [ChapterController::class, 'store'])->name('chapters.store');
Route::get('/books/{book}/chapters/{chapter}', [ChapterController::class, 'show'])->name('chapters.show');
Route::patch('/books/{book}/chapters/{chapter}', [ChapterController::class, 'update'])->name('chapters.update');
Route::delete('/books/{book}/chapters/{chapter}', [ChapterController::class, 'destroy'])->name('chapters.destroy');
