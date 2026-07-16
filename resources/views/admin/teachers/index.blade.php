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
        <!-- 📝 Add New Teacher Form -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 16px;">
                <h5 class="fw-bold text-dark mb-4"><i class="bi bi-person-fill-add text-primary me-2"></i>Add New Teacher</h5>
                
                <form action="{{ route('admin.teachers.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted">Teacher Code</label>
                        <input type="text" name="teacher_code" class="form-control" placeholder="e.g. TCH-1001" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted">Full Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Dr. Sunil Perera" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted">Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="e.g. sunil@example.com" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted">Department</label>
                        <select name="department" class="form-select" required>
                            <option value="" selected disabled>Select Department</option>
                            <option value="Information Technology">Information Technology</option>
                            <option value="Software Engineering">Software Engineering</option>
                            <option value="Computer Science">Computer Science</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted">Designation</label>
                        <input type="text" name="designation" class="form-control" placeholder="e.g. Senior Lecturer" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted">Phone Number</label>
                        <input type="text" name="phone" class="form-control" placeholder="e.g. 0771234567">
                    </div>
                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-bold mt-2">Register Teacher</button>
                </form>
            </div>
        </div>

        <!-- 📋 Registered Teachers Table -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 16px;">
                <h5 class="fw-bold text-dark mb-4"><i class="bi bi-person-workspace text-primary me-2"></i>Faculty Members</h5>
                
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-muted fs-7">
                            <tr>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Department</th>
                                <th>Designation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($teachers as $teacher)
                            <tr>
                                <td class="fw-semibold text-primary">#{{ $teacher->teacher_code }}</td>
                                <td>{{ $teacher->user->name ?? 'N/A' }}</td>
                                <td>{{ $teacher->user->email ?? 'N/A' }}</td>
                                <td>{{ $teacher->department }}</td>
                                <td><span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3">{{ $teacher->designation }}</span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">No teachers registered yet.</td>
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