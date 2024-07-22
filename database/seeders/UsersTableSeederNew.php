<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeederNew extends Seeder
{
    public function run()
    {
        // Define the number of records to seed
        $numberOfRecords = 100;

        // Seed data for users table
        for ($i = 0; $i < $numberOfRecords; $i++) {
            DB::table('users')->insert([
                'role_id' => rand(2, 4), // Randomly select role ID between 2 and 4
                'first_name' => 'John_' . $i, // Sample first name
                'last_name' => 'Doe_' . $i, // Sample last name
                'username' => 'user_' . $i, // Generate a unique username
                'email' => 'user_' . $i . '@example.com', // Generate a unique email
                'password' => Hash::make('password_' . $i), // Sample password with unique index
                'mobile_number' => '1234567890_' . $i, // Sample mobile number with unique index
                'gender' => $this->randomGender(), // Random gender
                'status' => 'active', // Default status is active
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    // Method to generate random gender
    private function randomGender()
    {
        $genders = ['Male', 'Female', 'Other'];
        return $genders[array_rand($genders)];
    }
}
