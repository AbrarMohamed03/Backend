<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Service;
use App\Models\Type_rental;
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
            'desc' => fake()->sentence(),
            'adress' => fake()->address(),
            'bedrooms' => fake()->numberBetween(2,5),
            'bathrooms' => fake()->numberBetween(2,5),
            'max_persons' => fake()->numberBetween(2,5),
            'price_per_night' => fake()->numberBetween(300,500),
            'service_id' => Service::all()->random()->id,
            'type_id' => Type_rental::all()->random()->id,
            'city_id' => City::all()->random()->id,
        ];
    }
}
