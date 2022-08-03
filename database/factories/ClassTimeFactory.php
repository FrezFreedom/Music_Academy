<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClassTime>
 */
class ClassTimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    function get_course_id(): int
    {
        $course = Course::factory()->create();
        return $course->id;
    }

    public function definition()
    {
        return [
            'course_id' => $this->get_course_id(),
            'description' => fake()->text(),
            'start_time' => fake()->time,
            'end_time' => fake()->time,
        ];
    }
}
