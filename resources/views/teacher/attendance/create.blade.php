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
        <h4 class="fw-bold text-dark mb-4"><i class="bi bi-calendar-check text-primary me-2"></i>Mark Student Attendance</h4>
        
        <form action="{{ route('teacher.attendance.store') }}" method="POST">
            @csrf
            
            <!-- Selector Box (Course & Date) -->
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-muted">Select Course / Module</label>
                    <select name="course_id" class="form-select" required>
                        <option value="" selected disabled>Choose Module</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->course_code }} - {{ $course->course_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-muted">Select Date</label>
                    <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>
            </div>

            <!-- Student List Table -->
            <div class="table-responsive mb-4">
                <table class="table table-hover align-middle">
                    <thead class="table-light text-muted">
                        <tr>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th class="text-center">Attendance Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                        <tr>
                            <td class="fw-semibold">#{{ $student->student_reg_no }}</td>
                            <td>{{ $student->user->name ?? 'N/A' }}</td>
                            <td class="text-center">
                                <!-- Present Button -->
                                <input type="radio" class="btn-check" name="attendance[{{ $student->id }}]" id="present_{{ $student->id }}" value="Present" checked autocomplete="off">
                                <label class="btn btn-outline-success rounded-pill px-4 btn-sm me-2" for="present_{{ $student->id }}">Present</label>

                                <!-- Absent Button -->
                                <input type="radio" class="btn-check" name="attendance[{{ $student->id }}]" id="absent_{{ $student->id }}" value="Absent" autocomplete="off">
                                <label class="btn btn-outline-danger rounded-pill px-4 btn-sm" for="absent_{{ $student->id }}">Absent</label>
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
                <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 fw-bold shadow-sm">Submit Attendance</button>
            </div>
        </form>
    </div>
</div>
@endsection