<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class ChapterTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_view_an_existing_book(): void
    {
        $chapter = Chapter::factory()->create();

        $this->getJson(route('chapters.show', ['book' => $chapter->book, 'chapter' => $chapter]))
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'title',
                    'content',
                    'index',
                ],
            ]);
    }

    public function test_can_create_a_new_chapter_in_a_book(): void
    {
        $book = Book::factory()->create();

        $this->getJson(route('books.show', $book))
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'chars_count',
                ],
            ])
            ->assertJson([
                'data' => [
                    'chars_count' => 0,
                ],
            ]);

        $this->postJson(route('chapters.store', ['book' => $book]), $payload = [
            'title' => fake()->text(100),
            'content' => fake()->text(10000),
            'index' => 0,
        ])
            ->assertCreated()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'title',
                    'content',
                    'index',
                ],
            ])
            ->assertJson([
                'data' => [
                    'title' => $payload['title'],
                    'content' => $payload['content'],
                    'index' => $payload['index'],
                ],
            ]);

        $this->getJson(route('books.show', $book))
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'chars_count',
                ],
            ])
            ->assertJson([
                'data' => [
                    'chars_count' => mb_strlen($payload['content']),
                ],
            ]);
    }

    public function test_can_update_an_existing_chapter(): void
    {
        $chapter = Chapter::factory()->create();

        $chapter->book->chars_count = 9999;
        $chapter->book->save();

        $this->getJson(route('books.show', $chapter->book))
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'chars_count',
                ],
            ])
            ->assertJson([
                'data' => [
                    'chars_count' => 9999,
                ],
            ]);

        $this->patchJson(route('chapters.update', ['book' => $chapter->book, 'chapter' => $chapter]), $payload = [
            'title' => fake()->text(100),
            'content' => fake()->text(10000),
            'index' => 0,
        ])
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'title',
                    'content',
                    'index',
                ],
            ])
            ->assertJson([
                'data' => [
                    'title' => $payload['title'],
                    'content' => $payload['content'],
                    'index' => $payload['index'],
                ],
            ]);

        $this->getJson(route('books.show', $chapter->book))
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'chars_count',
                ],
            ])
            ->assertJson([
                'data' => [
                    'chars_count' => mb_strlen($payload['content']),
                ],
            ]);
    }

    public function test_can_delete_an_existing_chapter(): void
    {
        $chapter = Chapter::factory()->create();
        $chapter->book->chars_count = 9999;
        $chapter->book->save();

        $this->getJson(route('books.show', $chapter->book))
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'chars_count',
                ],
            ])
            ->assertJson([
                'data' => [
                    'chars_count' => 9999,
                ],
            ]);

        $this->deleteJson(route('chapters.destroy', ['book' => $chapter->book, 'chapter' => $chapter]))
            ->assertNoContent();

        $this->getJson(route('chapters.show', ['book' => $chapter->book, 'chapter' => $chapter]))
            ->assertNotFound();

        $this->getJson(route('books.show', $chapter->book))
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'chars_count',
                ],
            ])
            ->assertJson([
                'data' => [
                    'chars_count' => 0,
                ],
            ]);
    }
}
