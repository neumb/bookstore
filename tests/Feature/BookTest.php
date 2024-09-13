<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class BookTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_fetch_paginated_books(): void
    {
        Book::factory()->count(100)->create();

        $response = $this->get(route('books.paginate'))
            //->dump()
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'title',
                        'author' => [
                            'id',
                            'name',
                            'information',
                            'birthday',
                        ],
                        'annotation',
                        'published_at',
                        'created_at',
                        'updated_at',
                    ],
                ],
            ]);
    }
}
