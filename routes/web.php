<?php

use Illuminate\Support\Facades\Route;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TasksController;

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
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('tasks', [App\Http\Controllers\TasksController::class, 'index'])->name('tasks');
Route::get('tasks/create', [App\Http\Controllers\TasksController::class, 'create'])->name('tasks.create')->middleware('auth');
Route::post('tasks/store', [App\Http\Controllers\TasksController::class, 'store'])->name('tasks.store')->middleware('auth');
Route::get('tasks/{task}/edit', [App\Http\Controllers\TasksController::class, 'edit'])->name('tasks.edit')->middleware('auth');
Route::put('tasks/{task}/update', [App\Http\Controllers\TasksController::class, 'update'])->name('tasks.update')->middleware('auth');
Route::delete('tasks/{task}/delete', [App\Http\Controllers\TasksController::class, 'destroy'])->name('tasks.destroy')->middleware('auth');
Route::resource('categories', CategoryController::class)->middleware('auth');
Route::resource('users', UserController::class)->middleware('auth');
