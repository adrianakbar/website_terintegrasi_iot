<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'Akbar',
                'email' => 'owner@gmail.com',
                'role' => 'owner',
                'password' => bcrypt('12345')
            ],
            [
                'name' => 'Rama',
                'email' => 'kepalakandang@gmail.com',
                'role' => 'kepalakandang',
                'password' => bcrypt('12345')
            ]
        ];

        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}
