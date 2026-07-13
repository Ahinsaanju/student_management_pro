<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons (Sidebar එකේ icons වලට) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #212529;
            padding-top: 20px;
        }
        .sidebar a {
            padding: 12px 20px;
            text-decoration: none;
            font-size: 16px;
            color: #f8f9fa;
            display: block;
            transition: 0.3s;
        }
        .sidebar a:hover {
            background-color: #343a40;
            color: #0d6efd;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>
<body>

    <!-- Sidebar  -->
    <div class="sidebar">
        <div class="text-center text-white mb-4">
            <h4 class="fw-bold">SMS Admin</h4>
            <hr class="bg-light mx-3">
        </div>
        <a href="#"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
        <a href="#"><i class="bi bi-people me-2"></i> Students</a>
        <a href="#"><i class="bi bi-book me-2"></i> Courses</a>
        <a href="#"><i class="bi bi-calendar-check me-2"></i> Attendance</a>
        <a href="#"><i class="bi bi-mortarboard me-2"></i> Grades</a>
    </div>

    <!-- Main Content Dynamic Section -->
    <div class="main-content">
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm rounded mb-4">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1 fs-5 text-muted">Welcome Back, Admin!</span>
            </div>
        </nav>

       
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>