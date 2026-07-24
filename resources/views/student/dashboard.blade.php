@extends('layouts.app')

@section('content')
<div class="container-fluid py-2">
    <!-- Welcome Header -->
    <div class="mb-4">
        <h2 class="fw-bold text-dark mb-1">Student Portal</h2>
        <p class="text-muted">Welcome back! Track your academic progress, attendance, and exam grades.</p>
    </div>

    <!-- Overview Stats -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3 bg-white" style="border-radius: 16px;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted fw-semibold mb-2">Enrolled Modules</h6>
                        <h3 class="fw-bold text-dark mb-0">6</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded-4"><i class="bi bi-book-half text-primary fs-3"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3 bg-white" style="border-radius: 16px;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted fw-semibold mb-2">Overall Attendance</h6>
                        <h3 class="fw-bold text-success mb-0">88%</h3>
                    </div>
                    <div class="bg-success bg-opacity-10 p-3 rounded-4"><i class="bi bi-pie-chart-fill text-success fs-3"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3 bg-white" style="border-radius: 16px;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted fw-semibold mb-2">Current GPA / Status</h6>
                        <h3 class="fw-bold text-dark mb-0">Good</h3>
                    </div>
                    <div class="bg-warning bg-opacity-10 p-3 rounded-4"><i class="bi bi-star-fill text-warning fs-3"></i></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Grades & Announcements -->
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 16px;">
                <h5 class="fw-bold text-dark mb-3"><i class="bi bi-journal-text text-primary me-2"></i>My Enrolled Modules Overview</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-muted">
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
                                <td><span class="badge bg-light text-dark">BICT 3101</span></td>
                                <td>92%</td>
                                <td><span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Eligible</span></td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Database Management Systems</td>
                                <td><span class="badge bg-light text-dark">BICT 3102</span></td>
                                <td>85%</td>
                                <td><span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Eligible</span></td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Software Engineering Concepts</td>
                                <td><span class="badge bg-light text-dark">BICT 3103</span></td>
                                <td>78%</td>
                                <td><span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3">Warning</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 16px;">
                <h5 class="fw-bold text-dark mb-3"><i class="bi bi-bell text-danger me-2"></i>Notice Board</h5>
                <div class="border-bottom pb-2 mb-3">
                    <small class="text-muted">July 2026</small>
                    <p class="fw-semibold mb-0 text-dark">Semester End Exam timetable released.</p>
                </div>
                <div class="border-bottom pb-2 mb-3">
                    <small class="text-muted">July 2026</small>
                    <p class="fw-semibold mb-0 text-dark">80% Attendance requirement for Exam Admission.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection