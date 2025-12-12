<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Superadmin',
                'email' => 'superadmin@medquest.co.id',
                'password' => Hash::make('Superadmin2025!')
            ]
        ]);
    }
}
