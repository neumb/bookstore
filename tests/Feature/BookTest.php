<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\Book;
use Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
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

    #[DataProvider('valid_data_provider')]
    public function test_can_create_a_new_book_with_valid_attributes(string $title, string $authorName, string $publishedAt, ?string $annotation): void
    {
        $author = Author::factory()->create(['name' => $authorName]);

        $this->postJson(route('books.store'), [
            'title' => $title,
            'author_id' => $author->getKey(),
            'published_at' => $publishedAt,
            'annotation' => $annotation,
        ])
            ->assertCreated()
            ->assertJsonStructure([
                'data' => [
                    'title',
                    'author' => [
                        'name',
                    ],
                    'published_at',
                    'annotation',
                ],
            ])
            ->assertJson([
                'data' => [
                    'title' => $title,
                    'author' => [
                        'name' => $authorName,
                    ],
                    'published_at' => $publishedAt,
                    'annotation' => $annotation,
                ],
            ]);
    }

    /**
     * @return Generator<string,array{string,string,string,string}>
     */
    public static function valid_data_provider(): \Generator
    {
        yield 'The Great Gatsby' => [
            'The Great Gatsby',
            'F. Scott Fitzgerald',
            '10-04-1925',
            'A novel set in the Roaring Twenties that tells the story of Jay Gatsby and his unrequited love for Daisy Buchanan.',
        ];

        yield 'To Kill a Mockingbird' => [
            'To Kill a Mockingbird',
            'Harper Lee',
            '11-07-1960',
            'A novel about the serious issues of rape and racial inequality, narrated by a young girl named Scout Finch.',
        ];

        yield '1984' => [
            '1984',
            'George Orwell',
            '08-06-1949',
            'A dystopian novel that explores the dangers of totalitarianism and extreme political ideology.',
        ];

        yield 'Pride and Prejudice' => [
            'Pride and Prejudice',
            'Jane Austen',
            '28-01-1813',
            'A romantic novel that critiques the British landed gentry at the end of the 18th century through the lens of Elizabeth Bennet.',
        ];

        yield 'Moby Dick' => [
            'Moby Dick',
            'Herman Melville',
            '18-10-1851',
            'A novel about the voyage of the whaling ship Pequod, led by Captain Ahab, who is obsessed with hunting the giant white whale, Moby Dick.',
        ];
    }
}
