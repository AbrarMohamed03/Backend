<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call(ProSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(Order_statusSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(RentalSeeder::class);
        $this->call(ActivitieSeeder::class);
        $this->call(TouristSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(ReviewSeeder::class);
    }
}
