<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Course;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GradeController extends Controller
{
    // 1. Marks enter form 
    public function create()
    {
        $courses = Course::all();
        $students = Student::with('user')->latest()->get();
        return view('teacher.grades.create', compact('courses', 'students'));
    }

    // 2. Marks and Grade Auto-calculate & Save to Results Table
    public function store(Request $request)
{
    // 1. Validation
    $request->validate([
        'course_id' => 'required|exists:courses,id',
        'marks'     => 'required|array',
    ], [
        'course_id.required' => 'Please select a Course/Module first!',
    ]);

    // Selected Course details 
    $course = Course::findOrFail($request->course_id);

    // Get Course Name safely
    $subjectName = $course->course_name ?? $course->name ?? $course->course_code;

    $savedCount = 0;

    // 2. Loop through each student's mark
    foreach ($request->marks as $studentId => $mark) {

        // skip null or empty data
        if (is_null($mark) || $mark === '' || !is_numeric($mark)) {
            continue; 
        }

        $markValue = (float) $mark;

        // Grade Auto Calculation Logic
        $gradeLetter = 'F';
        if ($markValue >= 75) {
            $gradeLetter = 'A';
        } elseif ($markValue >= 65) {
            $gradeLetter = 'B';
        } elseif ($markValue >= 55) {
            $gradeLetter = 'C';
        } elseif ($markValue >= 45) {
            $gradeLetter = 'S';
        }

        //  Save / Update 'results' to DB Table  
        $resultRecord = Result::updateOrCreate(
            [
                'student_id'   => $studentId,
                'subject_code' => $course->course_code,
            ],
            [
                'subject_name' => $subjectName,
                'marks'        => $markValue,
                'grade'        => $gradeLetter
            ]
        );

        
        $resultRecord->touch();
        $savedCount++;
    }

    if ($savedCount === 0) {
        return redirect()->back()->with('error', 'No marks were entered!');
    }

    return redirect()->back()->with('success', "Exam grades submitted successfully for {$savedCount} student(s)!");
}
}