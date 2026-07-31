<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\Student;
use App\Models\Grade;
use App\Models\Attendence;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function dashboard()
    {
        // Logged-in Teacher Details (User + Teacher relation)
        $user = Auth::user();
        
        // 1. Assigned Modules Count
        $assignedModulesCount = Course::count();

        // 2. Total Active Students Count
        $totalStudentsCount = Student::where('status', 'active')->count();

        // 3. Pending Assessments Count 
        $pendingAssessmentsCount = Grade::whereNull('marks')->count();

        return view('teacher.dashboard', compact(
            'user',
            'assignedModulesCount',
            'totalStudentsCount',
            'pendingAssessmentsCount'
        ));
    }

    public function index()
    {
        $teachers = Teacher::with('user')->latest()->get();
        return view('admin.teachers.index', compact('teachers'));
    }

    public function store(Request $request)
    {
        // 1. Validation Logic
        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|string|email|max:255|unique:users,email',
            'teacher_code' => 'required|string|unique:teachers,teacher_code',
            'department'   => 'required|string',
            'designation'  => 'required|string',
            'phone'        => 'nullable|string',
        ]);

        // 2. Safe Database Operations using Transactions
        DB::transaction(function () use ($request) {

            // Create User Account (Auth)
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make('teacher123'), // Default password
                'role'     => 'teacher',
            ]);

            // Create Teacher Profile Record
            Teacher::create([
                'user_id'      => $user->id,
                'teacher_code' => $request->teacher_code,
                'department'   => $request->department,
                'designation'  => $request->designation,
                'phone'        => $request->phone,
            ]);
        });

        // 3. Response Success Message
        return redirect()->back()->with('success', 'Teacher registered successfully! Default password is: teacher123');
    }

    public function edit($teacher_code)
    {
        
        $teacher = Teacher::with('user')
            ->where('id', $teacher_code)
            ->orWhere('teacher_code', $teacher_code)
            ->firstOrFail();

        return view('admin.teachers.edit', compact('teacher'));            
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