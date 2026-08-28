<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\Student;
use App\Models\Grade;
use App\Models\Module;
use App\Models\Attendence;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function dashboard()
{
    $user = Auth::user();

    // 1. Logged-in Teacher Profile එක ගන්නවා
    $teacher = Teacher::where('user_id', $user->id)->first();

    if ($teacher) {
        // 1. Teacher ට Assign කරලා තියෙන Modules ගණන
        $assignedModulesCount = Module::where('teacher_id', $teacher->id)->count();

        // 2. Active Students ගණන
        $totalStudentsCount = Student::where('status', 'active')->count();

        // 3. Pending Assessments Count (Marks දාලා නැති records)
        $pendingAssessmentsCount = Grade::whereNull('marks')->count();
    } else {
        $assignedModulesCount = 0;
        $totalStudentsCount = 0;
        $pendingAssessmentsCount = 0;
    }

    return view('teacher.dashboard', compact(
        'user',
        'assignedModulesCount',
        'totalStudentsCount',
        'pendingAssessmentsCount'
    ));
}
    public function update(Request $request, $teacher_code)
    {
       
        $teacher = Teacher::where('id', $teacher_code)
            ->orWhere('teacher_code', $teacher_code)
            ->firstOrFail();
        
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $teacher->user_id,
            'phone' => 'required|string|max:20',
        ]);

        // User details update 
        if ($teacher->user) {
            $teacher->user->update([
                'name'  => $request->name,
                'email' => $request->email,
            ]);
        }

        // Teacher details update 
        $teacher->update([
            'phone' => $request->phone,
        ]);

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher record updated successfully!');
    }

    public function destroy($teacher_code)
    {
       
        $teacher = Teacher::where('id', $teacher_code)
            ->orWhere('teacher_code', $teacher_code)
            ->firstOrFail();
        
       
        if ($teacher->user) {
            $teacher->user->delete(); 
        } else {
            $teacher->delete();
        }

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher deleted successfully!');
    }
}