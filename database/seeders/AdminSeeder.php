<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'username' => 'admin1',
            'email' => 'admin1@gmail.com',
            'password' => random_int(10,20),
        ]);
        Admin::create([
            'username' => 'admin2',
            'email' => 'admin2@gmail.com',
            'password' => random_int(10,20),
        ]);
        Admin::create([
            'username' => 'admin3',
            'email' => 'admin3@gmail.com',
            'password' => random_int(10,20),
        ]);
    }
}
