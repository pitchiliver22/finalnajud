<?php

namespace Database\Seeders;

use App\Models\assessment;
use App\Models\attendance;
use App\Models\classes;
use App\Models\corevalues;
use App\Models\grade;
use App\Models\payment_form;
use App\Models\previous_primary;
use App\Models\previous_school;
use App\Models\previous_secondary;
use App\Models\register_form;
use App\Models\required_docs;
use App\Models\school_year;
use App\Models\studentdetails;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        assessment::factory()->create();
        attendance::factory()->create();
        classes::factory()->create();
        corevalues::factory()->create();
        grade::factory()->create();
        payment_form::factory()->create();
        previous_school::factory()->create();
        previous_school::factory()->create();
        register_form::factory()->create();
        required_docs::factory()->create();
        school_year::factory()->create();
        studentdetails::factory()->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
