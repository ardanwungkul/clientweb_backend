<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make(12345678),
            'role' => 'admin'
        ]);
        // User::factory()->create([
        //     'name' => 'Ardan',
        //     'email' => 'ardanwungkul143@gmail.com',
        //     'password' => Hash::make(12345678),
        //     'role' => 'karyawan'
        // ]);
        // User::factory()->create([
        //     'name' => 'Arya',
        //     'email' => 'arya@gmail.com',
        //     'password' => Hash::make(12345678),
        //     'role' => 'karyawan'
        // ]);
        // User::factory()->create([
        //     'name' => 'Kurnia',
        //     'email' => 'kurnia@gmail.com',
        //     'password' => Hash::make(12345678),
        //     'role' => 'pkl'
        // ]);
    }
}
