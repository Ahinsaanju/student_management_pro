@extends('layouts.app')

@section('content')
<div class="container-fluid py-3">
    
    <!-- 🟢 Success Alert Message  -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">All Attendance Logs</h2>
            <p class="text-muted">View, edit and manage all historical student attendance records.</p>
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
                        <th>Date</th>
                        <th>Student Name</th>
                        <th>Module / Course</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th> <!-- 👈 මෙන්න අලුත් Column එක -->
                    </tr>
                </thead>
                <tbody>
                    @forelse($attendanceLogs as $log)
                    <tr>
                        <td class="fw-semibold text-secondary">{{ $log->date }}</td>
                        <td class="fw-bold text-dark">{{ $log->student->user->name ?? 'N/A' }}</td>
                        <td>
                            <span class="fw-semibold text-primary">{{ $log->course->course_code ?? 'N/A' }}</span>
                        </td>
                        <td class="text-center">
                            <span class="badge {{ $log->status == 'Present' ? 'bg-success' : 'bg-danger' }} bg-opacity-10 {{ $log->status == 'Present' ? 'text-success' : 'text-danger' }} rounded-pill px-4 py-2">
                                {{ $log->status }}
                            </span>
                        </td>
                        
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <!-- Edit button -->
                                <a href="{{ route('admin.attendance.edit', $log->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-semibold">
                                    <i class="bi bi-pencil-square me-1"></i> Edit
                                </a>
                                
                                <!-- Delete button (Confirm Popup ) -->
                                <form action="{{ route('admin.attendance.destroy', $log->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this attendance record?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-semibold">
                                        <i class="bi bi-trash me-1"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-5">No attendance logs found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $attendanceLogs->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection