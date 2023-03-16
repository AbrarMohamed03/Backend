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
            'firstName' => 'WQEFWEFWF',
            'lastName' => 'vwevwve ',
            'email' => 'pro1@gmail.com',
            'phoneNumber' => '06666666666',
            'password' => random_int(10,20),
            'CIN' => 'X1111111',
            'photo' => ' ',
        ]);
        Pro::create([
            'firstName' => 'WQEFWEFWF',
            'lastName' => 'vwevwve ',
            'email' => 'pro2@gmail.com',
            'phoneNumber' => '06666666666',
            'password' => random_int(10,20),
            'CIN' => 'X222222',
            'photo' => ' ',
        ]);
        Pro::create([
            'firstName' => 'WQEFWEFWF',
            'lastName' => 'vwevwve ',
            'email' => 'pro3@gmail.com',
            'phoneNumber' => '06666666666',
            'password' => random_int(10,20),
            'CIN' => 'X333333',
            'photo' => ' ',
        ]);
        Pro::create([
            'firstName' => 'WQEFWEFWF',
            'lastName' => 'vwevwve ',
            'email' => 'pro4@gmail.com',
            'phoneNumber' => '06666666666',
            'password' => random_int(10,20),
            'CIN' => 'X44444444',
            'photo' => ' ',
        ]);
    }
}
