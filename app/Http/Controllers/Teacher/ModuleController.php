<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

       
        $teacher = Teacher::where('user_id', $userId)->first();

        if ($teacher) {
            $modules = Module::where('teacher_id', $teacher->id)->with('course')->get();
        } else {
            $modules = collect();
        }

        
        return view('teacher.modules.index', compact('modules'));
    }
}