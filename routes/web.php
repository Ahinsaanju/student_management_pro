<?php


use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Teacher\AttendanceController as TeacherAttendanceController;
use App\Http\Controllers\Teacher\GradeController as TeacherGradeController;
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

// Admin Dashboard Route
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Student Dashboard Page
Route::get('/student/dashboard', function () {
    return view('student.dashboard');
})->name('student.dashboard');

// Teacher Dashboard Route
Route::get('/teacher/dashboard', function () {
    return view('teacher.dashboard');
})->name('teacher.dashboard');

Route::get('/admin/students', [StudentController::class, 'index'])->name('admin.students.index');
Route::post('/admin/students', [StudentController::class, 'store'])->name('admin.students.store');

Route::get('/admin/courses', [CourseController::class, 'index'])->name('admin.courses.index');
Route::post('/admin/courses', [CourseController::class, 'store'])->name('admin.courses.store');

Route::get('/admin/teachers', [TeacherController::class, 'index'])->name('admin.teachers.index');
Route::post('/admin/teachers', [TeacherController::class, 'store'])->name('admin.teachers.store');

Route::get('/teacher/attendance/create', [TeacherAttendanceController::class, 'create'])->name('teacher.attendance.create');
Route::post('/teacher/attendance/store', [TeacherAttendanceController::class, 'store'])->name('teacher.attendance.store');

Route::get('/teacher/grades/create', [TeacherGradeController::class, 'create'])->name('teacher.grades.create');
Route::post('/teacher/grades/store', [TeacherGradeController::class, 'store'])->name('teacher.grades.store');