<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'frontiersystem@gmail.com'],
            [
                'name' => 'Frontier System Admin',
                'password' => Hash::make('frontier@123'),
            ]
        );
    }
}
