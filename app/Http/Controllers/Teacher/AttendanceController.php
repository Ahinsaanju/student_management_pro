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
        return view('teacher.attendance.create', compact('courses'));
    }

    // 2. AJAX Filter Method 
    public function getStudentsByCourse($courseId)
    {
        $course = Course::findOrFail($courseId);

        
        $students = Student::with('user')
            ->where('course', $course->course_name)
            ->orWhere('course', $course->course_code)
            ->latest()
            ->get();

        return response()->json($students);
    }

    // 3. Marked attendance save to database
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