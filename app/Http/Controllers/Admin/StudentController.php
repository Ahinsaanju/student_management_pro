<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('user')->latest()->get();
        return view('admin.students.index', compact('students'));
    }

    
    public function store(Request $request)
    {
        // 1. Validation Logic
        $request->validate([
            'student_id' => 'required|string|unique:students,student_reg_no',
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'course'     => 'required|string',
            'dob'        => 'required|date',
            'gender'     => 'required|string',
        ]);

        // 2. Safe Database Operations using Transactions
        DB::transaction(function () use ($request) {
            
            // Create User Account (Auth)
            $user = User::create([
                'name'     => $request->first_name . ' ' . $request->last_name,
                'email'    => $request->email,
                'password' => Hash::make('12345678'), // Default initial password
                'role'     => 'student',
            ]);

            // Create Student Profile Record
            Student::create([
                'user_id'        => $user->id,
                'student_reg_no' => $request->student_id,
                'first_name'     => $request->first_name,
                'last_name'      => $request->last_name,
                'email'          => $request->email,
                'dob'            => $request->dob,
                'gender'         => $request->gender,
                'course'         => $request->course,
                'status'         => 'active',
            ]);
        });

        // 3. Response Success Message
        return redirect()->back()->with('success', 'Student registered successfully! Default password is: 12345678');
    }
    
public function edit($id) {
    $student = Student::findOrFail($id);
    return view('admin.students.edit', compact('student'));
}

public function update(Request $request, $id) {
    // Validation and Update 
    $student = Student::findOrFail($id);
    $student->update($request->all());
    return redirect()->route('admin.students.index')->with('success', 'Updated successfully!');
}

public function destroy($id) {
    $student = Student::findOrFail($id);
    $student->delete();
    return redirect()->route('admin.students.index')->with('success', 'Deleted successfully!');
}
public function profile()
{
    $user = auth()->user(); 
    return view('profile.show', compact('user')); 
}
public function results()
{
    $user = auth()->user();
    
    $student = Student::where('user_id', $user->id)
                      ->with('results.subject') 
                      ->first();

    return view('student.results', compact('student'));
}
public function exportCsv(): StreamedResponse
{
    $fileName = 'students_list_' . date('Y-m-d') . '.csv';
    $students = \App\Models\Student::with('user')->get();

    $headers = [
        "Content-type"        => "text/csv",
        "Content-Disposition" => "attachment; filename=$fileName",
        "Pragma"              => "no-cache",
        "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
        "Expires"             => "0"
    ];

    $callback = function() use ($students) {
        $file = fopen('php://output', 'w');
        // Column Headers
        fputcsv($file, ['ID', 'Student Name', 'Email', 'Reg No / Code', 'Created At']);

        foreach ($students as $student) {
            fputcsv($file, [
                $student->id,
                $student->name ?? ($student->user->name ?? 'N/A'),
                $student->email ?? ($student->user->email ?? 'N/A'),
                $student->reg_number ?? $student->student_id ?? 'N/A',
                $student->created_at
            ]);
        }
        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}
public function exportPdf()
{
    $students = \App\Models\Student::with('user')->get();

   
    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.reports.students_pdf', compact('students'));

    return $pdf->download('students_list_' . date('Y-m-d') . '.pdf');
}
}