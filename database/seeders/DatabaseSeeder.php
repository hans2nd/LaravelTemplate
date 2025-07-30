<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'nama' => 'Test User',
            'email' => 'test1@example.com',
            'jabatan' => 'Karyawan',
            'password' => Hash::make('123456'),
            'is_tugas' => false
        ]);

        User::create([
            'nama' => 'Administrator',
            'email' => 'test@example.com',
            'jabatan' => 'Admin',
            'password' => Hash::make('123456'),
            'is_tugas' => false
        ]);

        User::create([
            'nama' => 'Test User 2',
            'email' => 'test2@example.com',
            'jabatan' => 'Karyawan',
            'password' => Hash::make('123456'),
            'is_tugas' => false
        ]);
    }
}
