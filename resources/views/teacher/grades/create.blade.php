@extends('layouts.app')

@section('content')
<div class="container-fluid py-3">

    <!-- Success Message Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Error Message Alert -->
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Validation Errors Alert -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li><i class="bi bi-exclamation-circle me-1"></i>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 16px;">
        <h4 class="fw-bold text-dark mb-4"><i class="bi bi-file-earmark-spreadsheet text-primary me-2"></i>Submit Exam Marks</h4>
        
        <!-- Form Starts -->
        <form action="{{ route('teacher.grades.store') }}" method="POST">
            @csrf
            
            <!-- Module Selector -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-muted">Select Module</label>
                    <select id="module_select" name="module_id" class="form-select" required>
                        <option value="" selected disabled>Choose Module</option>
                        @foreach($modules as $module)
                            <option value="{{ $module->id }}" {{ old('module_id') == $module->id ? 'selected' : '' }}>
                                {{ $module->module_code }} - {{ $module->name ?? $module->module_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Student Marks Table Wrapper -->
            <div class="table-responsive mb-4">
                <table class="table table-hover align-middle">
                    <thead class="table-light text-muted">
                        <tr>
                            <th style="width: 60px;">#</th>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th style="width: 200px;">Marks (%)</th>
                        </tr>
                    </thead>
                    <tbody id="student_table_body">
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                <i class="bi bi-info-circle me-1"></i> Please select a module above to load registered students.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Submit Button -->
            <div class="text-end">
                <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 fw-bold shadow-sm">Submit Grades</button>
            </div>

        </form>
        <!-- Form Ends -->

    </div>
</div>

<script>
document.getElementById('module_select').addEventListener('change', function () {
    let moduleId = this.value;
    let studentTableBody = document.getElementById('student_table_body');

    if (!moduleId) return;

    // AJAX Request to fetch students by module ID
    fetch(`/teacher/get-students-by-course/${moduleId}`)
        .then(response => response.json())
        .then(data => {
            studentTableBody.innerHTML = '';

            if (data.length === 0) {
                studentTableBody.innerHTML = `<tr><td colspan="4" class="text-center text-muted py-3">No students found for this module.</td></tr>`;
                return;
            }

            data.forEach((student, index) => {
                let studentName = student.user ? student.user.name : (student.name || 'N/A');
                
                // Exact student_reg_no DB column value 
                let regNo = student.student_reg_no || student.reg_no || student.id;

                let row = `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${regNo}</td>
                        <td>${studentName}</td>
                        <td>
                            <input type="number" 
                                   name="marks[${student.id}]" 
                                   class="form-control form-control-sm" 
                                   placeholder="Enter Marks" 
                                   min="0" max="100" step="0.01">
                        </td>
                    </tr>
                `;
                studentTableBody.innerHTML += row;
            });
        })
        .catch(error => {
            console.error('Error fetching students:', error);
        });
});
</script>
@endsection