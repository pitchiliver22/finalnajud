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
    public function run(): void
    {
        User::create([
            'firstname' => 'admin',
            'middlename' => 'admin',
            'lastname' => 'admin',
            'suffix' => 'NA',
            'email' => 'admin@admin.com',
            'password' => 'admin@2024',
            'role' => 'Admin',
        ]);
    }
}
