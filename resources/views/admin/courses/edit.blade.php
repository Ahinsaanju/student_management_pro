@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card border-0 shadow-sm p-4 rounded-4 col-md-8 mx-auto bg-white">
        <h4 class="fw-bold mb-4 text-dark"><i class="bi bi-pencil-square text-primary me-2"></i>Edit Course / Module Details</h4>

        <!-- Validation Errors Display -->
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('admin.courses.update', $course->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Course Code (ReadOnly) -->
            <div class="mb-3">
                <label class="form-label fw-semibold text-muted">Course Code</label>
                <input type="text" name="course_code" value="{{ old('course_code', $course->course_code) }}" class="form-control bg-light" readonly required>
            </div>

            <!-- Course Title / Name -->
            <div class="mb-3">
                <label class="form-label fw-semibold text-muted">Course Title</label>
                <input type="text" name="course_name" value="{{ old('course_name', $course->course_name) }}" class="form-control" required>
            </div>

            <!-- Credits (No Max Limit) -->
            <div class="mb-3">
                <label class="form-label fw-semibold text-muted">Credits</label>
                <input type="number" name="credits" value="{{ old('credits', $course->credits) }}" class="form-control" min="1" required>
            </div>

            <!-- Semester Select (1 to 12) -->
            <div class="mb-3">
                <label class="form-label fw-semibold text-muted">Semester</label>
                <select name="semester" class="form-select" required>
                    <option value="" disabled>Select Semester</option>
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="Semester {{ $i }}" {{ old('semester', $course->semester) == "Semester $i" ? 'selected' : '' }}>
                            Semester {{ $i }}
                        </option>
                    @endfor
                </select>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold">Update Course</button>
                <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary rounded-pill px-4">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection