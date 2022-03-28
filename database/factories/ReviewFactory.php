<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'rating' => $this->faker->numberBetween(1, 10),
            'review' => $this->faker->text,
            'user_id' => User::all()->random()->id,
            'book_id' => Book::all()->random()->id,
        ];
    }
}
