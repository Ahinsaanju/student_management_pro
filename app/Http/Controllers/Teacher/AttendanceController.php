<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Module;
use App\Models\Teacher;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    // 1. Attendance mark Form (Log වී සිටින Teacher ගේ Modules ලබා ගැනීම)
    public function create()
    {
        $userId = Auth::id();
        $teacher = Teacher::where('user_id', $userId)->first();

        // Logged-in Teacher ට assign කර ඇති Modules පමණක් Filter කරගැනීම
        $modules = $teacher 
            ? Module::where('teacher_id', $teacher->id)->get() 
            : collect();

        return view('teacher.attendance.create', compact('modules'));
    }

    // 2. AJAX Filter Method - Selected Module එකට අදාළ Students ලා ලබා ගැනීම
    public function getStudentsByModule($moduleId)
    {
        $module = Module::with('course')->find($moduleId);

        if (!$module) {
            return response()->json([]);
        }

        // Module එකට අයත් Course එකේ Students ලා filter කිරීම
        $students = Student::with('user')
            ->where(function($query) use ($module) {
                if ($module->course) {
                    $query->where('course', $module->course->course_name)
                          ->orWhere('course', $module->course->course_code);
                }
            })
            ->latest()
            ->get();

        // Course match එකක් නැත්නම් Active Students ලා Load කිරීම (Fallback)
        if ($students->isEmpty()) {
            $students = Student::with('user')->where('status', 'active')->latest()->get();
        }

        return response()->json($students);
    }

    // 3. Marked attendance save to database
    public function store(Request $request)
    {
        $request->validate([
            'module_id' => 'required|exists:modules,id',
            'date'      => 'required|date',
            'attendance'=> 'required|array', // Student IDs and Statuses Array
        ], [
            'module_id.required' => 'Please select a Module first!',
        ]);

        $moduleId = $request->module_id;
        $date = $request->date;

        foreach ($request->attendance as $studentId => $status) {   
            Attendance::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'module_id'  => $moduleId,
                    'date'       => $date
                ],
                [
                    'status'     => $status
                ]
            );
        }

        return redirect()->back()->with('success', 'Attendance marked successfully!');
    }
}