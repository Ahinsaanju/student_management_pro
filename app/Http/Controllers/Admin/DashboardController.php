<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\Attendance;
use App\Models\Grade;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        // 
        $totalStudents = Student::count();
        $totalTeachers = Teacher::count();
        $totalCourses = Course::count();

        // 5 Recent Attendance Logs 
        $attendanceLogs = Attendance::with(['student.user', 'course'])->latest()->take(5)->get();

        // 5 Recent Exam Grades 
        $examGrades = Grade::with(['student.user', 'course'])->latest()->take(5)->get();

        return view ('admin.dashboard', compact('totalStudents', 'totalTeachers', 'totalCourses', 'attendanceLogs', 'examGrades'));
    }
}
