<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'nis_or_nip' => 'admin',
                'role' => 'admin',
                'password' => Hash::make('password'),
                'status' => true,
            ],
            [
                'name' => 'Ustadz Ahmad',
                'email' => 'guru@example.com',
                'nis_or_nip' => 'GURU001',
                'role' => 'guru',
                'password' => Hash::make('password'),
                'status' => true,
            ],
            [
                'name' => 'Santri 1',
                'email' => 'santri@example.com',
                'nis_or_nip' => 'SANTRI001',
                'role' => 'santri',
                'password' => Hash::make('password'),
                'status' => true,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
