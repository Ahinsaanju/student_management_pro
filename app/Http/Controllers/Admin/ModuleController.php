<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Display a listing of modules for a specific course.
     */
    public function index(Course $course)
    {
        $modules = $course->modules;
        return view('admin.modules.index', compact('course', 'modules'));
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
        ]);

        $course->modules()->create([
            'module_code' => $request->module_code,
            'name'        => $request->name,
            'credits'     => $request->credits,
        ]);

        return redirect()->back()->with('success', 'Module added successfully!');
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