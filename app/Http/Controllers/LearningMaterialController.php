<?php

namespace App\Http\Controllers;

use App\Models\LearningMaterial;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Course;

class LearningMaterialController extends Controller
{
    public function index(Request $request)
{
    // Departments / Courses List එක ගැනීම
    $courses = Course::all();

    // Module Query එක සාදා ගැනීම
    $query = Module::with('learningMaterials');

    // Department / Course එක අනුව Filter කර ඇත්නම්
    if ($request->has('course_id') && $request->course_id != '') {
        $query->where('course_id', $request->course_id);
    }

    $modules = $query->get();

    return view('admin.materials.index', compact('modules', 'courses'));
}
    // Upload Learning Material (Admin / Lecturer)
    public function store(Request $request)
    {
        $request->validate([
            'module_id'    => 'required|exists:modules,id',
            'title'        => 'required|string|max:255',
            'type'         => 'required|in:file,link',
            'file'         => 'nullable|required_if:type,file|file|mimes:pdf,doc,docx,ppt,pptx,zip|max:20480', // Max 20MB
            'external_url' => 'nullable|required_if:type,link|url',
        ]);

        $filePath = null;

        if ($request->hasFile('file') && $request->type === 'file') {
            $filePath = $request->file('file')->store('learning_materials', 'public');
        }

        LearningMaterial::create([
            'module_id'    => $request->module_id,
            'title'        => $request->title,
            'description'  => $request->description,
            'type'         => $request->type,
            'file_path'    => $filePath,
            'external_url' => $request->external_url,
            'uploaded_by'  => auth()->id(),
        ]);

        return back()->with('success', 'Learning material added successfully!');
    }

    // Delete Material
    public function destroy($id)
    {
        $material = LearningMaterial::findOrFail($id);

        if ($material->file_path && Storage::disk('public')->exists($material->file_path)) {
            Storage::disk('public')->delete($material->file_path);
        }

        $material->delete();

        return back()->with('success', 'Material deleted successfully!');
    }
}
