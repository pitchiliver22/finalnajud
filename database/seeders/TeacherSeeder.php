<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultUsers = [
            [
                'firstname' => 'Teacher1',
                'middlename' => 'Te',
                'lastname' => 'Acher',
                'suffix' => 'Jr',
                'role' => 'Teacher',
                'email' => 'teacher1@gmail.com',
                'password' => 'teacher12345', 
            ],
            [
                'firstname' => 'Teacher2',
                'middlename' => 'Te',
                'lastname' => 'Acher',
                'suffix' => 'Jr',
                'role' => 'Teacher',
                'email' => 'teacher2@gmail.com',
                'password' => 'teacher12345',
            ],
            [
                'firstname' => 'Teacher3',
                'middlename' => 'Te',
                'lastname' => 'Acher',
                'suffix' => 'Jr',
                'role' => 'Teacher',
                'email' => 'teacher3@gmail.com',
                'password' => 'teacher12345',
            ],
            [
                'firstname' => 'Teacher4',
                'middlename' => 'Te',
                'lastname' => 'Acher',
                'suffix' => 'Jr',
                'role' => 'Teacher',
                'email' => 'teacher4@gmail.com',
                'password' => 'teacher12345',
            ],
            [
                'firstname' => 'Teacher5',
                'middlename' => 'Te',
                'lastname' => 'Acher',
                'suffix' => 'Jr',
                'role' => 'Teacher',
                'email' => 'teacher5@gmail.com',
                'password' => 'teacher12345',
            ],
        ];

        foreach ($defaultUsers as $userData) {
            User::create($userData); 
        }
    }
}
