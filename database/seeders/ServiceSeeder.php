<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::create([
            'pro_id' => 1,
        ]);
        Service::create([
            'pro_id' => 2,
        ]);
        Service::create([
            'pro_id' => 3,
        ]);
        Service::create([
            'pro_id' => 4,
        ]);
    }
}
