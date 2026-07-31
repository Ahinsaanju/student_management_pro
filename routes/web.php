<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController as AdminTeacherController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Teacher\AttendanceController;
use App\Http\Controllers\Teacher\GradeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home Page
Route::get('/', function () {
    return view('welcome');
});

// 🔒 Authenticated Users (Admin, Teacher, Student) සඳහා Protected Routes
Route::middleware(['auth', 'verified'])->group(function () {

    // 🔀 Central Role-Based Redirector
    Route::get('/dashboard', function () {
        $role = auth()->user()->role;

        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($role === 'teacher') {
            return redirect()->route('teacher.dashboard');
        }

        return redirect()->route('student.dashboard');
    })->name('dashboard');


    // 👨‍🎓 Student Routes
    Route::prefix('student')->name('student.')->group(function () {
        Route::get('/dashboard', function () {
            return view('student.dashboard');
        })->name('dashboard');

        Route::get('/results', [StudentController::class, 'results'])->name('results');
    });


    // 👨‍🏫 Teacher Routes Group
    Route::prefix('teacher')->name('teacher.')->group(function () {
        Route::get('/dashboard', [AdminTeacherController::class, 'dashboard'])->name('dashboard');

        // 📚 My Modules Route
        Route::get('/modules', function () {
            $courses = \App\Models\Course::all();
            return view('teacher.modules.index', compact('courses'));
        })->name('modules.index');

        // Attendance Routes
        Route::get('/attendance', function () {
            return view('teacher.attendance.index');
        })->name('attendance.index');

        Route::get('/attendance/create', function () {
            $courses = \App\Models\Course::all();
            $students = \App\Models\Student::all();
            return view('teacher.attendance.create', compact('courses', 'students'));
        })->name('attendance.create');

        Route::post('/attendance/store', [AttendanceController::class, 'store'])->name('attendance.store');

        // Grades / Marks Routes
        Route::get('/grades', function () {
            return view('teacher.grades.index');
        })->name('grades.index');

        Route::get('/grades/create', [GradeController::class, 'create'])->name('grades.create');
        Route::post('/grades/store', [GradeController::class, 'store'])->name('grades.store');
    });


    // 👨‍💼 Admin Routes Group
    Route::prefix('admin')->name('admin.')->group(function () {
        
        // Admin Dashboard with Data Injection
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Export Routes
        Route::get('/export-students-csv', [StudentController::class, 'exportCsv'])->name('export.students.csv');
        Route::get('/export-students-pdf', [StudentController::class, 'exportPdf'])->name('export.students.pdf');

        // Admin Resource Routes (CRUD)
        Route::resource('students', StudentController::class);
        Route::resource('teachers', AdminTeacherController::class);
        Route::resource('courses', CourseController::class);

        // Attendance Logs Routes
        Route::get('/attendance-logs', [DashboardController::class, 'attendanceLogs'])->name('attendance.logs');
        Route::get('/attendance/{id}/edit', [DashboardController::class, 'editAttendance'])->name('attendance.edit');
        Route::put('/attendance/{id}', [DashboardController::class, 'updateAttendance'])->name('attendance.update');
        Route::delete('/attendance/{id}', [DashboardController::class, 'destroyAttendance'])->name('attendance.destroy');

        // 🎯 FIX: Exam Grades Routes වල නම Blade එකට ගැලපෙන්න වෙනස් කළා
        Route::get('/exam-grades', [DashboardController::class, 'examGrades'])->name('exam.grades');
        Route::get('/exam-grades/{id}/edit', [DashboardController::class, 'editGrade'])->name('exam.grades.edit');
        Route::put('/exam-grades/{id}', [DashboardController::class, 'updateGrade'])->name('exam.grades.update');
        Route::delete('/exam-grades/{id}', [DashboardController::class, 'destroyGrade'])->name('exam.grades.destroy');
    });


    // 👤 Breeze Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Breeze Auth Routes
require __DIR__.'/auth.php';