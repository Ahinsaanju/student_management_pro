<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\Attendance;
use App\Models\Grade;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index(Request $request)
    {
        //  Search query and Filter values 
    $search = $request->input('search');
    $statusFilter = $request->input('status');

    // 1. Total Counts (Stats)
    $totalStudents = Student::count();
    $totalTeachers = Teacher::count();
    $totalCourses = Course::count();

    // 2. Recent Attendance Logs (With Search & Filter)
    $attendanceQuery = \App\Models\Attendance::with(['student.user', 'course']);

    if ($search) {
        $attendanceQuery->where(function($q) use ($search) {
            $q->whereHas('student.user', function($userQuery) use ($search) {
                $userQuery->where('name', 'like', "%{$search}%");
            })
            ->orWhereHas('course', function($courseQuery) use ($search) {
                $courseQuery->where('course_code', 'like', "%{$search}%");
            });
        });
    }

    if ($statusFilter) {
        $attendanceQuery->where('status', $statusFilter);
    }

    $attendanceLogs = $attendanceQuery->latest()->take(5)->get();

    // 3. Recent Exam Grades (With Search)
    $gradesQuery = \App\Models\Grade::with(['student.user', 'course']);

    if ($search) {
        $gradesQuery->where(function($q) use ($search) {
            $q->whereHas('student.user', function($userQuery) use ($search) {
                $userQuery->where('name', 'like', "%{$search}%");
            })
            ->orWhereHas('course', function($courseQuery) use ($search) {
                $courseQuery->where('course_code', 'like', "%{$search}%");
            });
        });
    }

    $examGrades = $gradesQuery->latest()->take(5)->get();

    // 4. Dummy data for charts 
    $attendanceLabels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
    $attendanceData = [12, 19, 3, 5, 2, 3, 10]; // මෙතනට ඔයාගේ ඩේටා දාන්න
    $gradesDist = ['A' => 15, 'B' => 20, 'C' => 10, 'F' => 2]; 

    return view('admin.dashboard', compact(
        'totalStudents', 
        'totalTeachers', 
        'totalCourses', 
        'attendanceLogs', 
        'examGrades',
        'attendanceLabels',
        'attendanceData',
        'gradesDist'
    ));
    }

    public function attendanceLogs()
{
    
    $attendanceLogs = \App\Models\Attendance::with(['student.user', 'course'])
                        ->latest()
                        ->paginate(15);

    return view('admin.attendance.index', compact('attendanceLogs'));
}

public function examGrades()
{
    $examGrades = \App\Models\Grade::with(['student.user', 'course'])
                    ->latest()
                    ->paginate(15);

    return view('admin.grades.index', compact('examGrades'));
}
//  Edit Form Function 
public function editAttendance($id)
{
    $attendance = \App\Models\Attendance::findOrFail($id);
    $courses = \App\Models\Course::all(); // Module එක වෙනස් කරන්න ඕන වුණොත් තෝරන්න
    return view('admin.attendance.edit', compact('attendance', 'courses'));
}

// 2. Data Update Function 
public function updateAttendance(\Illuminate\Http\Request $request, $id)
{
    $request->validate([
        'course_id' => 'required|exists:courses,id',
        'date' => 'required|date',
        'status' => 'required|in:Present,Absent',
    ]);

    $attendance = \App\Models\Attendance::findOrFail($id);
    $attendance->update([
        'course_id' => $request->course_id,
        'date' => $request->date,
        'status' => $request->status,
    ]);

    return redirect()->route('admin.attendance.logs')->with('success', 'Attendance record updated successfully!');
}

// 3. Data Delete Function
public function destroyAttendance($id)
{
    $attendance = \App\Models\Attendance::findOrFail($id);
    $attendance->delete();

    return redirect()->route('admin.attendance.logs')->with('success', 'Attendance record deleted successfully!');
}
// 1. Grade Edit Form Function 
public function editGrade($id)
{
    $grade = \App\Models\Grade::findOrFail($id);
    $courses = \App\Models\Course::all();
    return view('admin.grades.edit', compact('grade', 'courses'));
}

// 2. marks and Grade Update Function 
public function updateGrade(\Illuminate\Http\Request $request, $id)
{
    $request->validate([
        'course_id' => 'required|exists:courses,id',
        'marks' => 'required|numeric|min:0|max:100',
        'grade' => 'required|string|max:2',
    ]);

    $gradeRecord = \App\Models\Grade::findOrFail($id);
    $gradeRecord->update([
        'course_id' => $request->course_id,
        'marks' => $request->marks,
        'grade' => $request->grade,
    ]);

    return redirect()->route('admin.exam.grades')->with('success', 'Exam grade record updated successfully!');
}

// 3. Grade Delete Function
public function destroyGrade($id)
{
    $gradeRecord = \App\Models\Grade::findOrFail($id);
    $gradeRecord->delete();

    return redirect()->route('admin.exam.grades')->with('success', 'Exam grade record deleted successfully!');
}
public function dashboard()
{
    $attendanceData = [];
    $attendanceLabels = [];
    
    for ($i = 6; $i >= 0; $i--) {
        $date = Carbon::now()->subDays($i)->format('Y-m-d');
        $attendanceLabels[] = Carbon::parse($date)->format('D (m/d)');
        
        
        $attendanceData[] = Attendance::where('date', $date)
                                      ->where('status', 'Present')
                                      ->count();
    }

    
    $gradesDist = [
        'A' => Grade::where('marks', '>=', 75)->count(),
        'B' => Grade::where('between', [65, 74])->count(), // හෝ whereBetween
        'C' => Grade::where('between', [50, 64])->count(),
        'F' => Grade::where('marks', '<', 40)->count(),
    ];
    
    

    return view('admin.dashboard', compact('attendanceLabels', 'attendanceData', 'gradesDist'));
}
public function exportStudentsCSV()
{
    $students = Student::with('user')->get();
    
    $filename = "students_report_" . date('Y-m-d') . ".csv";
    $headers = [
        "Content-type"        => "text/csv",
        "Content-Disposition" => "attachment; filename=$filename",
        "Pragma"              => "no-cache",
        "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
        "Expires"             => "0"
    ];

    $columns = ['Student Name', 'Email', 'Status'];

    $callback = function() use($students, $columns) {
        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);

        foreach ($students as $student) {
            $row['Student Name'] = $student->user->name ?? 'N/A';
            $row['Email']        = $student->user->email ?? 'N/A';
            $row['Status']       = $student->status ?? 'Active';

            fputcsv($file, array($row['Student Name'], $row['Email'], $row['Status']));
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}

// 2. Simple PDF View Method (Browser Print Friendly)
public function exportStudentsPDF()
{
    $students = Student::with('user')->get();
    return view('admin.reports.students_pdf', compact('students'));
}
}
