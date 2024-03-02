<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $this->faker->locale('es_ES');

        return [
            'name' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'deadline' => $this->faker->dateTimeBetween('-1 week', '+1 week'),
            'task_status_id' => rand(1,3),
        ];
    }
}
