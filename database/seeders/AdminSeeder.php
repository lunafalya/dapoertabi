<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        if (!env('ADMIN_EMAIL') || !env('ADMIN_PASSWORD')) {
            return;
        }

        User::firstOrCreate(
            ['email' => env('ADMIN_EMAIL')],
            [
                'name' => env('ADMIN_NAME'),
                'phone' => env('ADMIN_PHONE'),
                'role' => 'admin',
                'profile_photo' => null,
                'password' => Hash::make(env('ADMIN_PASSWORD')),
            ]
        );
    }
}