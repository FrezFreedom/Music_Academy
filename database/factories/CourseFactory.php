<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    public function definition()
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
            'maestro_id' => function()
            {
                $user = User::factory()->create();
                return $user->id;
            },
            'status' => fake()->randomElement(['not started', 'running', 'finished']),
        ];
    }
}
