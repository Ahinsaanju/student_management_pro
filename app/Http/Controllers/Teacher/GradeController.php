<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Module;
use App\Models\Teacher;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{
    // 1. Marks enter form 
    public function create()
    {
        $userId = Auth::id();

       
        $teacher = Teacher::where('user_id', $userId)->first();

     
        $modules = $teacher 
            ? Module::where('teacher_id', $teacher->id)->get() 
            : collect();

        return view('teacher.grades.create', compact('modules'));
    }

    // 2. AJAX Filter Method 
    public function getStudentsByCourse($moduleId)
    {
       
        $module = Module::with('course')->find($moduleId);

        if (!$module) {
            return response()->json([]);
        }

        
        $students = Student::with('user')
            ->where(function($query) use ($module) {
                if ($module->course) {
                    $query->where('course', $module->course->course_name)
                          ->orWhere('course', $module->course->course_code);
                }
            })
            ->latest()
            ->get();

        
        if ($students->isEmpty()) {
            $students = Student::with('user')->where('status', 'active')->latest()->get();
        }

        return response()->json($students);
    }

    //  Marks and Grade Auto-calculate & Save to Results Table
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'module_id' => 'required|exists:modules,id',
            'marks'     => 'required|array',
        ], [
            'module_id.required' => 'Please select a Module first!',
        ]);

        // Selected Module details 
        $module = Module::findOrFail($request->module_id);

        $subjectName = $module->name ?? $module->module_name ?? $module->module_code;
        $subjectCode = $module->module_code;

        $savedCount = 0;

        // Loop through each student's mark
        foreach ($request->marks as $studentRegNo => $mark) {

            // Skip null or empty data
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

            
            $student = Student::where('student_reg_no', $studentRegNo)
                              ->orWhere('id', $studentRegNo)
                              ->first();

            $studentIdToSave = $student ? $student->id : $studentRegNo;

            // Save / Update 'results' DB Table  
            $resultRecord = Result::updateOrCreate(
                [
                    'student_id'   => $studentIdToSave,
                    'subject_code' => $subjectCode,
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