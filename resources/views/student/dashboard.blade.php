@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-3">
    <!-- Student Portal Welcome Header -->
    <div class="mb-4">
        <h3 class="fw-bold text-dark">Student Portal</h3>
        <p class="text-muted">Welcome back! Track your academic progress, attendance, and exam grades.</p>
    </div>

    <!-- Quick Stats Cards -->
    <div class="row g-3 mb-4">
        <!-- Enrolled Modules -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted small fw-semibold">Enrolled Modules</span>
                        <h3 class="fw-bold text-dark my-1">{{ $modulesCount ?? 0 }}</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-4">
                        <i class="bi bi-journal-bookmark-fill fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Overall Attendance -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted small fw-semibold">Overall Attendance</span>
                        <h3 class="fw-bold text-success my-1">{{ $overallAttendance ?? 0 }}%</h3>
                    </div>
                    <div class="bg-success bg-opacity-10 text-success p-3 rounded-4">
                        <i class="bi bi-pie-chart-fill fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Current GPA / Status -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted small fw-semibold">Current GPA / Status</span>
                        <h3 class="fw-bold text-warning my-1">
                            @if(($overallAttendance ?? 0) >= 80)
                                Good
                            @elseif(($overallAttendance ?? 0) >= 50)
                                Average
                            @else
                                Low
                            @endif
                        </h3>
                    </div>
                    <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-4">
                        <i class="bi bi-star-fill fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row g-4">
        <!-- Enrolled Modules Overview -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
                <h5 class="fw-bold mb-3"><i class="bi bi-journal-text me-2 text-primary"></i>My Enrolled Modules Overview</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Module Name</th>
                                <th>Code</th>
                                <th>Credits</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($modules as $module)
                                <tr>
                                    <td class="fw-semibold">{{ $module->name ?? $module->module_name ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge bg-light text-dark border">{{ $module->code ?? $module->module_code ?? 'N/A' }}</span>
                                    </td>
                                    <td>{{ $module->credits ?? '-' }} Credits</td>
                                    <td class="text-center">
                                        <span class="badge bg-success-subtle text-success px-3 py-1 rounded-pill">Active</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">
                                        <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                        No enrolled modules found for your course.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Notice Board -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
                <h5 class="fw-bold mb-3"><i class="bi bi-bell me-2 text-danger"></i>Notice Board</h5>
                <div class="list-group list-group-flush">
                    <div class="list-group-item px-0 border-bottom">
                        <small class="text-muted d-block">August 2026</small>
                        <span class="fw-semibold text-dark">Semester End Exam timetable released.</span>
                    </div>
                    <div class="list-group-item px-0 pt-3 border-0">
                        <small class="text-muted d-block">August 2026</small>
                        <span class="fw-semibold text-dark">80% Attendance requirement for Exam Admission.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection