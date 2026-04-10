<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'haidar',
                'email' => 'haidar@gmail.com',
                'password' => 'haidar123',
            ],
            [
                'name' => 'ahmad',
                'email' => 'ahmad@gmail.com',
                'password' => 'ahmad123',
            ],
            [
                'name' => 'ali',
                'email' => 'ali@gmail.com',
                'password' => 'ali123',
            ],
            [
                'name' => 'hossam',
                'email' => 'hossam@gmail.com',
                'password' => 'hossam123',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
