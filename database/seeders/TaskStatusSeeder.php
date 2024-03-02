<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TaskStatus;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TaskStatus::create(['name' => 'Pending']);
        TaskStatus::create(['name' => 'Completed']);
        TaskStatus::create(['name' => 'Overdue']);
    }
}
