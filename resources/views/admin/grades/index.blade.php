@extends('layouts.app')

@section('content')
<div class="container-fluid py-3">
    
    <!-- Success Alert Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">All Student Exam Grades</h2>
            <p class="text-muted">View, edit and monitor overall academic performance and marks.</p>
        </div>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4 fw-semibold shadow-sm">
            <i class="bi bi-arrow-left me-2"></i>Back to Dashboard
        </a>
    </div>

    <!-- Main Table Card -->
    <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 16px;">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-muted fs-7">
                    <tr>
                        <th>Student Name</th>
                        <th>Module Code</th>
                        <th>Marks</th>
                        <th class="text-center">Grade</th>
                        <th class="text-center">Action</th> <!-- 👈 අලුත් Column එක -->
                    </tr>
                </thead>
                <tbody>
                    @forelse($examGrades as $grade)
                    <tr>
                        <td class="fw-bold text-dark">{{ $grade->student->user->name ?? 'N/A' }}</td>
                        <td><span class="fw-semibold text-primary">{{ $grade->course->course_code ?? 'N/A' }}</span></td>
                        <td class="fw-bold text-secondary">{{ $grade->marks }}%</td>
                        <td class="text-center">
                            <span class="badge bg-primary rounded-pill px-4 py-2 fs-7 shadow-sm">
                                {{ $grade->grade }}
                            </span>
                        </td>
                        <!-- 🚀 Edit / Delete returns -->
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('admin.exam.grades.edit', $grade->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-semibold">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                
                                <form action="{{ route('admin.exam.grades.destroy', $grade->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this grading record?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-semibold">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-5">No grading records available yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $examGrades->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection