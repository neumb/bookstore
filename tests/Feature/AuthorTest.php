<?php

namespace Tests\Feature;

use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class AuthorTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_fetch_paginated_authors(): void
    {
        Author::factory()->count(100)->create();

        $response = $this->get('/api/authors')
            //->dump()
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'information',
                        'birthday',
                    ]
                ]
            ]);
    }
}
