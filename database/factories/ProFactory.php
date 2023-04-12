<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pro>
 */
class ProFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'firstName' => fake()->name(),
            'lastName' => fake()->name(),
            'email' => fake()->email(),
            'phoneNumber' => fake()->phoneNumber(),
            'password' => fake()->password(),
            'CIN' => fake()->sentence(),
            'CIN_photo' => fake()->sentence(),
            'verified' => fake()->boolean(),
            'photo' => fake()->sentence(),
        ];
    }
}
