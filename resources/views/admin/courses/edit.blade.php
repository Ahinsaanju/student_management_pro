@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card border-0 shadow-sm p-4 rounded-4 col-md-8 mx-auto">
        <h4 class="fw-bold mb-4">Edit Course / Module Details</h4>

        <!-- Form action passes course_code / id -->
        <form action="{{ route('admin.courses.update', $course->course_code ?? $course->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-semibold">Course Code</label>
                <input type="text" class="form-control bg-light" value="{{ $course->course_code ?? $course->id }}" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Course Name</label>
                <input type="text" name="name" value="{{ old('name', $course->name ?? '') }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Credits / Description</label>
                <input type="text" name="description" value="{{ old('description', $course->description ?? '') }}" class="form-control">
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary px-4">Update Course</button>
                <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary px-4">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection