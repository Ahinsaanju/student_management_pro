@extends('layouts.app')

@section('content')
<!-- Welcome Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-dark mb-1">
            Welcome back, {{ auth()->user()->name ?? 'Lecturer' }}! 👋
        </h2>
        <p class="text-muted mb-0">Manage your course modules, mark attendance, and submit student grades.</p>
    </div>
    
    <div class="d-flex gap-2">
        <a href="{{ route('teacher.attendance.create') }}" class="btn btn-primary rounded-pill px-3 fw-semibold">
            <i class="bi bi-calendar-check me-1"></i> Mark Attendance
        </a>
        <a href="{{ route('teacher.grades.create') }}" class="btn btn-success rounded-pill px-3 fw-semibold">
            <i class="bi bi-plus-circle me-1"></i> Add Grades
        </a>
    </div>
</div>
    <!-- Quick Stats -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3 bg-white" style="border-radius: 16px;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted fw-semibold mb-2">Assigned Modules</h6>
                        <h3 class="fw-bold text-dark mb-0">{{ $assignedModulesCount }}</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded-4"><i class="bi bi-journal-bookmark-fill text-primary fs-3"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3 bg-white" style="border-radius: 16px;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted fw-semibold mb-2">Total Students</h6>
                        <h3 class="fw-bold text-dark mb-0">{{ $totalStudentsCount }}</h3>
                    </div>
                    <div class="bg-info bg-opacity-10 p-3 rounded-4"><i class="bi bi-people-fill text-info fs-3"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3 bg-white" style="border-radius: 16px;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted fw-semibold mb-2">Pending Assessments</h6>
                        <h3 class="fw-bold text-dark mb-0">{{ $pendingAssessmentsCount }}</h3>
                    </div>
                    <div class="bg-warning bg-opacity-10 p-3 rounded-4"><i class="bi bi-clock-history text-warning fs-3"></i></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Action Cards -->
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 16px;">
                <h5 class="fw-bold text-dark mb-3"><i class="bi bi-calendar-check text-primary me-2"></i>Attendance Management</h5>
                <p class="text-muted fs-7">Mark daily student attendance for your assigned modules quickly.</p>
                <a href="{{ route('teacher.attendance.create') }}" class="btn btn-outline-primary rounded-pill w-100 fw-semibold">Take Attendance Now</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 16px;">
                <h5 class="fw-bold text-dark mb-3"><i class="bi bi-award text-success me-2"></i>Exams & Grading</h5>
                <p class="text-muted fs-7">Enter semester assessment marks and final exam grades for students.</p>
                <a href="{{ route('teacher.grades.create') }}" class="btn btn-outline-success rounded-pill w-100 fw-semibold">Manage Grades</a>
            </div>
        </div>
    </div>
</div>
@endsection