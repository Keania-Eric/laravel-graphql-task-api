<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            //
            'user_id'=> User::first()?->id ?? User::factory()->create()->id,
            'title'=> $this->faker->sentence(6),
            'description'=> $this->faker->paragraph(),
            'due_date'=> $this->faker->dateTime($max="now"),
            'status'=> $this->faker->randomElement(['Not Started', 'In Progress', 'Completed'])
        ];
    }
}
