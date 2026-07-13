@extends('layouts.app')

@section('content')
<div class="container-fluid py-2">
    
    <!-- Student Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Welcome Back, Student!</h2>
            <p class="text-muted mb-0">Track your academic progress and upcoming schedules here.</p>
        </div>
        <div>
            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary-subtle p-2 fs-7">
                <i class="bi bi-person-badge me-2"></i>Student Portal
            </span>
        </div>
    </div>

    <!-- Student Stats Row -->
    <div class="row g-4 mb-4">
        <!-- Card 1: My Attendance -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3 bg-white" style="border-radius: 16px;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted fw-semibold mb-2">My Attendance</h6>
                        <h3 class="fw-bold text-dark mb-1">88.5%</h3>
                        <span class="text-success fs-7 fw-medium"><i class="bi bi-shield-check me-1"></i>Eligible for Exams</span>
                    </div>
                    <div class="bg-success bg-opacity-10 p-3 rounded-4">
                        <i class="bi bi-calendar2-check-fill text-success fs-3"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2: Enrolled Modules -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3 bg-white" style="border-radius: 16px;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted fw-semibold mb-2">Enrolled Modules</h6>
                        <h3 class="fw-bold text-dark mb-1">5 Active</h3>
                        <span class="text-muted fs-7">Current Semester</span>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded-4">
                        <i class="bi bi-journal-bookmark-fill text-primary fs-3"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 3: GPA / Performance -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3 bg-white" style="border-radius: 16px;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted fw-semibold mb-2">Current GPA</h6>
                        <h3 class="fw-bold text-dark mb-1">3.65</h3>
                        <span class="text-warning fs-7 fw-medium"><i class="bi bi-trophy-fill me-1"></i>First Class Level</span>
                    </div>
                    <div class="bg-warning bg-opacity-10 p-3 rounded-4">
                        <i class="bi bi-star-fill text-warning fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Academic Schedule & Results Table -->
    <div class="row g-4">
        <!-- Left: Current Semester Modules -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 16px;">
                <h5 class="fw-bold text-dark mb-3">My Course Modules</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-muted fs-7">
                            <tr>
                                <th>Code</th>
                                <th>Module Title</th>
                                <th>Credits</th>
                                <th>Progress</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-semibold">IT1020</td>
                                <td>Web Application Development</td>
                                <td>4</td>
                                <td>
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 75%"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">IT1030</td>
                                <td>Database Management Systems</td>
                                <td>3</td>
                                <td>
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 90%"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">IT1040</td>
                                <td>Object Oriented Programming</td>
                                <td>4</td>
                                <td>
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 60%"></div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Right: Upcoming Deadlines & Exams -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 16px;">
                <h5 class="fw-bold text-dark mb-3">Upcoming Deadlines</h5>
                <div class="d-flex flex-column gap-3">
                    
                    <div class="p-3 bg-light rounded-3 border-start border-danger border-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="fw-bold mb-1 text-dark">Web Project Submission</h6>
                            <span class="badge bg-danger fs-8">2 Days Left</span>
                        </div>
                        <small class="text-muted">Submit via Student LMS Portal before 11:59 PM.</small>
                    </div>

                    <div class="p-3 bg-light rounded-3 border-start border-warning border-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="fw-bold mb-1 text-dark">DBMS Mid-Term Exam</h6>
                            <span class="badge bg-warning text-dark fs-8">Next Monday</span>
                        </div>
                        <small class="text-muted">Venue: Main Lab 02 | Time: 9.00 AM</small>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection