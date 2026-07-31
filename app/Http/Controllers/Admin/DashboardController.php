<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\Attendance;
use App\Models\Result; // 
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $statusFilter = $request->input('status');

        $totalStudents = Student::count();
        $totalTeachers = Teacher::count();
        $totalCourses  = Course::count();

        // 1. Recent Attendance Logs Query
        $attendanceQuery = Attendance::with(['student.user', 'course']);

        if ($request->filled('search')) {
            $attendanceQuery->where(function($q) use ($search) {
                $q->whereHas('student.user', function($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('course', function($courseQuery) use ($search) {
                    $courseQuery->where('course_code', 'like', "%{$search}%");
                });
            });
        }

        if ($request->filled('status')) {
            $attendanceQuery->where('status', $statusFilter);
        }

        $attendanceLogs = $attendanceQuery->latest('id')->take(5)->get();


        // 2. Recent Exam Grades Query 
        $gradesQuery = Result::with('student.user');

        if ($request->filled('search')) {
            $gradesQuery->where(function($q) use ($search) {
                $q->whereHas('student.user', function($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%");
                })
                ->orWhere('subject_code', 'like', "%{$search}%")
                ->orWhere('subject_name', 'like', "%{$search}%");
            });
        }

        $examGrades = $gradesQuery->latest('updated_at')->take(5)->get();


        // 3. Analytics & Chart Data
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
            'A' => Result::where('marks', '>=', 75)->count(),
            'B' => Result::whereBetween('marks', [65, 74])->count(),
            'C' => Result::whereBetween('marks', [50, 64])->count(),
            'F' => Result::where('marks', '<', 40)->count(),
        ];

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
        $attendanceLogs = Attendance::with(['student.user', 'course'])
                            ->latest()
                            ->paginate(15);

        return view('admin.attendance.index', compact('attendanceLogs'));
    }

    public function examGrades()
    {
        
        $examGrades = Result::with('student.user')
                        ->latest('updated_at')
                        ->paginate(15);

        return view('admin.grades.index', compact('examGrades'));
    }

    // Edit Attendance Form
    public function editAttendance($id)
    {
        $attendance = Attendance::findOrFail($id);
        $courses = Course::all();
        return view('admin.attendance.edit', compact('attendance', 'courses'));
    }

    // Attendance Update Function
    public function updateAttendance(Request $request, $id)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'date'      => 'required|date',
            'status'    => 'required|in:Present,Absent',
        ]);

        $attendance = Attendance::findOrFail($id);
        $attendance->update([
            'course_id' => $request->course_id,
            'date'      => $request->date,
            'status'    => $request->status,
        ]);

        return redirect()->route('admin.attendance.logs')->with('success', 'Attendance record updated successfully!');
    }

    // Delete Attendance
    public function destroyAttendance($id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();

        return redirect()->route('admin.attendance.logs')->with('success', 'Attendance record deleted successfully!');
    }

    // Edit Grade Form
    public function editGrade($id)
    {
        $grade = Result::findOrFail($id);
        $courses = Course::all();
        return view('admin.grades.edit', compact('grade', 'courses'));
    }

    // Update Grade Function
    public function updateGrade(Request $request, $id)
    {
        $request->validate([
            'marks' => 'required|numeric|min:0|max:100',
            'grade' => 'required|string|max:2',
        ]);

        $gradeRecord = Result::findOrFail($id);
        $gradeRecord->update([
            'marks' => $request->marks,
            'grade' => $request->grade,
        ]);

        return redirect()->route('admin.exam.grades')->with('success', 'Exam grade record updated successfully!');
    }

    // Delete Grade
    public function destroyGrade($id)
    {
        $gradeRecord = Result::findOrFail($id);
        $gradeRecord->delete();

        return redirect()->route('admin.exam.grades')->with('success', 'Exam grade record deleted successfully!');
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

    public function exportStudentsPDF()
    {
        $students = Student::with('user')->get();
        return view('admin.reports.students_pdf', compact('students'));
    }
}