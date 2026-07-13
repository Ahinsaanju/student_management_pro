@extends('layouts.app')

@section('content')
<div class="container-fluid py-2">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        <!-- 📝 Add New Course Form -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 16px;">
                <h5 class="fw-bold text-dark mb-4"><i class="bi bi-book-half text-primary me-2"></i>Add New Course</h5>
                
                <form action="{{ route('admin.courses.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted">Course Code</label>
                        <input type="text" name="course_code" class="form-control" placeholder="e.g. IT1020" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted">Course Title</label>
                        <input type="text" name="course_name" class="form-control" placeholder="e.g. Web Application Dev" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted">Credits</label>
                        <input type="number" name="credits" class="form-control" placeholder="e.g. 4" min="1" max="6" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted">Semester</label>
                        <select name="semester" class="form-select" required>
                            <option value="" selected disabled>Select Semester</option>
                            <option value="Semester 1">Semester 1</option>
                            <option value="Semester 2">Semester 2</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-bold mt-2">Add Course</button>
                </form>
            </div>
        </div>

        <!-- 📋 Course List Table -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 16px;">
                <h5 class="fw-bold text-dark mb-4"><i class="bi bi-journal-text text-primary me-2"></i>Course Modules</h5>
                
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-muted fs-7">
                            <tr>
                                <th>Code</th>
                                <th>Course Title</th>
                                <th>Credits</th>
                                <th>Semester</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($courses as $course)
                            <tr>
                                <td class="fw-semibold text-primary">{{ $course->course_code }}</td>
                                <td>{{ $course->course_name }}</td>
                                <td><span class="badge bg-secondary rounded-pill px-3">{{ $course->credits }} Credits</span></td>
                                <td>{{ $course->semester }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">No courses added yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection