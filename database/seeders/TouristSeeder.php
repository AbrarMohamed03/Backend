<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tourist;

class TouristSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tourist::create([
            'password' => random_int(10,20),
            'email' => 'tourist1@gmail.com',
            'firstName' =>'kakbcab',
            'lastName' => 'qlieihafih',
            'phoneNumber' => '06666666666666666',
            'photo' => ' ',
        ]);
        Tourist::create([
            'password' => random_int(10,20),
            'email' => 'tourist2@gmail.com',
            'firstName' =>'sfgwef',
            'lastName' => 'wefwef',
            'phoneNumber' => '06666666666666666',
            'photo' => ' ',
        ]);
        Tourist::create([
            'password' => random_int(10,20),
            'email' => 'tourist3@gmail.com',
            'firstName' =>'qwrqwd',
            'lastName' => 'qwedqwd',
            'phoneNumber' => '06666666666666666',
            'photo' => ' ',
        ]);
    }
}
