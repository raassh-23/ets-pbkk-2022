<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'synopsis' => $this->faker->paragraph,
            'edition' => $this->faker->numberBetween(1, 10),
            'publish_year' => $this->faker->year,
            'cover_image' => $this->faker->imageUrl,
            'isbn' => $this->faker->isbn13,
            'category_id' => Category::all()->random()->id,
            'publisher_id' => Publisher::all()->random()->id,
        ];
    }
}
