<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    
    public function index()
    {
        $teachers = Teacher::with('user')->latest()->get();
        return view('admin.teachers.index', compact('teachers'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'teacher_code' => 'required|string|unique:teachers',
            'department' => 'required|string',
            'designation' => 'required|string',
            'phone' => 'nullable|string',
        ]);

       
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('teacher123'), // Default password එක
            'role' => 'teacher',
        ]);

       
        Teacher::create([
            'user_id' => $user->id,
            'teacher_code' => $request->teacher_code,
            'department' => $request->department,
            'designation' => $request->designation,
            'phone' => $request->phone,
        ]);

        return redirect()->back()->with('success', 'Teacher registered successfully!');
    }
    //
}
