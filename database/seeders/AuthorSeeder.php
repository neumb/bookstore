<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

final class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        Author::factory()
            ->count(100)
            ->create();
    }
}
