<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rental>
 */
class RentalFactory extends Factory
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
            'type' => fake()->sentence(),
            'desc' => fake()->sentence(),
            'adress' => fake()->address(),
            'bedrooms' => fake()->numberBetween(2,5),
            'bathrooms' => fake()->numberBetween(2,5),
            'max_persons' => fake()->numberBetween(2,5),
            'price_per_night' => fake()->numberBetween(300,500),
            'service_id' => Service::all()->random()->id,
            'houseType' => fake()->randomElement(['appertment','house','villa','riad','motel','hotel','room']),
            'city' => fake()->randomElement(['agadir','rabat','tanger','casablanca','marakech','essouira','mohamedia'])
        ];
    }
}
