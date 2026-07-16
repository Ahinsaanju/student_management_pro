@extends('layouts.app')

@section('content')
<div class="container-fluid py-2">
    
    <!-- Teacher Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Teacher Portal</h2>
            <p class="text-muted mb-0">Manage your assigned modules, student attendance, and grading.</p>
        </div>
        <div>
            <span class="badge bg-warning bg-opacity-10 text-warning border border-warning-subtle p-2 fs-7">
                <i class="bi bi-person-workspace me-2"></i>Faculty Mode
            </span>
        </div>
    </div>

    <!-- Teacher Stats Row -->
    <div class="row g-4 mb-4">
        <!-- Card 1: My Classes -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3 bg-white" style="border-radius: 16px;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted fw-semibold mb-2">My Modules</h6>
                        <h3 class="fw-bold text-dark mb-1">3 Assigned</h3>
                        <span class="text-muted fs-7">This Semester</span>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded-4">
                        <i class="bi bi-journal-check text-primary fs-3"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2: Total Students to Teach -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3 bg-white" style="border-radius: 16px;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted fw-semibold mb-2">Total Students</h6>
                        <h3 class="fw-bold text-dark mb-1">180 Registered</h3>
                        <span class="text-success fs-7 fw-medium"><i class="bi bi-arrow-up me-1"></i>Active Batches</span>
                    </div>
                    <div class="bg-success bg-opacity-10 p-3 rounded-4">
                        <i class="bi bi-people-fill text-success fs-3"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 3: Pending Exam Papers / Grading -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3 bg-white" style="border-radius: 16px;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted fw-semibold mb-2">Pending Grading</h6>
                        <h3 class="fw-bold text-dark mb-1">2 Assignments</h3>
                        <span class="text-danger fs-7 fw-medium"><i class="bi bi-clock-history me-1"></i>Action Required</span>
                    </div>
                    <div class="bg-danger bg-opacity-10 p-3 rounded-4">
                        <i class="bi bi-file-earmark-ruled text-danger fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Teacher Action Schedule & Active Modules -->
    <div class="row g-4">
        <!-- Left: My Assigned Modules -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 16px;">
                <h5 class="fw-bold text-dark mb-3">Assigned Course Modules</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-muted fs-7">
                            <tr>
                                <th>Module</th>
                                <th>Batch</th>
                                <th>Next Class</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-semibold">Web Application Development</td>
                                <td>BICT (Hons) - Y2</td>
                                <td>Tomorrow, 8:30 AM</td>
                                <td><button class="btn btn-sm btn-primary rounded-pill px-3 fs-7">Mark Attendance</button></td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Database Management Systems</td>
                                <td>BICT (Hons) - Y2</td>
                                <td>Thursday, 10:30 AM</td>
                                <td><button class="btn btn-sm btn-primary rounded-pill px-3 fs-7">Mark Attendance</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Right: Faculty Quick Shortcuts -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm p-4 bg-white h-100" style="border-radius: 16px;">
                <h5 class="fw-bold text-dark mb-4">Teacher Actions</h5>
                <div class="d-grid gap-3">
                    <a href="#" class="btn btn-light border text-start p-3 rounded-3 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-file-plus-fill text-success fs-4 me-3"></i>
                            <div>
                                <div class="fw-bold text-dark fs-6">Upload Marks / Grades</div>
                                <small class="text-muted fs-7">Add semester exam results</small>
                            </div>
                        </div>
                        <i class="bi bi-chevron-right text-muted"></i>
                    </a>
                    
                    <a href="#" class="btn btn-light border text-start p-3 rounded-3 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-chat-left-text-fill text-warning fs-4 me-3"></i>
                            <div>
                                <div class="fw-bold text-dark fs-6">Student Noticeboard</div>
                                <small class="text-muted fs-7">Post announcements to classes</small>
                            </div>
                        </div>
                        <i class="bi bi-chevron-right text-muted"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection