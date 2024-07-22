<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'Super Admin', 'status' => 'active'],
            ['name' => 'Sub Admin', 'status' => 'active'],
            ['name' => 'Agent', 'status' => 'active'],
            ['name' => 'User', 'status' => 'active'],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->insert([
                'name' => $role['name'],
                'status' => $role['status'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
