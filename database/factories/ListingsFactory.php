<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listings>
 */
class ListingsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'tags' => $this->faker->words(3, true),
            'company' => $this->faker->company(),
            'email' => $this->faker->unique()->safeEmail(),
            'location' => $this->faker->address(),
            'website' => $this->faker->url(),
            'description' => $this->faker->paragraph(),

        ];
    }
}
