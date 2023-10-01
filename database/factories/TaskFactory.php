<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Status;

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
        $array = [
            'Read the book',
            'Buy eggs',
            'Learn Laravel',
            'Send letters',
            'Learn Vuejs',
            'Go to the post office',
            'Buy tickets'
        ];
        return [
            'title' => $array[rand(0,count($array)-1)],
            'completed' => $this->faker->boolean(),
            'created_at' => $this->faker->dateTimeThisMonth(),
            'updated_at' => $this->faker->dateTimeThisMonth()
        ];
    }
}
