<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rental;

class RentalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rental::create([
            'name' => 'house 1',
            'type' => 'house',
            'desc' => 'good house',
            'adress' => 'lkjb lilg libliu',
            'bedrooms' => 2,
            'bathrooms' => 2,
            'max_persons' => 3,
            'price_per_night' => 100,
            'service_id' => 1,
        ]);
        Rental::create([
            'name' => 'house 2',
            'type' => 'house',
            'desc' => 'good house',
            'adress' => 'lkjb lilg libliu',
            'bedrooms' => 2,
            'bathrooms' => 2,
            'max_persons' => 3,
            'price_per_night' => 100,
            'service_id' => 2,
        ]);
    }
}
