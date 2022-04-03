<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PublisherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName.' Publisher',
            'address' => $this->faker->address,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'image_url' => $this->faker->imageUrl,
        ];
    }
}
