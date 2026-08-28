@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0">My Assigned Modules</h3>
            <p class="text-muted mb-0">Manage and view all your assigned teaching modules</p>
        </div>
    </div>

    <!-- Modules Grid -->
    <div class="row g-4">
        @forelse($modules as $module)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm rounded-3">
                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <!-- Module Code Badge -->
                                <span class="badge bg-primary-subtle text-primary fw-semibold px-3 py-2 rounded-pill">
                                    {{ $module->module_code }}
                                </span>
                                <!-- Main Course Name (Sub-label) -->
                                <small class="text-muted fw-bold">
                                    {{ $module->course->course_name ?? $module->course->name ?? 'Course' }}
                                </small>
                            </div>
                            
                            <!-- Module Name -->
                            <h5 class="card-title fw-bold text-dark mb-2">
                                {{ $module->name ?? $module->module_name }}
                            </h5>
                            
                            <!-- Credits Info -->
                            <p class="card-text text-muted small">
                                Academic Credits: <span class="fw-semibold text-dark">{{ $module->credits }}</span>
                            </p>
                        </div>

                        <!-- Action Buttons -->
                        <div class="pt-3 mt-3 border-top d-flex justify-content-between gap-2">
                            <a href="{{ route('teacher.attendance.create', ['module_id' => $module->id]) }}" class="btn btn-sm btn-outline-primary w-50">
                                <i class="bi bi-calendar-check me-1"></i> Attendance
                            </a>
                            <a href="{{ route('teacher.grades.create', ['module_id' => $module->id]) }}" class="btn btn-sm btn-outline-success w-50">
                                <i class="bi bi-journal-check me-1"></i> Marks
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center py-4 rounded-3" role="alert">
                    <i class="bi bi-info-circle fs-4 d-block mb-2"></i>
                    No modules assigned to you yet.
                </div>
            </div>
        @endforelse
    </div>

</div>
@endsection