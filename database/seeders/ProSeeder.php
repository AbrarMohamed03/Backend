<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pro;


class ProSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pro::create([
            'email' => 'pro1@gmail.com',
            'phone' => '06666666666',
            'password' => random_int(10,20),
            'CIN' => 'X1111111',
        ]);
        Pro::create([
            'email' => 'pro2@gmail.com',
            'phone' => '06666666666',
            'password' => random_int(10,20),
            'CIN' => 'X222222',
        ]);
        Pro::create([
            'email' => 'pro3@gmail.com',
            'phone' => '06666666666',
            'password' => random_int(10,20),
            'CIN' => 'X333333',
        ]);
        Pro::create([
            'email' => 'pro4@gmail.com',
            'phone' => '06666666666',
            'password' => random_int(10,20),
            'CIN' => 'X44444444',
        ]);
    }
}
