<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $tasks = [
            [
                'user_id' => 1,
                'title' => 'Study Laravel',
                'description' => 'Read routes and controllers',
                'priority' => 1,
            ],
            [
                'user_id' => 1,
                'title' => 'Create migration',
                'description' => 'Build tasks table columns',
                'priority' => 2,
            ],
            [
                'user_id' => 2,
                'title' => 'Build model',
                'description' => 'Set fillable attributes',
                'priority' => 1,
            ],
            [
                'user_id' => 2,
                'title' => 'Create seeder',
                'description' => 'Insert data to tasks table',
                'priority' => 3,
            ],
            [
                'user_id' => 3,
                'title' => 'Build controller',
                'description' => 'Add CRUD methods',
                'priority' => 2,
            ],
            [
                'user_id' => 3,
                'title' => 'Create views',
                'description' => 'Design blade templates',
                'priority' => 1,
            ],
        ];
        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}
