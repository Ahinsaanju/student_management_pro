@extends('layouts.app')

@section('content')
<div class="container-fluid py-3">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="bi bi-journal-text text-primary me-2"></i>My Course Modules
            </h4>
            <p class="text-muted small mb-0">
                Course: <span class="fw-bold text-primary">{{ $course->course_name ?? $course->name ?? $student->course ?? 'N/A' }}</span>
                @if(isset($course->course_code))
                    <span class="badge bg-secondary ms-2">{{ $course->course_code }}</span>
                @endif
            </p>
        </div>
    </div>

    <!-- Modules Grid -->
    <div class="row g-4">
        @if(isset($modules) && $modules->count() > 0)
            @foreach($modules as $module)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100" style="border-radius: 16px;">
                        <div class="card-body p-4 d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <span class="badge bg-primary-subtle text-primary fw-bold px-3 py-2 rounded-pill">
                                        {{ $module->module_code }}
                                    </span>
                                    <span class="badge bg-light text-dark border rounded-pill">
                                        {{ $module->credits }} Credits
                                    </span>
                                </div>
                                
                                <h5 class="fw-bold text-dark mb-2">{{ $module->name ?? $module->module_name }}</h5>
                                <p class="text-muted small mb-0">
                                    {{ $module->description ?? 'No description provided.' }}
                                </p>
                            </div>
                            
                            @if(isset($module->semester))
                                <div class="border-top mt-3 pt-3 text-muted small">
                                    <i class="bi bi-calendar3 me-1"></i> {{ $module->semester }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12 text-center py-5">
                <div class="card border-0 shadow-sm p-5" style="border-radius: 16px;">
                    <i class="bi bi-journal-x text-muted display-4 mb-3"></i>
                    <h5 class="fw-bold text-muted">No Modules Found</h5>
                    <p class="text-muted small mb-0">There are no modules assigned to your course yet.</p>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection