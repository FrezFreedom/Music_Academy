<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ramsey\Collection\Collection;


class CourseStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = Course::all();
        $students = User::query()->where('type', 'student')->get();
        foreach ($courses as $course)
        {

            $rand_num = rand(min(1 , count($students)) , min(3, count($students)));
            $course_students = $students->random($rand_num);

            foreach ($course_students as $student) {
                CourseStudent::factory()->create(['course_id' => $course->id, 'student_id' => $student->id]);
            }

        }
    }
}
