<?php

use App\Http\Controllers\AuthorController;
use Illuminate\Support\Facades\Route;

Route::get('/authors', [AuthorController::class, 'index'])->name('authors.paginate');
Route::post('/authors', [AuthorController::class, 'store'])->name('authors.store');
Route::patch('/authors/{author}', [AuthorController::class, 'update'])->name('authors.update');
