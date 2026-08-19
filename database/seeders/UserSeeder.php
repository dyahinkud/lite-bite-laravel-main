<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('users')->insert([
            [
                'id' => 1,
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'created_at' => '2025-06-15 03:57:55',
                'updated_at' => '2025-06-15 03:57:55',
            ],
            [
                'id' => 2,
                'username' => 'Angga',
                'email' => 'angga@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 3,
                'username' => 'Budi',
                'email' => 'budi@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 4,
                'username' => 'Citra',
                'email' => 'citra@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 5,
                'username' => 'Dewi',
                'email' => 'dewi@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 6,
                'username' => 'Eko',
                'email' => 'eko@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 7,
                'username' => 'Fajar',
                'email' => 'fajar@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);
    }
}
