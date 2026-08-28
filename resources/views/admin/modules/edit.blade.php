@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4 shadow-sm border-0 rounded-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0">Edit Module</h5>
                    <a href="{{ route('admin.courses.modules.index', $module->course_id) }}" class="btn btn-outline-secondary btn-sm rounded-pill">
                        Cancel
                    </a>
                </div>

                <form action="{{ route('admin.modules.update', $module->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Module Code -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Module Code</label>
                        <input type="text" name="module_code" class="form-control" value="{{ old('module_code', $module->module_code) }}" required>
                    </div>

                    <!-- Module Name -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Module Name</label>
                        <input type="text" name="module_name" class="form-control" value="{{ old('module_name', $module->name ?? $module->module_name) }}" required>
                    </div>

                    <!-- Credits -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Credits</label>
                        <input type="number" name="credits" class="form-control" value="{{ old('credits', $module->credits) }}" required>
                    </div>

                    <!-- Assign Lecturer -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Assign Lecturer (Teacher)</label>
                        <select name="teacher_id" class="form-select">
                            <option value="">-- No Lecturer Assigned --</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ (old('teacher_id', $module->teacher_id) == $teacher->id) ? 'selected' : '' }}>
                                    {{ $teacher->user->name ?? 'Teacher #' . $teacher->id }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 fw-bold">Update Module</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection