<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

final class BookSeeder extends Seeder
{
    public function run(): void
    {
        Book::factory()->count(100)->create();
    }
}
