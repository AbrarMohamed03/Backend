<?php

namespace Database\Factories;

use App\Models\Order_status;
use App\Models\Service;
use App\Models\Tourist;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tourist_id' => Tourist::all()->random()->id,
            'service_id' => Service::all()->random()->id,
            'status_id' => Order_status::all()->random()->id,

            // 'tourist_id' => fake()->numberBetween(0,10),
            // 'service_id' => fake()->numberBetween(0,10),
            // 'status_id' => fake()->numberBetween(0,10),
        ];
    }
}
