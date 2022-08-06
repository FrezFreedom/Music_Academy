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
    if(User::query()->where('id', 1)->exists()){
        return 'are';
    }
    return 'na';
});


Route::resource('users', \App\Http\Controllers\UserController::class);
Route::resource('ability', \App\Http\Controllers\AbilityController::class);
