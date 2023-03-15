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
            'username' => 'tourist1',
            'password' => random_int(10,20),
            'email' => 'tourist1@gmail.com',
            'first_name' =>'kakbcab',
            'last_name' => 'qlieihafih',
            'phone_number' => '06666666666666666',
            'photo' => ' ',
        ]);
        Tourist::create([
            'username' => 'tourist2',
            'password' => random_int(10,20),
            'email' => 'tourist2@gmail.com',
            'first_name' =>'sfgwef',
            'last_name' => 'wefwef',
            'phone_number' => '06666666666666666',
            'photo' => ' ',
        ]);
        Tourist::create([
            'username' => 'tourist3',
            'password' => random_int(10,20),
            'email' => 'tourist3@gmail.com',
            'first_name' =>'qwrqwd',
            'last_name' => 'qwedqwd',
            'phone_number' => '06666666666666666',
            'photo' => ' ',
        ]);
    }
}
