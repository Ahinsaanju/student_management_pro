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
        <!-- 📝 Add New Student Form -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 16px;">
                <h5 class="fw-bold text-dark mb-4"><i class="bi bi-person-plus-fill text-primary me-2"></i>Add New Student</h5>
                
                <form action="{{ route('admin.students.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted">Student ID</label>
                        <input type="text" name="student_id" class="form-control" placeholder="e.g. STD-2061" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted">Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="e.g. kasun@example.com" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted">Course / Degree</label>
                        <select name="course" class="form-select" required>
                            <option value="" selected disabled>Select Course</option>
                            <option value="BICT (Hons)">BICT (Hons)</option>
                            <option value="Software Engineering">Software Engineering</option>
                            <option value="Data Science">Data Science</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" name="dob" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-select" required>
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-bold mt-2">Register Student</button>
                </form>
            </div>
        </div>

        <!-- 📋 Registered Students Table -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 16px;">
                <h5 class="fw-bold text-dark mb-4"><i class="bi bi-people-fill text-primary me-2"></i>Registered Students</h5>
                
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-muted fs-7">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Course</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($students as $student)
                            <tr>
                                <td class="fw-semibold">#{{ $student->student_reg_no }}</td>
                                <td>{{ $student->first_name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->course }}</td>
                                <td><span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">{{ $student->status }}</span></td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('admin.students.edit', $student->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this student?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">No students registered yet.</td>
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