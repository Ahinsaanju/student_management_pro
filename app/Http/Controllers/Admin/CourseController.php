<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->get();
        return view('admin.courses.index', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_code' => 'required|string|unique:courses',
            'course_name' => 'required|string|max:255',
            'credits'     => 'required|integer|min:1', // 👈 Max limit removed
            'semester'    => 'required|string',
        ]);
        
        Course::create($request->all());

        return redirect()->back()->with('success', 'Course Module added successfully!');
    }
    
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'course_code' => 'required|string|max:255|unique:courses,course_code,' . $id,
        'course_name' => 'required|string|max:255',
        'credits'     => 'required|integer|min:1',
        'semester'    => 'required|string',
    ]);

    $course = Course::findOrFail($id);
    $course->update([
        'course_code' => $request->course_code,
        'course_name' => $request->course_name,
        'credits'     => $request->credits,
        'semester'    => $request->semester,
    ]);

    return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully!');
}
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully!');
    }
}