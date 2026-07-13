<?php


use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\CourseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Student Dashboard Page
Route::get('/student/dashboard', function () {
    return view('student.dashboard');
})->name('student.dashboard');

Route::get('/admin/students', [StudentController::class, 'index'])->name('admin.students.index');
Route::post('/admin/students', [StudentController::class, 'store'])->name('admin.students.store');

Route::get('/admin/courses', [CourseController::class, 'index'])->name('admin.courses.index');
Route::post('/admin/courses', [CourseController::class, 'store'])->name('admin.courses.store');