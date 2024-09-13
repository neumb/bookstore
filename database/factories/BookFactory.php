<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
final class BookFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->name(),
            'author_id' => Author::factory(),
            'annotation' => fake()->text(),
            'published_at' => fake()->dateTimeBetween('-40 years', '-10 years'),
        ];
    }
}
