@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <!-- Student Portal Welcome Header -->
    <div class="mb-4">
        <h3 class="fw-bold text-dark">Student Portal</h3>
        <p class="text-muted">Welcome back! Track your academic progress, attendance, and exam grades.</p>
    </div>

    <!-- Quick Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted small fw-semibold">Enrolled Modules</span>
                        <h3 class="fw-bold text-dark my-1">6</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-4">
                        <i class="bi bi-journal-bookmark-fill fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted small fw-semibold">Overall Attendance</span>
                        <h3 class="fw-bold text-success my-1">88%</h3>
                    </div>
                    <div class="bg-success bg-opacity-10 text-success p-3 rounded-4">
                        <i class="bi bi-pie-chart-fill fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted small fw-semibold">Current GPA / Status</span>
                        <h3 class="fw-bold text-warning my-1">Good</h3>
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
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Module Name</th>
                                <th>Code</th>
                                <th>Attendance Rate</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-semibold">Web Application Development</td>
                                <td><span class="badge bg-light text-dark border">BICT 3101</span></td>
                                <td>92%</td>
                                <td><span class="badge bg-success-subtle text-success">Eligible</span></td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Database Management Systems</td>
                                <td><span class="badge bg-light text-dark border">BICT 3102</span></td>
                                <td>85%</td>
                                <td><span class="badge bg-success-subtle text-success">Eligible</span></td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Software Engineering Concepts</td>
                                <td><span class="badge bg-light text-dark border">BICT 3103</span></td>
                                <td>78%</td>
                                <td><span class="badge bg-warning-subtle text-warning">Warning</span></td>
                            </tr>
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
                        <small class="text-muted d-block">July 2026</small>
                        <span class="fw-semibold text-dark">Semester End Exam timetable released.</span>
                    </div>
                    <div class="list-group-item px-0 pt-3 border-0">
                        <small class="text-muted d-block">July 2026</small>
                        <span class="fw-semibold text-dark">80% Attendance requirement for Exam Admission.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection