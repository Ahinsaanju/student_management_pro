<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Studora') }}</title>
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
            z-index: 1000;
            overflow-y: auto;
        }
        .sidebar a {
            padding: 12px 20px;
            text-decoration: none;
            font-size: 16px;
            color: #f8f9fa;
            display: block;
            transition: 0.3s;
            border-radius: 0 50px 50px 0; 
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
<body class="bg-light">

    <!-- Sidebar  -->
    <div class="sidebar">
        <div class="text-center text-white mb-4">
            <h4 class="fw-bold"><i class="bi bi-mortarboard-fill text-primary me-2"></i>StuDora</h4>
            <hr class="bg-light mx-3">
        </div>
        
        <div class="nav flex-column mb-4">

            <!-- ================= ADMIN MENU ================= -->
            @if(auth()->user()->role === 'admin' || request()->is('dashboard') || request()->is('admin/*'))
                <div class="menu-label">Admin Portal</div>
                
                <a href="{{ url('/dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
                <a href="{{ route('admin.students.index') }}" class="{{ request()->is('admin/students*') ? 'active' : '' }}">
                    <i class="bi bi-people me-2"></i> Manage Students
                </a>
                <a href="{{ route('admin.teachers.index') }}" class="{{ request()->is('admin/teachers*') ? 'active' : '' }}">
                    <i class="bi bi-person-workspace me-2"></i> Manage Teachers
                </a>
                <a href="{{ route('admin.courses.index') }}" class="{{ request()->is('admin/courses*') ? 'active' : '' }}">
                    <i class="bi bi-book me-2"></i> Manage Courses
                </a>
                <a href="{{ route('admin.attendance.logs') }}" class="{{ request()->routeIs('admin.attendance.logs') ? 'active' : '' }}">
                    <i class="bi bi-calendar-check me-2"></i> Attendance Logs
                </a>
                <a href="{{ route('admin.exam.grades') }}" class="{{ request()->routeIs('admin.exam.grades') ? 'active' : '' }}">
                    <i class="bi bi-mortarboard me-2"></i> Exam Grades
                </a>
            @endif

            <!-- ================= STUDENT MENU ================= -->
            @if(auth()->user()->role === 'student' || request()->is('student/*'))
                <div class="menu-label">Student Portal</div>
                
                <a href="{{ url('/student/dashboard') }}" class="{{ request()->is('student/dashboard') ? 'active' : '' }}">
                    <i class="bi bi-house-door me-2"></i> Student Home
                </a>
                <a href="{{ route('student.attendance') }}" class="{{ request()->routeIs('student.attendance') ? 'active' : '' }}">
                    <i class="bi bi-calendar-check me-2"></i> My Attendance
                </a>
                <!-- 🎯 Fixed Course Modules Route -->
                <a href="{{ route('student.modules') }}" class="{{ request()->routeIs('student.modules') ? 'active' : '' }}">
                    <i class="bi bi-journal-text me-2"></i> Course Modules
                </a>
                <a href="{{ route('student.results') }}" class="{{ request()->routeIs('student.results') ? 'active' : '' }}">
                    <i class="bi bi-journal-check me-2"></i> Exam Results
                </a>
                <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                    <i class="bi bi-person me-2"></i> My Profile
                </a>
            @endif

            <!-- ================= TEACHER MENU ================= -->
            @if(auth()->user()->role === 'teacher' || request()->is('teacher/*'))
                <div class="menu-label">Teacher Portal</div>
                
                <a href="{{ url('/teacher/dashboard') }}" class="{{ request()->is('teacher/dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2 me-2"></i> Teacher Dashboard
                </a>
                <a href="{{ route('teacher.modules.index') }}" class="{{ request()->is('teacher/modules*') ? 'active' : '' }}">
                    <i class="bi bi-journal-check me-2"></i> My Modules
                </a>
                <a href="{{ route('teacher.attendance.create') }}" class="{{ request()->is('teacher/attendance*') ? 'active' : '' }}">
                    <i class="bi bi-calendar-check me-2"></i> Mark Attendance
                </a>
                <a href="{{ route('teacher.grades.create') }}" class="{{ request()->is('teacher/grades*') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-spreadsheet me-2"></i> Submit Grades
                </a>
                <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                    <i class="bi bi-person-bounding-box me-2"></i> My Profile
                </a>
            @endif
            
            <!-- පොදු Navigation  -->
            <hr class="bg-light mx-3 mt-4">

            <!-- 1. Goto web site Home page -->
            <a href="{{ url('/') }}" class="text-white-50 nav-link mx-3 mb-2 d-flex align-items-center">
                <i class="bi bi-house me-2"></i> 
                <span>Exit Portal</span>
            </a>

            <!-- 2. System Log out  -->
            <a href="#" class="text-danger nav-link mx-3 d-flex align-items-center" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-left me-2"></i> 
                <span>Logout</span>
            </a>

            <!-- Background Hidden Form -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

        </div>
    </div>

    <!-- Main Content Dynamic Section -->
    <div class="main-content">
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm rounded mb-4 px-3">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                
                <span class="navbar-brand mb-0 h1 fs-5 text-muted fw-semibold">
                    @if(auth()->user()->role === 'student' || request()->is('student/*'))
                        Student Management Portal
                    @elseif(auth()->user()->role === 'teacher' || request()->is('teacher/*'))
                        Teacher Management Portal
                    @else
                        System Administrator Portal
                    @endif
                </span>

                <!-- Dynamic Logged User Name -->
                <div class="fw-bold text-primary">
                    <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                </div>

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