<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
//    $user = User::query()->find(1);
////    $course = \App\Models\Course::create([
////        'name' => 'amozesh Vilion',
////        'description' => 'sfjsdlfjsd fdslsdfs',
////        'status' => 'finished',
////    ]);
////    $user->courses()->save($course);
//    return $user->courses;
    $course = \App\Models\Course::query()->find(1);
    return $course->students;
});



Route::group(['middleware' => ['can:isAdmin']], function() {
    Route::post('course/{id}/students/delete', [\App\Http\Controllers\CourseController::class,'deleteStudentsPage']);
    Route::post('course/{id}/delete', [\App\Http\Controllers\CourseController::class,'deleteStudent']);
    Route::post('/course/{id}/students/add',[\App\Http\Controllers\CourseController::class, 'addStudent']);
    Route::get('course/{id}/students', [\App\Http\Controllers\CourseController::class,'students']);
    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::resource('ability', \App\Http\Controllers\AbilityController::class);
    Route::resource('course', \App\Http\Controllers\CourseController::class);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
