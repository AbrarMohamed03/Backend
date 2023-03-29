<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\Type_activitie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activitie>
 */
class ActivitieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'desc' => fake()->sentence(),
            'location' => fake()->sentence(),
            'duration' => fake()->numberBetween(2,5),
            'duration_type' => fake()->randomLetter(),
            'price_per_person' => fake()->numberBetween(2,5),
            'service_id' => Service::all()->random()->id,
            'type_id' => Type_activitie::all()->random()->id,
        ];
    }
}
