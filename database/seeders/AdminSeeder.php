<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
        public function run() {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => 'admin123',
                'role' => 'admin',
                'approved' => true,
            ]);
        }
}
