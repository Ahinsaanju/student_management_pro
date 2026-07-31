<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Studora - Students Report</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 13px;
            color: #333;
            margin: 0;
            padding: 10px;
        }
        .header-table {
            width: 100%;
            margin-bottom: 25px;
            border-bottom: 2px solid #4A00E0;
            padding-bottom: 10px;
        }
        .title {
            font-size: 22px;
            font-weight: bold;
            color: #1a1a1a;
            margin: 0;
        }
        .date {
            font-size: 11px;
            color: #666;
            margin-top: 4px;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .data-table th, .data-table td {
            border: 1px solid #e0e0e0;
            padding: 10px;
            text-align: left;
        }
        .data-table th {
            background-color: #212529;
            color: #ffffff;
            font-weight: bold;
            font-size: 12px;
            text-transform: uppercase;
        }
        .data-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .badge {
            display: inline-block;
            padding: 4px 8px;
            font-size: 11px;
            font-weight: bold;
            color: #155724;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
        }
    </style>
</head>
<body>

    <!-- Header Area -->
    <table class="header-table">
        <tr>
            <td>
                <div class="title">Studora Platform Report</div>
                <div class="date">Generated Date: {{ date('Y-m-d H:i') }}</div>
            </td>
        </tr>
    </table>

    <!-- Data Table -->
    <table class="data-table">
        <thead>
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
                <td>
                    <span class="badge">{{ $student->status ?? 'Active' }}</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>