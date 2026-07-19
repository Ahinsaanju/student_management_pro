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


/*
|--------------------------------------------------------------------------
| Admin Modules (Full CRUD with Custom Names matching your Sidebar)
|--------------------------------------------------------------------------
*/

// 🚀 Students CRUD (Edit, Delete, Index, Store ඔක්කොම මේකෙන් කවර් වෙනවා)
Route::resource('admin/students', StudentController::class)->names([
    'index'   => 'admin.students.index',
    'store'   => 'admin.students.store',
    'create'  => 'admin.students.create',
    'show'    => 'admin.students.show',
    'edit'    => 'admin.students.edit',
    'update'  => 'admin.students.update',
    'destroy' => 'admin.students.destroy',
]);

// 🚀 Courses CRUD
Route::resource('admin/courses', CourseController::class)->names([
    'index'   => 'admin.courses.index',
    'store'   => 'admin.courses.store',
    'create'  => 'admin.courses.create',
    'show'    => 'admin.courses.show',
    'edit'    => 'admin.courses.edit',
    'update'  => 'admin.courses.update',
    'destroy' => 'admin.courses.destroy',
]);

// 🚀 Teachers CRUD
Route::resource('admin/teachers', TeacherController::class)->names([
    'index'   => 'admin.teachers.index',
    'store'   => 'admin.teachers.store',
    'create'  => 'admin.teachers.create',
    'show'    => 'admin.teachers.show',
    'edit'    => 'admin.teachers.edit',
    'update'  => 'admin.teachers.update',
    'destroy' => 'admin.teachers.destroy',
]);


/*
|--------------------------------------------------------------------------
| Teacher Modules
|--------------------------------------------------------------------------
*/
Route::get('/teacher/attendance/create', [TeacherAttendanceController::class, 'create'])->name('teacher.attendance.create');
Route::post('/teacher/attendance/store', [TeacherAttendanceController::class, 'store'])->name('teacher.attendance.store');

Route::get('/teacher/grades/create', [TeacherGradeController::class, 'create'])->name('teacher.grades.create');
Route::post('/teacher/grades/store', [TeacherGradeController::class, 'store'])->name('teacher.grades.store');


/*
|--------------------------------------------------------------------------
| Admin Attendance & Exam Grades Logs + CRUD
|--------------------------------------------------------------------------
*/
// Attendance logs main views
Route::get('/admin/attendance-logs', [DashboardController::class, 'attendanceLogs'])->name('admin.attendance.logs');
Route::get('/admin/exam-grades', [DashboardController::class, 'examGrades'])->name('admin.exam.grades');

// Attendance Actions
Route::get('/admin/attendance/{id}/edit', [DashboardController::class, 'editAttendance'])->name('admin.attendance.edit');
Route::put('/admin/attendance/{id}', [DashboardController::class, 'updateAttendance'])->name('admin.attendance.update');
Route::delete('/admin/attendance/{id}', [DashboardController::class, 'destroyAttendance'])->name('admin.attendance.destroy');

// Exam Grades Actions
Route::get('/admin/exam-grades/{id}/edit', [DashboardController::class, 'editGrade'])->name('admin.exam.grades.edit');
Route::put('/admin/exam-grades/{id}', [DashboardController::class, 'updateGrade'])->name('admin.exam.grades.update');
Route::delete('/admin/exam-grades/{id}', [DashboardController::class, 'destroyGrade'])->name('admin.exam.grades.destroy');

/*
|--------------------------------------------------------------------------
| Admin Advanced Reports Export Routes
|--------------------------------------------------------------------------
*/
Route::get('/admin/export/students/csv', [DashboardController::class, 'exportStudentsCSV'])->name('admin.export.students.csv');
Route::get('/admin/export/students/pdf', [DashboardController::class, 'exportStudentsPDF'])->name('admin.export.students.pdf');