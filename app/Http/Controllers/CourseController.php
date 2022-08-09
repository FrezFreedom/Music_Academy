<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\User;
use App\Rules\studentCourseRepeating;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::query()->paginate(5);
        $user_names = [];
        $users = User::all();
        foreach ($users as $user){
            $user_names[$user->id] = $user->name;
        }
        //return $user_names;
        return view('course.index', compact('courses','user_names'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $maestros = User::where('type', 'maestro')->get();
        $status_list = ['running', 'not started', 'finished'];
        return view('course.create', compact('maestros', 'status_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => ['required'],
            'description' => ['required'],
        ]);
        $values = $request->all();
        //return $values;
        $course = Course::create([
            'name' => $values['name'],
            'description' => $values['description'],
            'status' => $values['status']
        ]);
        User::find($values['maestro'])->courses()->save($course);
        return redirect('/course');
//        $abilities = Ability::query()->get();
//        //return $values;
//        $new_user = User::query()->create(['email' => $values['email'], 'name' => $values['name'], 'type' => $values['type'], 'password' => $values['password']]);
//        foreach ($abilities as $ability){
//            if($request->has($ability->name)){
//                $specific_ability = Ability::query()->find($ability->id);
//                $new_user->abilities()->save($specific_ability);
//            }
//        }
//        return redirect('/users');
    }

    public function deleteStudent(Request $request, $course_id)
    {
        CourseStudent::where('id', $request['student_id'])->delete();
        return redirect('/course');
    }

    public function deleteStudentsPage(Request $request, $course_id)
    {
        CourseStudent::where('id', $request['student_id'])->delete();
        return redirect('/course/'.$course_id.'/students');
    }

    public function addStudent(Request $request, $course_id)
    {
        $validation = $request->validate([
            'student' => [new studentCourseRepeating($course_id,$request['student'])]
        ]);
        CourseStudent::create([
            'course_id' => $course_id,
            'student_id' => $request['student']
        ]);
        return redirect('/course/'.$course_id.'/students');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::query()->where('id', $id)->get()->first();
        $maestros = User::query()->where('type', 'maestro')->get();
        $status_list = ['running', 'not started', 'finished'];
        return view('course.edit', compact('course','maestros', 'status_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $values = $request->all();
        $course = Course::find($id);
        $course->name = $values['name'];
        $course->description = $values['description'];
        $course->status = $values['status'];
        $course->save();
        User::find($values['maestro'])->courses()->save($course);
        //$last_maestro = User::query()->where('id', $course->maestro()->id);
        return redirect('/course');
//        $user = User::query()->where('id', $id)->get();
//        $types = ['admin', 'maestro', 'staff', 'student'];
//        $abilities = Ability::query()->get();
//        $user_abilities = User::query()->where('id', $id)->first()->abilities;
//        $user_abilities_list = [];
//        foreach ($user_abilities as $ability){
//            $user_abilities_list[] = $ability->id;
//        }
//        return view('user.edit', compact('user', 'types', 'abilities', 'user_abilities_list'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Course::where('id', $id)->delete();
        return redirect('course');
    }

    public function students($id)
    {
        $course = Course::find($id);
        $user_names = [];
        $students = User::all();
        foreach ($students as $user){
            $user_names[$user->id] = $user->name;
        }
        return view('course.students', compact('course','user_names','students'));
    }
}
