@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0">Learning Materials</h3>
            <p class="text-muted fs-7 mb-0">Filter and manage materials by Academic Department & Course.</p>
        </div>
        <button class="btn btn-primary rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#uploadMaterialModal">
            <i class="bi bi-cloud-upload me-1"></i> Upload Material
        </button>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm" role="alert">
            <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- 🏢 Department / Course Filter Bar -->
    <div class="card border-0 shadow-sm p-3 mb-4 rounded-4 bg-white">
        <form action="{{ route('admin.materials.index') }}" method="GET" class="row g-2 align-items-center">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-light border-0"><i class="bi bi-building"></i></span>
                    <select name="course_id" class="form-select border-0 bg-light fw-semibold" onchange="this.form.submit()">
                        <option value="">All Departments / Courses</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                                {{ $course->course_name }} ({{ $course->course_code }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            @if(request('course_id'))
                <div class="col-md-2">
                    <a href="{{ route('admin.materials.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
                        <i class="bi bi-x-circle me-1"></i> Clear Filter
                    </a>
                </div>
            @endif
        </form>
    </div>

    <!-- 📚 Modules & Materials Cards Grid -->
    <div class="row g-4">
        @forelse($modules as $module)
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    
                    <!-- Card Header with Department / Module Info -->
                    <div class="card-header bg-white p-3 border-0 d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-primary bg-opacity-10 text-primary fw-bold font-monospace px-3 py-2 fs-7 rounded-3">
                                {{ $module->module_code ?? 'MOD' }}
                            </span>
                            <div>
                                <h6 class="fw-bold mb-0">{{ $module->module_name ?? $module->name }}</h6>
                                <small class="text-muted fs-8"><i class="bi bi-mortarboard me-1"></i>{{ $module->course->course_name ?? 'General Department' }}</small>
                            </div>
                        </div>
                        <span class="badge bg-dark bg-opacity-10 text-dark rounded-pill px-3 py-1 fs-8">
                            {{ $module->learningMaterials->count() }} Items Available
                        </span>
                    </div>

                    <!-- Materials Table -->
                    <div class="card-body p-0 border-top border-light">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light fs-8 text-uppercase text-muted">
                                    <tr>
                                        <th class="ps-4">Resource Title</th>
                                        <th>Type</th>
                                        <th>Uploaded Date</th>
                                        <th class="text-end pe-4">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($module->learningMaterials as $material)
                                        <tr>
                                            <td class="ps-4 font-weight-bold">
                                                <i class="bi bi-file-earmark-text text-primary me-2"></i>{{ $material->title }}
                                            </td>
                                            <td>
                                                @if($material->type === 'file')
                                                    <span class="badge bg-danger bg-opacity-10 text-danger px-2 py-1"><i class="bi bi-file-pdf me-1"></i> PDF/File</span>
                                                @else
                                                    <span class="badge bg-info bg-opacity-10 text-info px-2 py-1"><i class="bi bi-link-45deg me-1"></i> External Link</span>
                                                @endif
                                            </td>
                                            <td class="text-muted fs-8">{{ $material->created_at->format('d M Y, h:i A') }}</td>
                                            <td class="text-end pe-4">
                                                @if($material->type === 'file')
                                                    <a href="{{ asset('storage/' . $material->file_path) }}" download class="btn btn-sm btn-outline-success rounded-pill px-3 me-1">
                                                        <i class="bi bi-download"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ $material->external_url }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3 me-1">
                                                        <i class="bi bi-box-arrow-up-right"></i>
                                                    </a>
                                                @endif
                                            
                                                <form action="{{ route('admin.materials.destroy', $material->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete material?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-3 fs-8">No materials added for this module yet.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-folder-x fs-1 text-muted d-block mb-2"></i>
                <p class="text-muted mb-0">No modules or materials found for this Department/Course.</p>
            </div>
        @endforelse
    </div>

</div>

<!-- 📤 Upload Material Modal -->
<div class="modal fade" id="uploadMaterialModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="fw-bold modal-title">Upload Learning Material</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.materials.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold fs-8">Select Module</label>
                        <select name="module_id" class="form-select" required>
                            <option value="">-- Choose Module --</option>
                            @foreach($modules as $module)
                                <option value="{{ $module->id }}">{{ $module->module_code }} - {{ $module->module_name ?? $module->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold fs-8">Material Title</label>
                        <input type="text" name="title" class="form-control" placeholder="e.g. Lecture 01 - System Architecture" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold fs-8">Material Type</label>
                        <select name="type" id="modalMaterialType" class="form-select" onchange="toggleModalInput()">
                            <option value="file">File Upload (PDF, PPT, DOC, ZIP)</option>
                            <option value="link">External URL (Google Drive / YouTube)</option>
                        </select>
                    </div>

                    <div class="mb-3" id="modalFileBlock">
                        <label class="form-label fw-bold fs-8">Choose File</label>
                        <input type="file" name="file" class="form-control">
                    </div>

                    <div class="mb-3 d-none" id="modalLinkBlock">
                        <label class="form-label fw-bold fs-8">External Resource URL</label>
                        <input type="url" name="external_url" class="form-control" placeholder="https://drive.google.com/...">
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function toggleModalInput() {
    let type = document.getElementById('modalMaterialType').value;
    if (type === 'file') {
        document.getElementById('modalFileBlock').classList.remove('d-none');
        document.getElementById('modalLinkBlock').classList.add('d-none');
    } else {
        document.getElementById('modalFileBlock').classList.add('d-none');
        document.getElementById('modalLinkBlock').classList.remove('d-none');
    }
}
</script>
@endsection