@extends('layouts.app')

@section('content')
<div class="row g-4">
    <!-- Dashboard Heading -->
    <div class="col-12">
        <h2 class="fw-bold text-dark">Dashboard Overview</h2>
        <p class="text-muted">Welcome to StuDora Admin Portal.</p>
    </div>

    <!-- Stats Cards -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 15px;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-muted fw-semibold mb-1">Total Students</h6>
                    <h3 class="fw-bold text-dark mb-0">1,250</h3>
                </div>
                <div class="bg-primary bg-opacity-10 p-3 rounded-3">
                    <i class="bi bi-people-fill text-primary fs-3"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 15px;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-muted fw-semibold mb-1">Active Courses</h6>
                    <h3 class="fw-bold text-dark mb-0">12</h3>
                </div>
                <div class="bg-success bg-opacity-10 p-3 rounded-3">
                    <i class="bi bi-book-half text-success fs-3"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 15px;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-muted fw-semibold mb-1">Today Attendance</h6>
                    <h3 class="fw-bold text-dark mb-0">94%</h3>
                </div>
                <div class="bg-warning bg-opacity-10 p-3 rounded-3">
                    <i class="bi bi-calendar-check-fill text-warning fs-3"></i>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection