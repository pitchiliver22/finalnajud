<?php

namespace Database\Seeders;

use App\Models\address;
use App\Models\previous_school;
use App\Models\register_form;
use App\Models\studentdetails;
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
                'firstname' => 'John',
                'middlename' => 'Sequina',
                'lastname' => 'Batan',
                'suffix' => 'Jr',
                'role' => 'OldStudent',
                'email' => 'john@gmail.com',
                'password' => 'johnrhay',
                'studentdetails' => [
                    'firstname' => 'John',
                    'middlename' => 'Sequina',
                    'lastname' => 'Batan',
                    'suffix' => 'Jr',
                    'nationality' => 'Filipino',
                    'gender' => 'Male',
                    'civilstatus' => 'Single',
                    'birthdate' => '2002-11-23',
                    'birthplace' => 'Cebu City',
                    'religion' => 'Catholic',
                    'mother_name' => 'Joneta Batan',
                    'mother_occupation' => 'Teacher',
                    'mother_contact' => '09950321721',
                    'father_name' => 'JohnJanoy Batan',
                    'father_occupation' => 'Seaman',
                    'father_contact' => '099550321722',
                    'guardian_name' => 'Joneta Batan',
                    'guardian_occupation' => 'Teacher',
                    'guardian_contact' => '09950321721',
                ],
                'address' => [
                    'zipcode' => '6015',
                    'province' => 'Cambinocot Langog',
                    'city' => 'Lapu Lapu City',
                    'barangay' => 'Poblacion',
                    'streetaddress' => 'Babag Dos Skina Naga'
                ],
                'previous_school' => [
                    'second_school_name' => 'University of Cebu Lapu Lapu and Mandaue',
                    'second_last_year_level' => '7',
                    'second_school_year_from' => '2021',
                    'second_school_year_to' => '2022',
                    'second_school_type' => 'Private',
                    'primary_school_name' => 'University of Cebu Lapu Lapu and Mandaue',
                    'primary_last_year_level' => '6',
                    'primary_school_year_from' => '2021',
                    'primary_school_year_to' => '2022',
                    'primary_school_type' => 'Private',
                ]
            ],
            [
                'firstname' => 'Jane',
                'middlename' => 'Doe',
                'lastname' => 'Smith',
                'suffix' => 'Sr',
                'role' => 'OldStudent',
                'email' => 'jane@gmail.com',
                'password' => 'janesmith',

                'studentdetails' => [
                    'firstname' => 'Jane',
                    'middlename' => 'Doe',
                    'lastname' => 'Smith',
                    'suffix' => 'Sr',
                    'nationality' => 'Filipino',
                    'gender' => 'Female',
                    'civilstatus' => 'Married',
                    'birthdate' => '1999-05-15',
                    'birthplace' => 'Cebu City',
                    'religion' => 'Catholic',
                    'mother_name' => 'Mary Smith',
                    'mother_occupation' => 'Nurse',
                    'mother_contact' => '09951122334',
                    'father_name' => 'Robert Smith',
                    'father_occupation' => 'Engineer',
                    'father_contact' => '09952233445',
                    'guardian_name' => 'Mary Smith',
                    'guardian_occupation' => 'Nurse',
                    'guardian_contact' => '09951122334',
                ],
                'address' => [
                    'zipcode' => '6015',
                    'province' => 'Cambinocot Langog',
                    'city' => 'Lapu Lapu City',
                    'barangay' => 'Poblacion',
                    'streetaddress' => 'Babag Dos Skina Naga'
                ],
                'previous_school' => [
                    'second_school_name' => 'University of Cebu Lapu Lapu and Mandaue',
                    'second_last_year_level' => '7',
                    'second_school_year_from' => '2021',
                    'second_school_year_to' => '2022',
                    'second_school_type' => 'Private',
                    'primary_school_name' => 'University of Cebu Lapu Lapu and Mandaue',
                    'primary_last_year_level' => '6',
                    'primary_school_year_from' => '2021',
                    'primary_school_year_to' => '2022',
                    'primary_school_type' => 'Private',
                ]
            ],
            // You can add more users here
        ];

        foreach ($defaultUsers as $userData) {
            // Create the user with only the necessary fields
            $user = User::create([
                'firstname' => $userData['firstname'],
                'middlename' => $userData['middlename'],
                'lastname' => $userData['lastname'],
                'suffix' => $userData['suffix'],
                'role' => $userData['role'],
                'email' => $userData['email'],
                'password' => $userData['password'],
            ]);

            // Create the corresponding register form entry
            $registerForm = register_form::create([
                'user_id' => $user->id,
                'firstname' => $user->firstname,
                'middlename' => $user->middlename,
                'lastname' => $user->lastname,
                'suffix' => $user->suffix,
                'email' => $user->email,
                'status' => 'approved',
                'password' => $user->password
            ]);

            // Create the corresponding student details
            studentdetails::create(array_merge($userData['studentdetails'], ['details_id' => $registerForm->id]));

            // Create the corresponding address
            address::create(array_merge($userData['address'], ['address_id' => $registerForm->id]));

            // Create the corresponding previous school details
            previous_school::create(array_merge($userData['previous_school'], ['school_id' => $registerForm->id]));
        }
    }
}
