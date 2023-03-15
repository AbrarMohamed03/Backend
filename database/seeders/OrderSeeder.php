<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::create([
            'tourist_id' => 1,
            'service_id' => 1,
            'status_id' => 1,
        ]);
        Order::create([
            'tourist_id' => 2,
            'service_id' => 2,
            'status_id' => 1,
        ]);
        Order::create([
            'tourist_id' => 3,
            'service_id' => 4,
            'status_id' => 1,
        ]);
    }
}
