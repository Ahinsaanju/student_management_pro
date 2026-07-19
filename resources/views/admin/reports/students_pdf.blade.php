<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Studora - Students Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none; }
            body { padding: 20px; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-dark">Studora Platform Report</h2>
                <p class="text-muted">Generated Date: {{ date('Y-m-d H:i') }}</p>
            </div>
            <button class="btn btn-primary no-print" onclick="window.print()">Print / Save PDF</button>
        </div>

        <table class="table table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Student Name</th>
                    <th>Email</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr>
                    <td><strong>{{ $student->user->name ?? 'N/A' }}</strong></td>
                    <td>{{ $student->user->email ?? 'N/A' }}</td>
                    <td><span class="badge bg-success">{{ $student->status ?? 'Active' }}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>