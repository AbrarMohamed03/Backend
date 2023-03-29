<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type_activitie;


class Activitie_typeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Type_activitie::create([
            'name' => 'Rent House'
        ]);

        Type_activitie::create([
            'name' => 'Events'
        ]);

        Type_activitie::create([
            'name' => 'Restorants'
        ]);

        Type_activitie::create([
            'name' => 'Animal Parks'
        ]);
    }
}
