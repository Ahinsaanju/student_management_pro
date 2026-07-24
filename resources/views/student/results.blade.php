<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Results - Studora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">

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
                                        <td class="fw-bold">{{ $result->subject->code ?? 'N/A' }}</td>
                                        <td>{{ $result->subject->name ?? 'N/A' }}</td>
                                        <td class="text-center fw-semibold">{{ $result->marks }}</td>
                                        <td class="text-center">
                                            <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                                                {{ $result->grade }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            @if($result->marks >= 40)
                                                <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">Pass</span>
                                            @else
                                                <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">Fail</span>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>