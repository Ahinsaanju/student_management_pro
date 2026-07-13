<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    // 
    public function index()
    {
        // Users table එකත් එක්ක join කරලා ස්ටුඩන්ට්ස්ලා සේරම ගන්නවා
        $students = Student::with('user')->latest()->get();
        return view('admin.students.index', compact('students'));
    }

    // 
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'student_id' => 'required|string|unique:students',
            'course' => 'required|string',
        ]);

        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('12345678'), // Default password එකක් දෙනවා
            'role' => 'student',
        ]);

       
        Student::create([
            'user_id' => $user->id,
            'student_id' => $request->student_id,
            'course' => $request->course,
            'status' => 'Active',
        ]);

        return redirect()->back()->with('success', 'Student registered successfully!');
    }
}
