<?php

namespace App\Rules;

use App\Models\CourseStudent;
use Illuminate\Contracts\Validation\Rule;

class studentCourseRepeating implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected int $course_id, $student_id;

    public function __construct($course_id, $student_id)
    {
        $this->course_id = $course_id;
        $this->student_id = $student_id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if(CourseStudent::where('course_id', $this->course_id)->where('student_id', $this->student_id)->exists()){
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The Student is repetitive!';
    }
}
