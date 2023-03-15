<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Activitie;

class ActivitieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Activitie::create([
            'name' => 'surf',
            'desc' => 'surf in taghazot',
            'location' => 'lkjb lilg libliu',
            'duration' => 1,
            'duration_type' => 'day',
            'price_per_person' => 500,
            'service_id' => 3,
        ]);
        Activitie::create([
            'name' => 'surf',
            'desc' => 'surf in tamraght',
            'location' => 'lkjb lilg libliu',
            'duration' => 1,
            'duration_type' => 'day',
            'price_per_person' => 300,
            'service_id' => 4,
        ]);
    }
}
