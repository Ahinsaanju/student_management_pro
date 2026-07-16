<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Course;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    // 1. Attendance mark Form 
    public function create()
    {
        $courses = Course::all(); // get all courses
        $students = Student::with('user')->latest()->get(); // get all students
        
        return view('teacher.attendance.create', compact('courses', 'students'));
    }

    // 2. mared attendance save to database
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'date' => 'required|date',
            'attendance' => 'required|array', // Student IDs and Statuses Array
        ]);

        $courseId = $request->course_id;
        $date = $request->date;

        
        foreach ($request->attendance as $studentId => $status) {   
            Attendance::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'course_id' => $courseId,
                    'date' => $date
                ],
                [
                    'status' => $status
                ]
            );
        }

        return redirect()->back()->with('success', 'Attendance marked successfully!');
    }
}
