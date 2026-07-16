@extends('layouts.app')

@section('content')
<div class="container-fluid py-3">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 16px;">
        <h4 class="fw-bold text-dark mb-4"><i class="bi bi-file-earmark-spreadsheet text-primary me-2"></i>Submit Exam Marks</h4>
        
        <form action="{{ route('teacher.grades.store') }}" method="POST">
            @csrf
            
            <!-- Course Selector -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-muted">Select Course / Module</label>
                    <select name="course_id" class="form-select" required>
                        <option value="" selected disabled>Choose Module</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->course_code }} - {{ $course->course_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Student Marks Table -->
            <div class="table-responsive mb-4">
                <table class="table table-hover align-middle">
                    <thead class="table-light text-muted">
                        <tr>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th style="width: 200px;">Marks (%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                        <tr>
                            <td class="fw-semibold">#{{ $student->student_reg_no }}</td>
                            <td>{{ $student->user->name ?? 'N/A' }}</td>
                            <td>
                                <div class="input-group input-group-sm">
                                    <input type="number" name="marks[{{ $student->id }}]" class="form-control" placeholder="Enter marks" min="0" max="100">
                                    <span class="input-group-text">%</span>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-4">No registered students found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Submit Button -->
            <div class="text-end">
                <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 fw-bold shadow-sm">Submit Grades</button>
            </div>
        </form>
    </div>
</div>
@endsection