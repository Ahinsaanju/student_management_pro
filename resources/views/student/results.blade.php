@extends('layouts.app')

@section('content')
<div class="container-fluid py-3">
    <div class="row justify-content-center">
        <div class="col-md-11">

            <!-- Page Title Card -->
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="fw-bold mb-1"><i class="bi bi-journal-check text-primary me-2"></i> Examination Results</h4>
                        <p class="text-muted mb-0 fs-7">View your academic performance and grades</p>
                    </div>
                    <div>
                        <button onclick="window.print()" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                            <i class="bi bi-printer me-1"></i> Print Sheet
                        </button>
                    </div>
                </div>
            </div>

            <!-- Results Table Card -->
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="py-3">Subject Code</th>
                                <th scope="col" class="py-3">Subject Name</th>
                                <th scope="col" class="py-3 text-center">Marks</th>
                                <th scope="col" class="py-3 text-center">Grade</th>
                                <th scope="col" class="py-3 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($student) && $student->results && $student->results->count() > 0)
                                @foreach($student->results as $result)
                                    <tr>
                                        <!-- 📘 Dynamic Subject/Module Code Fallbacks -->
                                        <td class="fw-bold text-primary">
                                            {{ $result->course->course_code ?? $result->module->module_code ?? $result->module->code ?? $result->subject->code ?? $result->subject_code ?? 'N/A' }}
                                        </td>
                                        
                                        <!-- 📚 Dynamic Subject/Module Name Fallbacks -->
                                        <td class="fw-semibold text-dark">
                                            {{ $result->course->course_name ?? $result->module->module_name ?? $result->module->name ?? $result->subject->name ?? $result->subject_name ?? 'N/A' }}
                                        </td>
                                        
                                        <td class="text-center fw-semibold">{{ number_format($result->marks, 2) }}</td>
                                        
                                        <td class="text-center">
                                            <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-bold">
                                                {{ $result->grade }}
                                            </span>
                                        </td>
                                        
                                        <td class="text-center">
                                            @if($result->marks >= 40)
                                                <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-semibold">Pass</span>
                                            @else
                                                <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill fw-semibold">Fail</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                        No exam results released yet.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection