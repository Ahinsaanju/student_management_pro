<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // 
    public function index()
    {
        $courses = Course::latest()->get();
        return view('admin.courses.index', compact('courses'));
    }

    // 
    public function store(Request $request)
    {
        $request->validate([
            'course_code' => 'required|string|unique:courses',
            'course_name' => 'required|string|max:255',
            'credits' => 'required|integer|min:1|max:6',
            'semester' => 'required|string',
        ]);
        Course::create($request->all());

        return redirect()->back()->with('success', 'Course Module added successfully!');
    }
}