@extends('layouts.app')

@section('content')
<div class="container-fluid py-2">
    
    <!-- Dashboard Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Dashboard Overview</h2>
            <p class="text-muted mb-0">Welcome back! Here's what's happening with StuDora today.</p>
        </div>
        <div>
            <span class="badge bg-light text-dark border p-2 fs-7">
                <i class="bi bi-calendar3 me-2 text-primary"></i>{{ date('l, F j, Y') }}
            </span>
        </div>
    </div>

    <!-- 4 Stats Cards Row -->
    <div class="row g-4 mb-4">
        <!-- Card 1: Total Students -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100 p-3 bg-white" style="border-radius: 16px;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted fw-semibold mb-2">Total Students</h6>
                        <h3 class="fw-bold text-dark mb-1">1,250</h3>
                        <span class="text-success fs-7 fw-medium"><i class="bi bi-arrow-up me-1"></i>+4.5% <span class="text-muted fw-normal">this month</span></span>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded-4">
                        <i class="bi bi-people-fill text-primary fs-3"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2: Active Courses -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100 p-3 bg-white" style="border-radius: 16px;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted fw-semibold mb-2">Active Courses</h6>
                        <h3 class="fw-bold text-dark mb-1">12</h3>
                        <span class="text-muted fs-7">Across 4 Departments</span>
                    </div>
                    <div class="bg-success bg-opacity-10 p-3 rounded-4">
                        <i class="bi bi-book-half text-success fs-3"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 3: Today Attendance -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100 p-3 bg-white" style="border-radius: 16px;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted fw-semibold mb-2">Today's Attendance</h6>
                        <h3 class="fw-bold text-dark mb-1">94.2%</h3>
                        <span class="text-success fs-7 fw-medium"><i class="bi bi-check-circle-fill me-1"></i>On Time</span>
                    </div>
                    <div class="bg-warning bg-opacity-10 p-3 rounded-4">
                        <i class="bi bi-calendar-check-fill text-warning fs-3"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 4: Pending Actions -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100 p-3 bg-white" style="border-radius: 16px;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted fw-semibold mb-2">Pending Requests</h6>
                        <h3 class="fw-bold text-dark mb-1">7</h3>
                        <span class="text-danger fs-7 fw-medium"><i class="bi bi-exclamation-circle-fill me-1"></i>Requires Action</span>
                    </div>
                    <div class="bg-danger bg-opacity-10 p-3 rounded-4">
                        <i class="bi bi-bell-fill text-danger fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Section: Recent Students Table & Quick Actions -->
    <div class="row g-4">
        <!-- Left: Recent Registered Students Table -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 16px;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold text-dark mb-0">Recent Student Enrollments</h5>
                    <a href="#" class="btn btn-sm btn-outline-primary rounded-pill px-3 fs-7">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-muted fs-7 uppercase">
                            <tr>
                                <th scope="col">Student ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Course</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-semibold">#STD-2061</td>
                                <td>Kasun Perera</td>
                                <td>Software Engineering</td>
                                <td><span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Active</span></td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">#STD-2062</td>
                                <td>Dilini Silva</td>
                                <td>Data Science</td>
                                <td><span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Active</span></td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">#STD-2063</td>
                                <td>Nimal Fernando</td>
                                <td>Cyber Security</td>
                                <td><span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3">Pending</span></td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">#STD-2064</td>
                                <td>Amara Wickrama</td>
                                <td>Network Systems</td>
                                <td><span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Active</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Right: Quick Portal Actions -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm p-4 bg-white h-100" style="border-radius: 16px;">
                <h5 class="fw-bold text-dark mb-4">Quick Shortcuts</h5>
                <div class="d-grid g-3 gap-3">
                    <a href="#" class="btn btn-light border text-start p-3 rounded-3 d-flex align-items-center justify-content-between hover-shadow">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-person-plus-fill text-primary fs-4 me-3"></i>
                            <div>
                                <div class="fw-bold text-dark fs-6">Add New Student</div>
                                <small class="text-muted fs-7">Register a new student</small>
                            </div>
                        </div>
                        <i class="bi bi-chevron-right text-muted"></i>
                    </a>
                    
                    <a href="#" class="btn btn-light border text-start p-3 rounded-3 d-flex align-items-center justify-content-between hover-shadow">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-journal-plus text-success fs-4 me-3"></i>
                            <div>
                                <div class="fw-bold text-dark fs-6">Create New Course</div>
                                <small class="text-muted fs-7">Setup a new subject modules</small>
                            </div>
                        </div>
                        <i class="bi bi-chevron-right text-muted"></i>
                    </a>

                    <a href="#" class="btn btn-light border text-start p-3 rounded-3 d-flex align-items-center justify-content-between hover-shadow">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-clipboard-check text-warning fs-4 me-3"></i>
                            <div>
                                <div class="fw-bold text-dark fs-6">Mark Attendance</div>
                                <small class="text-muted fs-7">Take daily student logs</small>
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