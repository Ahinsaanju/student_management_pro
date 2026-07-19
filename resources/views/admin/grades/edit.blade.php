@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold text-dark mb-0">Edit Exam Grade</h3>
                <a href="{{ route('admin.exam.grades') }}" class="btn btn-outline-secondary rounded-pill px-4 fw-semibold">
                    Cancel
                </a>
            </div>

            <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 16px;">
                <form action="{{ route('admin.exam.grades.update', $grade->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Student Name (Read Only) -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-secondary">Student Name</label>
                        <input type="text" class="form-control bg-light border-0 py-2" value="{{ $grade->student->user->name ?? 'N/A' }}" readonly>
                    </div>

                    <!-- Module Selection -->
                    <div class="mb-4">
                        <label for="course_id" class="form-label fw-semibold text-secondary">Module / Course</label>
                        <select name="course_id" id="course_id" class="form-select border-0 bg-light py-2" required>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ $grade->course_id == $course->id ? 'selected' : '' }}>
                                    {{ $course->course_code }} - {{ $course->course_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Marks Input -->
                    <div class="mb-4">
                        <label for="marks" class="form-label fw-semibold text-secondary">Marks (%)</label>
                        <input type="number" name="marks" id="marks" class="form-control border-0 bg-light py-2" value="{{ $grade->marks }}" min="0" max="100" required>
                    </div>

                    <!-- Grade Input -->
                    <div class="mb-4">
                        <label for="grade" class="form-label fw-semibold text-secondary">Grade (e.g., A+, B, C, F)</label>
                        <input type="text" name="grade" id="grade" class="form-control border-0 bg-light py-2" value="{{ $grade->grade }}" required>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-success rounded-pill py-2 fw-semibold shadow-sm">
                            Update Grade Record
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
@endsection