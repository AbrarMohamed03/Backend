<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\Tourist;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'rate' => fake()->numberBetween(0,5),
            'comment' => fake()->sentence(),
            'service_id' => Service::all()->random()->id,
            'tourist_id' => Tourist::all()->random()->id,
        ];
    }
}
