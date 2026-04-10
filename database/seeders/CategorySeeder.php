<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Work'],
            ['name' => 'Personal'],
            ['name' => 'sport'],
            ['name' => 'project'],
            ['name' => 'Hobby'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
