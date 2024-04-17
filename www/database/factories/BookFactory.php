<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    protected $model = Book::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title(),
            'publisher' => fake()->randomElement(['published', 'draft', 'removed']),
            'author' => fake()->name,
            'genre' => fake()->randomElement(['science', 'fantasy', 'novel']),
            'publicationDate' => fake()->date('Y-m-d h:i:s'),
            'amountWords' => fake()->randomDigit(),
            'price' => fake()->randomFloat(2,1,4),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
