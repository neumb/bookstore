<?php

namespace Tests\Feature;

use App\Models\Author;
use Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

final class AuthorTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_fetch_paginated_authors(): void
    {
        Author::factory()->count(100)->create();

        $response = $this->get(route('authors.paginate'))
            //->dump()
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'information',
                        'birthday',
                    ],
                ],
            ]);
    }

    #[DataProvider('valid_data_provider')]
    public function test_can_create_a_new_author_with_valid_attributes(string $name, ?string $info, ?\DateTimeInterface $birthday): void
    {
        $this->postJson(route('authors.store'), [
            'name' => $name,
            'information' => $info,
            'birthday' => $birthday,
        ])
            ->assertCreated()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'information',
                    'birthday',
                ],
            ]);
    }

    #[DataProvider('valid_data_provider')]
    public function test_can_update_an_existing_author_with_valid_attributes(string $name, ?string $info, ?\DateTimeInterface $birthday): void
    {
        $author = Author::factory()->create();

        $this->patchJson(route('authors.update', $author), [
            'name' => $name,
            'information' => $info,
            'birthday' => $birthday,
        ])
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'information',
                    'birthday',
                ],
            ]);
    }

    /**
     * @return Generator<array{string,?string,?\DateTimeInterface}>
     */
    public static function valid_data_provider(): \Generator
    {
        yield ['Fyodor Dostoevsky', null, null];
    }
}
