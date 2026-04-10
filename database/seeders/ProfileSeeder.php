<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profiles = [
            [
                'user_id' => 1,
                'bio' => 'Laravel backend developer',
                'phone' => '0999000001',
                'adress' => 'Damascus'
            ],
            [
                'user_id' => 2,
                'bio' => 'PHP and MySQL learner',
                'phone' => '0999000002',
                'adress' => 'Aleppo',
            ],
            [
                'user_id' => 3,
                'bio' => 'API development practice',
                'phone' => '0999000003',
                'adress' => 'Homs',
            ]
        ];

        foreach($profiles as $profile){
            Profile::create($profile);
        }
    }
}
