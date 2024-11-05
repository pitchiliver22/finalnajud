<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultUsers = [
            [
                'firstname' => 'Default',
                'lastname' => 'Teacher',
                'middlename' => 'A',
                'suffix' => '',
                'role' => 'Teacher',
                'email' => 'teacher@example.com',
                'password' => Hash::make('teacher123'),
            ],
            [
                'firstname' => 'Default',
                'lastname' => 'Principal',
                'middlename' => 'B',
                'suffix' => '',
                'role' => 'Principal',
                'email' => 'principal@example.com',
                'password' => Hash::make('principal123'),
            ],
            [
                'firstname' => 'Default',
                'lastname' => 'Cashier',
                'middlename' => 'C',
                'suffix' => '',
                'role' => 'Cashier',
                'email' => 'cashier@example.com',
                'password' => Hash::make('cashier123'),
            ],
            [
                'firstname' => 'Default',
                'lastname' => 'Record',
                'middlename' => 'D',
                'suffix' => '',
                'role' => 'Record',
                'email' => 'record@example.com',
                'password' => Hash::make('record123'),
            ],
            [
                'firstname' => 'Default',
                'lastname' => 'Accounting',
                'middlename' => 'E',
                'suffix' => '',
                'role' => 'Accounting',
                'email' => 'accounting@example.com',
                'password' => Hash::make('accounting123'),
            ],


        ];

        foreach ($defaultUsers as $user) {
            User::create($user);
        }
    }
}
