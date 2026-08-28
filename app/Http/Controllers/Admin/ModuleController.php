<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Module;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Display a listing of modules for a specific course.
     */
    public function index(Course $course)
    {
        $modules = $course->modules()->with('teacher.user')->get();
        $teachers = Teacher::with('user')->get();

        return view('admin.modules.index', compact('course', 'modules', 'teachers'));
    }

    /**
     * Store a newly created module in storage.
     */
    public function store(Request $request, Course $course)
    {
        $request->validate([
            'module_code' => 'required|string|max:20',
            'name'        => 'required|string|max:255',
            'credits'     => 'required|integer|min:1|max:10',
            'teacher_id'  => 'nullable|exists:teachers,id', // Lecturer select කිරීම
        ]);

        $course->modules()->create([
            'module_code' => $request->module_code,
            'name'        => $request->name,
            'credits'     => $request->credits,
            'teacher_id'  => $request->teacher_id,
        ]);

        return redirect()->back()->with('success', 'Module added and assigned to lecturer successfully!');
    }

    // ✏️ Edit Form View Function
    public function edit(Module $module)
    {
        $teachers = Teacher::with('user')->get();
        return view('admin.modules.edit', compact('module', 'teachers'));
    }

    // 🔄 Update Logic Function
    public function update(Request $request, Module $module)
    {
        $request->validate([
            'module_code' => 'required|string|max:255',
            'module_name' => 'required|string|max:255',
            'credits'     => 'required|integer|min:1',
            'teacher_id'  => 'nullable|exists:teachers,id',
        ]);

        $module->update([
            'module_code' => $request->module_code,
            'module_name' => $request->module_name,
            'credits'     => $request->credits,
            'teacher_id'  => $request->teacher_id,
        ]);

        return redirect()->route('admin.courses.modules.index', $module->course_id)
                         ->with('success', 'Module updated successfully!');
    }

    /**
     * Remove the specified module from storage.
     */
    public function destroy(Module $module)
    {
        $module->delete();
        return redirect()->back()->with('success', 'Module deleted successfully!');
    }
}