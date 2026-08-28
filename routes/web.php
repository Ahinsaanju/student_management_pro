<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController as AdminTeacherController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Teacher\AttendanceController;
use App\Http\Controllers\Teacher\GradeController;
use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\Teacher\ModuleController as TeacherModuleController;
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
Route::middleware(['auth', 'verified', \App\Http\Middleware\PreventBackHistory::class])->group(function () {

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


    // 👨‍🎓 Student Routes Group
    Route::prefix('student')->name('student.')->group(function () {
        
        // 🎯 DYNAMIC STUDENT DASHBOARD ROUTE
        Route::get('/dashboard', function () {
            $user = auth()->user();

            // Logged in Student ගේ Profile එක අරගැනීම
            $student = \App\Models\Student::where('user_id', $user->id)
                        ->orWhere('email', $user->email)
                        ->first();

            if (!$student) {
                return view('student.dashboard', [
                    'modulesCount' => 0,
                    'overallAttendance' => 0,
                    'modules' => collect(),
                    'student' => null,
                    'course' => null
                ]);
            }

            // Student ගේ Course එකට අදාළ Details සහ Modules ගැනීම
            $course = \App\Models\Course::where('course_name', $student->course)
                        ->orWhere('course_code', $student->course)
                        ->with('modules')
                        ->first();

            $modules = $course ? $course->modules : collect();
            $modulesCount = $modules->count();

            // Student ගේ Overall Attendance Percentage එක ගණනය කිරීම
            $totalAttendance = \App\Models\Attendance::where('student_id', $student->id)->count();
            $presentAttendance = \App\Models\Attendance::where('student_id', $student->id)
                                    ->where('status', 'present')
                                    ->count();

            $overallAttendance = $totalAttendance > 0 ? round(($presentAttendance / $totalAttendance) * 100) : 0;

            return view('student.dashboard', compact('modulesCount', 'overallAttendance', 'modules', 'student', 'course'));
        })->name('dashboard');

        Route::get('/results', [StudentController::class, 'results'])->name('results');
        Route::get('/my-attendance', [StudentController::class, 'myAttendance'])->name('attendance');
        Route::get('/modules', [StudentController::class, 'modules'])->name('modules');
    });


    // 👨‍🏫 Teacher Routes Group
    Route::prefix('teacher')->name('teacher.')->group(function () {
        Route::get('/dashboard', [AdminTeacherController::class, 'dashboard'])->name('dashboard');

        // 📚 Teacher Modules Route
        Route::get('/modules', [TeacherModuleController::class, 'index'])->name('modules.index');

        // Attendance Routes
        Route::get('/attendance', function () {
            return view('teacher.attendance.index');
        })->name('attendance.index');

        Route::get('/attendance/create', [AttendanceController::class, 'create'])->name('attendance.create');
        Route::post('/attendance/store', [AttendanceController::class, 'store'])->name('attendance.store');
        
        // Grades / Marks Routes
        Route::get('/grades', function () {
            return view('teacher.grades.index');
        })->name('grades.index');

        Route::get('/grades/create', [GradeController::class, 'create'])->name('grades.create');
        Route::post('/grades/store', [GradeController::class, 'store'])->name('grades.store');
        
        // Dynamic AJAX Route for Students
        Route::get('/get-students-by-course/{courseId}', [GradeController::class, 'getStudentsByCourse'])->name('get.students.by.course');
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

        // Exam Grades Routes
        Route::get('/exam-grades', [DashboardController::class, 'examGrades'])->name('exam.grades');
        Route::get('/exam-grades/{id}/edit', [DashboardController::class, 'editGrade'])->name('exam.grades.edit');
        Route::put('/exam-grades/{id}', [DashboardController::class, 'updateGrade'])->name('exam.grades.update');
        Route::delete('/exam-grades/{id}', [DashboardController::class, 'destroyGrade'])->name('exam.grades.destroy');

        // 📚 Course Modules Routes
        Route::get('/courses/{course}/modules', [ModuleController::class, 'index'])->name('courses.modules.index');
        Route::post('/courses/{course}/modules', [ModuleController::class, 'store'])->name('courses.modules.store');
        Route::get('/modules/{module}/edit', [ModuleController::class, 'edit'])->name('modules.edit');
        Route::put('/modules/{module}', [ModuleController::class, 'update'])->name('modules.update');
        Route::delete('/modules/{module}', [ModuleController::class, 'destroy'])->name('modules.destroy');

    });


    // 👤 Breeze Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Breeze Auth Routes
require __DIR__.'/auth.php';