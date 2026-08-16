@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card border-0 shadow-sm p-4 rounded-4">
        <h4 class="fw-bold mb-3">Edit Student Details</h4>

        <form action="{{ route('admin.students.update', $student->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-semibold">Student Name</label>
                <input type="text" name="name" value="{{ old('name', $student->user->name ?? '') }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" value="{{ old('email', $student->user->email ?? '') }}" class="form-control" required>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary rounded-pill px-4">Update Student</button>
                <a href="{{ route('admin.students.index') }}" class="btn btn-light rounded-pill px-4">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection