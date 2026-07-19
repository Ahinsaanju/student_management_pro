@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold text-dark mb-0">Edit Attendance Record</h3>
                <a href="{{ route('admin.attendance.logs') }}" class="btn btn-outline-secondary rounded-pill px-4 fw-semibold">
                    Cancel
                </a>
            </div>

            <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 16px;">
                <form action="{{ route('admin.attendance.update', $attendance->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Student Name (Read Only ) -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-secondary">Student Name</label>
                        <input type="text" class="form-control bg-light border-0 py-2" value="{{ $attendance->student->user->name ?? 'N/A' }}" readonly>
                    </div>

                    <!-- Module / Course Selection -->
                    <div class="mb-4">
                        <label for="course_id" class="form-label fw-semibold text-secondary">Module / Course</label>
                        <select name="course_id" id="course_id" class="form-select border-0 bg-light py-2" required>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ $attendance->course_id == $course->id ? 'selected' : '' }}>
                                    {{ $course->course_code }} - {{ $course->course_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Date Picker -->
                    <div class="mb-4">
                        <label for="date" class="form-label fw-semibold text-secondary">Date</label>
                        <input type="date" name="date" id="date" class="form-control border-0 bg-light py-2" value="{{ $attendance->date }}" required>
                    </div>

                    <!-- Status Selection -->
                    <div class="mb-4">
                        <label for="status" class="form-label fw-semibold text-secondary">Attendance Status</label>
                        <select name="status" id="status" class="form-select border-0 bg-light py-2" required>
                            <option value="Present" {{ $attendance->status == 'Present' ? 'selected' : '' }}>Present</option>
                            <option value="Absent" {{ $attendance->status == 'Absent' ? 'selected' : '' }}>Absent</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary rounded-pill py-2 fw-semibold shadow-sm">
                            Save Changes
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
@endsection