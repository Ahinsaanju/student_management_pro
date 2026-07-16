<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Course;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    // 1. marks enter form
    public function create()
    {
        $courses = Course::all();
        $students = Student::with('user')->latest()->get();
        return view('teacher.grades.create', compact('courses', 'students'));
    }

    // 2. marks Grade Auto-calculate
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'marks' => 'required|array', // Student IDs සහ Marks එන Array එක
        ]);

        $courseId = $request->course_id;

        foreach ($request->marks as $studentId => $mark) {
            // marks empty student skip
            if (is_null($mark)) continue; 

            
            $gradeLetter = 'F';
            if ($mark >= 75) {
                $gradeLetter = 'A';
            } elseif ($mark >= 65) {
                $gradeLetter = 'B';
            } elseif ($mark >= 55) {
                $gradeLetter = 'C';
            } elseif ($mark >= 45) {
                $gradeLetter = 'S';
            } else {
                $gradeLetter = 'F';
            }

            // save the database
            Grade::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'course_id' => $courseId,
                ],
                [
                    'marks' => $mark,
                    'grade' => $gradeLetter
                ]
            );
        }

        return redirect()->back()->with('success', 'Exam grades submitted successfully!');
    }
}
