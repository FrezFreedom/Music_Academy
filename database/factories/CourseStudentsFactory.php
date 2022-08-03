<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CourseStudentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    function get_course_id()
    {
        $course = Course::factory()->create();
        return $course->id;
    }

    function get_student_id()
    {
        $student = User::factory()->create();
        $student->update(['type' => 'student']);
        return $student->id;
    }

    public function definition()
    {
        return [
            'course_id' => $this->get_course_id(),
            'student_id' => $this->get_student_id(),
        ];
    }
}
