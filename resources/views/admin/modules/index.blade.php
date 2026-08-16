@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Manage Course Modules</h4>
            <p class="text-muted small mb-0">Course: {{ $course->course_name ?? $course->name ?? 'Course' }}</p>
        </div>
        <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            Back to Courses
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row g-4">
        <!-- Add Form -->
        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <h5 class="fw-bold mb-3">Add New Module</h5>
                <form action="{{ route('admin.courses.modules.store', $course->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Module Code</label>
                        <input type="text" name="module_code" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Module Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Credits</label>
                        <input type="number" name="credits" class="form-control" value="3" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Add Module</button>
                </form>
            </div>
        </div>

        <!-- Modules Table -->
        <div class="col-md-8">
            <div class="card p-3 shadow-sm">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Credits</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($modules) && count($modules) > 0)
                            @foreach($modules as $module)
                                <tr>
                                    <td>{{ $module->module_code }}</td>
                                    <td>{{ $module->name }}</td>
                                    <td>{{ $module->credits }}</td>
                                    <td class="text-end">
                                        <form action="{{ route('admin.modules.destroy', $module->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center py-3 text-muted">No modules found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection