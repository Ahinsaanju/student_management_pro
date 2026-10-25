@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold"><i class="bi bi-calendar-check text-primary me-2"></i>My Attendance History</h4>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted">
                        <tr>
                            <th class="ps-4">Date</th>
                            <th>Time</th>
                            <th>Module / Course</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($attendances as $attendance)
                            <tr>
                                <!-- Date formatting (yyyy-mm-dd) -->
                                <td class="ps-4 fw-semibold text-dark">
                                    {{ \Carbon\Carbon::parse($attendance->date)->format('Y-m-d') }}
                                </td>

                                <!-- Marked Time (Sri Lanka Timezone: Asia/Colombo) -->
                                <td>
                                    <span class="badge bg-light text-secondary border px-2 py-1">
                                        <i class="bi bi-clock me-1 text-primary"></i>
                                        @if($attendance->created_at)
                                            {{ \Carbon\Carbon::parse($attendance->created_at)->timezone('Asia/Colombo')->format('h:i A') }}
                                        @else
                                            N/A
                                        @endif
                                    </span>
                                </td>

                                <!-- Module Name & Code (Fallback to Course Name if Module is null) -->
                                <td>
                                    @if($attendance->module)
                                        <span class="fw-bold text-primary">
                                            {{ $attendance->module->module_code ?? '' }}
                                        </span>
                                        - {{ $attendance->module->name ?? $attendance->module->module_name }}
                                    @elseif($attendance->course)
                                        <span class="fw-bold text-secondary">
                                            {{ $attendance->course->course_code ?? '' }}
                                        </span>
                                        - {{ $attendance->course->course_name ?? $attendance->course->name }}
                                    @else
                                        <span class="text-muted">General Attendance</span>
                                    @endif
                                </td>

                                <!-- Status Badge -->
                                <td>
                                    @if(strtolower($attendance->status) == 'present')
                                        <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill border border-success-subtle">Present</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill border border-danger-subtle">Absent</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">
                                    <i class="bi bi-calendar-x me-1"></i> No attendance records found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection