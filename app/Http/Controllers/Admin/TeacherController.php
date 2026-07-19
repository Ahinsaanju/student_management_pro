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
    

public function edit($id)
{
    $teacher = \App\Models\Teacher::findOrFail($id);
    return view('admin.teachers.edit', compact('teacher'));
}


public function update(\Illuminate\Http\Request $request, $id)
{
    $teacher = \App\Models\Teacher::findOrFail($id);
    
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $teacher->user_id,
        'phone' => 'required|string|max:20',
    ]);

    
    $teacher->user->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    
    $teacher->update([
        'phone' => $request->phone,
    ]);

    return redirect()->route('admin.teachers.index')->with('success', 'Teacher record updated successfully!');
}


public function destroy($id)
{
    $teacher = \App\Models\Teacher::findOrFail($id);
    
    
    if ($teacher->user) {
        $teacher->user->delete();
    } else {
        $teacher->delete();
    }

    return redirect()->route('admin.teachers.index')->with('success', 'Teacher deleted successfully!');
}
}
