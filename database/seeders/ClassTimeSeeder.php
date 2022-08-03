<?php

namespace Database\Seeders;

use App\Models\ClassTime;
use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ClassTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = Course::all();

        foreach ($courses as $course){

            $start_time = Carbon::today()->subDays(rand(0, 179))->addSeconds(rand(0, 86400));
            $end_time = $start_time->addMinute(30);

            for($i = 0; $i < 10; $i++){
                ClassTime::factory()->create(['course_id' => $course->id, 'start_time' => $start_time, 'end_time' => $end_time]);
                $start_time->addHour(2 * 24);
                $end_time->addHour(2 * 24);
            }

        }
    }
}
