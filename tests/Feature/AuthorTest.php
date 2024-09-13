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
    public function test_can_create_a_new_author_with_valid_attributes(string $name, ?string $info, ?string $birthday): void
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
            ])
            ->assertJson([
                'data' => [
                    'name' => $name,
                    'information' => $info,
                    'birthday' => $birthday,
                ],
            ]);
    }

    #[DataProvider('valid_data_provider')]
    public function test_can_update_an_existing_author_with_valid_attributes(string $name, ?string $info, ?string $birthday): void
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
            ])
            ->assertJson([
                'data' => [
                    'name' => $name,
                    'information' => $info,
                    'birthday' => $birthday,
                ],
            ]);
    }

    public function test_can_view_an_existing_author(): void
    {
        $author = Author::factory()->create();

        $this->getJson(route('authors.show', $author))
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'information',
                    'birthday',
                    'books_count',
                ],
            ]);
    }

    /**
     * @return Generator<array{string,?string,?\DateTimeInterface}>
     */
    public static function valid_data_provider(): \Generator
    {
        yield ['Fyodor Dostoevsky', 'Born in Moscow in 1821, Dostoevsky was introduced to literature at an early age through fairy tales and legends, and through books by Russian and foreign authors. His mother died in 1837 when he was 15, and around the same time, he left school to enter the Nikolayev Military Engineering Institute.', '11-11-1821'];

        yield ['Mikhail Lermontov', 'Lermontov was born on October 15, 1814 in Moscow into the Lermontov family and grew up in Tarkhany. Lermontov\'s father, Yuri Petrovich, was a military officer who married Maria Mikhaylovna Arsenyeva, a young heiress from an aristocratic family.', '15-10-1814'];

        yield ['Mikhail Bulgakov', null, null];
    }
}
