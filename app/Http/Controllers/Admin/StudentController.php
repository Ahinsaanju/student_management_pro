<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('user')->latest()->get();
        return view('admin.students.index', compact('students'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|string|unique:students,student_reg_no',
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'course'     => 'required|string',
            'dob'        => 'required|date',
            'gender'     => 'required|string',
        ]);

        
        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email'    => $request->email,
            'password' => Hash::make('12345678'), // Default password
            'role'     => 'student',
        ]);
        

        Student::create([
        'user_id'         => $user->id,
        'student_reg_no'  => $request->student_id,
        'first_name'      => $request->first_name,
        'last_name'       => $request->last_name,
        'email'           => $request->email,
        'dob'             => $request->dob,
        'gender'          => $request->gender,
        'course'          => $request->course,
        'status'          => 'active',
    ]);

        return redirect()->back()->with('success', 'Student registered successfully!');
    }
}