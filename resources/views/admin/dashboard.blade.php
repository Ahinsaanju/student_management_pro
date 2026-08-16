@extends('layouts.app')

@section('content')
<div class="container-fluid py-2">

    <!-- Welcome Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">System Administrator Dashboard</h2>
            <p class="text-muted mb-0">Overview of Studora platform statistics, logs, and analytics.</p>
        </div>
        <!-- 📥 Export Buttons Group -->
        <div class="d-flex gap-2">
            <a href="{{ route('admin.export.students.csv') }}" class="btn btn-sm btn-white border shadow-sm rounded-pill px-3 fw-semibold bg-white text-dark">
                <i class="bi bi-file-earmark-excel text-success me-1"></i> Export Excel
            </a>
            <a href="{{ route('admin.export.students.pdf') }}" target="_blank" class="btn btn-sm btn-white border shadow-sm rounded-pill px-3 fw-semibold bg-white text-dark">
                <i class="bi bi-file-earmark-pdf text-danger me-1"></i> Export PDF
            </a>
        </div>
    </div>

    <!-- 🔍 Advanced Global Search & Smart Filters Section -->
    <div class="card border-0 shadow-sm p-3 bg-white mb-4" style="border-radius: 16px;">
        <form action="{{ route('admin.dashboard') }}" method="GET" class="row g-3 align-items-center">
            <!-- Live Global Search -->
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text bg-light border-0 text-muted"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control bg-light border-0" placeholder="Search by Student Name or Module Code...">
                </div>
            </div>
            
            <!-- Smart Filter Dropdown -->
            <div class="col-md-4">
                <select name="status" class="form-select bg-light border-0 text-muted">
                    <option value="">Filter Attendance Status (All)</option>
                    <option value="Present" {{ request('status') == 'Present' ? 'selected' : '' }}>Present</option>
                    <option value="Absent" {{ request('status') == 'Absent' ? 'selected' : '' }}>Absent</option>
                </select>
            </div>

            <!-- Action Buttons -->
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100 rounded-pill fw-semibold">Filter</button>
                @if(request('search') || request('status'))
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-light rounded-pill"><i class="bi bi-x-circle text-danger"></i></a>
                @endif
            </div>
        </form>
    </div>

    <!-- Stats Overview Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3 bg-white" style="border-radius: 16px;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted fw-semibold mb-2">Total Students</h6>
                        <h3 class="fw-bold text-dark mb-0">{{ $totalStudents }}</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded-4"><i class="bi bi-people-fill text-primary fs-3"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3 bg-white" style="border-radius: 16px;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted fw-semibold mb-2">Total Lecturers</h6>
                        <h3 class="fw-bold text-dark mb-0">{{ $totalTeachers }}</h3>
                    </div>
                    <div class="bg-warning bg-opacity-10 p-3 rounded-4"><i class="bi bi-person-workspace text-warning fs-3"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3 bg-white" style="border-radius: 16px;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted fw-semibold mb-2">Active Modules</h6>
                        <h3 class="fw-bold text-dark mb-0">{{ $totalCourses }}</h3>
                    </div>
                    <div class="bg-success bg-opacity-10 p-3 rounded-4"><i class="bi bi-book text-success fs-3"></i></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Attendance Logs & Exam Grades Section -->
    <div class="row g-4 mb-4">
        
        <!-- 📅 Attendance Logs Table -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 16px;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold text-dark mb-0"><i class="bi bi-calendar-check text-danger me-2"></i>Recent Attendance Logs</h5>
                    <a href="{{ route('admin.attendance.logs') }}" class="btn btn-sm btn-light rounded-pill px-3 fw-semibold shadow-sm">
                        View All <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-muted fs-7">
                            <tr>
                                <th>Student</th>
                                <th>Module</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($attendanceLogs as $log)
                            <tr>
                                <td class="fw-semibold">{{ $log->student->user->name ?? 'N/A' }}</td>
                                <td>{{ $log->course->course_code ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge {{ $log->status == 'Present' ? 'bg-success' : 'bg-danger' }} bg-opacity-10 {{ $log->status == 'Present' ? 'text-success' : 'text-danger' }} rounded-pill px-3">
                                        {{ $log->status }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">No recent attendance records found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- 📝 Exam Grades Table -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 16px;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold text-dark mb-0"><i class="bi bi-file-earmark-spreadsheet text-success me-2"></i>Recent Exam Grades</h5>
                    <a href="{{ route('admin.exam.grades') }}" class="btn btn-sm btn-light rounded-pill px-3 fw-semibold shadow-sm">
                        View All <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-muted fs-7">
                            <tr>
                                <th>Student</th>
                                <th>Module</th>
                                <th>Marks</th>
                                <th>Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($examGrades as $grade)
                            <tr>
                                <td class="fw-semibold">{{ $grade->student->user->name ?? 'N/A' }}</td>
                                <td>{{ $grade->subject_code ?? $grade->subject_name ?? 'N/A' }}</td>
                                <td>{{ $grade->marks }}%</td>
                                <td><span class="badge bg-primary rounded-pill px-3">{{ $grade->grade }}</span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">No grading records available yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- 📊 Advanced Analytics Charts Section  -->
    <div class="row g-4 mb-2">
        <!-- Attendance Trend Line Chart -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 16px;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold text-dark mb-0"><i class="bi bi-graph-up-arrow text-primary me-2"></i>Attendance Trends</h5>
                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1">Last 7 Days</span>
                </div>
                <div style="height: 280px; position: relative;">
                    <canvas id="attendanceChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Grade Distribution Bar Chart -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 16px;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold text-dark mb-0"><i class="bi bi-bar-chart-line-fill text-success me-2"></i>Grade Distribution</h5>
                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1">Overall Performance</span>
                </div>
                <div style="height: 280px; position: relative;">
                    <canvas id="gradeChart"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- 📊 Data Container for Safe Pass  -->
<div id="analytics-data"
     data-attendance-labels='{!! json_encode($attendanceLabels ?? ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"]) !!}'
     data-attendance-values='{!! json_encode($attendanceData ?? [0, 0, 0, 0, 0, 0, 0]) !!}'>
</div>

<!-- 🚀 Chart.js Setup Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const dataContainer = document.getElementById('analytics-data');
        const attendanceLabels = JSON.parse(dataContainer.getAttribute('data-attendance-labels'));
        const attendanceData = JSON.parse(dataContainer.getAttribute('data-attendance-values'));

        // 1. Attendance Line Chart
        const ctxAttendance = document.getElementById('attendanceChart').getContext('2d');
        new Chart(ctxAttendance, {
            type: 'line',
            data: {
                labels: attendanceLabels,
                datasets: [{
                    label: 'Present Students',
                    data: attendanceData,
                    borderColor: '#0d6efd',
                    backgroundColor: 'rgba(13, 110, 253, 0.08)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 3,
                    pointBackgroundColor: '#0d6efd'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.04)' } },
                    x: { grid: { display: false } }
                }
            }
        });

        // 2. Grade Bar Chart
        const ctxGrade = document.getElementById('gradeChart').getContext('2d');
        new Chart(ctxGrade, {
            type: 'bar',
            data: {
                labels: ['A (75+)', 'B (65-74)', 'C (50-64)', 'F (<40)'],
                datasets: [{
                    data: [
                        parseInt("{{ $gradesDist['A'] ?? 0 }}"),
                        parseInt("{{ $gradesDist['B'] ?? 0 }}"),
                        parseInt("{{ $gradesDist['C'] ?? 0 }}"),
                        parseInt("{{ $gradesDist['F'] ?? 0 }}")
                    ],
                    backgroundColor: ['#198754', '#0dcaf0', '#ffc107', '#dc3545'],
                    borderRadius: 8,
                    barThickness: 25
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.04)' } },
                    x: { grid: { display: false } }
                }
            }
        });
    });
</script>
@endsection