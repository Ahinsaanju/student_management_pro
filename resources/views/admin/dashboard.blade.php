@extends('layouts.app')

@section('content')
<div class="container-fluid py-2">
    
    <!-- Welcome Header -->
    <div class="mb-4">
        <h2 class="fw-bold text-dark mb-1">System Administrator Dashboard</h2>
        <p class="text-muted">Overview of Studora platform statistics and logs.</p>
    </div>

    <!-- Stats Overview Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3 bg-white" style="border-radius: 16px;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted fw-semibold mb-2">Total Students</h6>
                        <h3 class="fw-bold text-dark mb-0">{{ $totalStudents }}</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded-4"><i class="bi bi-people-fill text-primary fs-3"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3 bg-white" style="border-radius: 16px;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted fw-semibold mb-2">Total Lecturers</h6>
                        <h3 class="fw-bold text-dark mb-0">{{ $totalTeachers }}</h3>
                    </div>
                    <div class="bg-warning bg-opacity-10 p-3 rounded-4"><i class="bi bi-person-workspace text-warning fs-3"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3 bg-white" style="border-radius: 16px;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted fw-semibold mb-2">Active Modules</h6>
                        <h3 class="fw-bold text-dark mb-0">{{ $totalCourses }}</h3>
                    </div>
                    <div class="bg-success bg-opacity-10 p-3 rounded-4"><i class="bi bi-book text-success fs-3"></i></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Attendance Logs & Exam Grades Section -->
    <div class="row g-4">
        
        <!-- 📅 Attendance Logs Table -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 16px;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold text-dark mb-0"><i class="bi bi-calendar-check text-danger me-2"></i>Recent Attendance Logs</h5>
                    <span class="badge bg-light text-dark">Live Logs</span>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-muted fs-7">
                            <tr>
                                <th>Student</th>
                                <th>Module</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($attendanceLogs as $log)
                            <tr>
                                <td class="fw-semibold">{{ $log->student->user->name ?? 'N/A' }}</td>
                                <td>{{ $log->course->course_code ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge {{ $log->status == 'Present' ? 'bg-success' : 'bg-danger' }} bg-opacity-10 {{ $log->status == 'Present' ? 'text-success' : 'text-danger' }} rounded-pill px-3">
                                        {{ $log->status }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">No recent attendance records found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- 📝 Exam Grades Table -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 16px;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold text-dark mb-0"><i class="bi bi-file-earmark-spreadsheet text-success me-2"></i>Recent Exam Grades</h5>
                    <span class="badge bg-light text-dark">Latest Semesters</span>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-muted fs-7">
                            <tr>
                                <th>Student</th>
                                <th>Module</th>
                                <th>Marks</th>
                                <th>Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($examGrades as $grade)
                            <tr>
                                <td class="fw-semibold">{{ $grade->student->user->name ?? 'N/A' }}</td>
                                <td>{{ $grade->course->course_code ?? 'N/A' }}</td>
                                <td>{{ $grade->marks }}%</td>
                                <td><span class="badge bg-primary rounded-pill px-3">{{ $grade->grade }}</span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">No grading records available yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection