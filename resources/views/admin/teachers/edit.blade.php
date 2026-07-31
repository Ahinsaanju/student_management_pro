@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card border-0 shadow-sm p-4 rounded-4 col-md-8 mx-auto">
        <h4 class="fw-bold mb-4">Edit Teacher Details</h4>

        <!-- Form action passes teacher_code -->
        <form action="{{ route('admin.teachers.update', $teacher->teacher_code) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-semibold">Teacher Code</label>
                <input type="text" class="form-control bg-light" value="{{ $teacher->teacher_code }}" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Full Name</label>
                <input type="text" name="name" value="{{ old('name', $teacher->user->name ?? '') }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Email Address</label>
                <input type="email" name="email" value="{{ old('email', $teacher->user->email ?? '') }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Phone Number</label>
                <input type="text" name="phone" value="{{ old('phone', $teacher->phone ?? '') }}" class="form-control" required>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary px-4">Update Teacher</button>
                <a href="{{ route('admin.teachers.index') }}" class="btn btn-secondary px-4">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection