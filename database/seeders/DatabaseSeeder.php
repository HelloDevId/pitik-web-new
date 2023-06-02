<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        Role::create([
            'nama' => 'Super Admin',
        ]);

        Role::create([
            'nama' => 'Admin',
        ]);

        User::create([
            'nama' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('1'),
            'id_role' => 1,
        ]);

        User::create([
            'nama' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('1'),
            'id_role' => 2,
        ]);

    }
}