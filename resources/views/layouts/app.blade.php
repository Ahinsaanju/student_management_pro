<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
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
            border-radius: 0 50px 50px 0; /* Active වෙද්දි ලස්සනක් එන්න */
            margin-right: 15px;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #0d6efd;
            color: #ffffff !important;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        .menu-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #6c757d;
            padding: 10px 20px 5px 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <!-- Sidebar  -->
    <div class="sidebar">
        <div class="text-center text-white mb-4">
            
            <h4 class="fw-bold"><i class="bi bi-mortarboard-fill text-primary me-2"></i>StuDora</h4>
            <hr class="bg-light mx-3">
        </div>
        
        <div class="nav flex-column">

            <!-- ================= ADMIN MENU ================= -->
            
            @if(request()->is('dashboard') || request()->is('admin/*'))
                <div class="menu-label">Admin Portal</div>
                
                <a href="{{ url('/dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
                <a href="{{ route('admin.students.index') }}" class="{{ request()->is('admin/students') ? 'active' : '' }}">
                    <i class="bi bi-people me-2"></i> Manage Students
                </a>
                <a href="{{ route('admin.courses.index') }}" class="{{ request()->is('admin/courses') ? 'active' : '' }}">
                    <i class="bi bi-book me-2"></i> Manage Courses
                </a>
                <a href="#">
                    <i class="bi bi-calendar-check me-2"></i> Attendance Logs
                </a>
                <a href="#">
                    <i class="bi bi-mortarboard me-2"></i> Exam Grades
                </a>
            @endif

            <!-- ================= STUDENT MENU ================= -->
           
            @if(request()->is('student/*'))
                <div class="menu-label">Student Portal</div>
                
                <a href="{{ url('/student/dashboard') }}" class="{{ request()->is('student/dashboard') ? 'active' : '' }}">
                    <i class="bi bi-house-door me-2"></i> Student Home
                </a>
                <a href="#">
                    <i class="bi bi-calendar2-check me-2"></i> My Attendance
                </a>
                <a href="#">
                    <i class="bi bi-journal-text me-2"></i> Course Modules
                </a>
                <a href="#">
                    <i class="bi bi-award me-2"></i> Exam Results
                </a>
                <a href="#">
                    <i class="bi bi-person-circle me-2"></i> My Profile
                </a>
            @endif
            
            <!-- පොදු Navigation  -->
            <hr class="bg-light mx-3 mt-4">
            <a href="{{ url('/') }}" class="text-muted"><i class="bi bi-box-arrow-left me-2"></i> Exit Portal</a>

        </div>
    </div>

    <!-- Main Content Dynamic Section -->
    <div class="main-content">
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm rounded mb-4">
            <div class="container-fluid">
                
                <span class="navbar-brand mb-0 h1 fs-5 text-muted fw-semibold">
                    @if(request()->is('student/*'))
                        Student Management Portal
                    @else
                        System Administrator Portal
                    @endif
                </span>
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