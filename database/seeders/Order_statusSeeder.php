<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order_status;

class Order_statusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order_status::create([
            'stats' => 'order',
        ]);
        Order_status::create([
            'stats' => 'not paied',
        ]);
        Order_status::create([
            'stats' => 'paied',
        ]);
        Order_status::create([
            'stats' => 'canceled',
        ]);
        Order_status::create([
            'stats' => 'done',
        ]);
        Order_status::create([
            'stats' => 'listed',
        ]);
    }
}
