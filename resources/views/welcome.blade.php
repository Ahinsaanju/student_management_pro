<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - StuDora</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        body {
            background-color: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow: hidden; 
        }
        .text-blue-custom {
            color: #0d6efd; /* Premium Blue */
        }
        .hero-section {
            height: calc(100vh - 80px); 
            display: flex;
            align-items: center;
        }
        .btn-blue-custom {
            background-color: #0d6efd;
            color: #ffffff;
            padding: 14px 40px;
            font-size: 18px;
            font-weight: 600;
            border-radius: 8px;
            transition: 0.3s;
            border: none;
        }
        .btn-blue-custom:hover {
            background-color: #0b5ed7;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.4);
        }
        .hero-image {
            width: 100%;
            height: 78vh; 
            object-fit: cover; 
            object-position: center 22%; 
            border-radius: 28px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
        }
    </style>
</head>
<body>

    <!-- Header / Navbar  -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
        <div class="container-fluid px-5"> 
            <a class="navbar-brand fw-bold text-dark fs-4" href="#">
                <i class="bi bi-mortarboard-fill text-blue-custom me-2"></i>Stu<span class="text-blue-custom">Dora</span>
            </a>
        </div>
    </nav>

    <!-- Hero Section  -->
    <div class="container-fluid hero-section px-5">
        <div class="row align-items-center w-100 g-5">
            
            <!-- Left Side: Slogan, Description & Button -->
            <div class="col-lg-6 ps-lg-5 text-center text-lg-start">
                <h1 class="display-3 fw-extrabold text-dark mb-4" style="line-height: 1.2; font-weight: 800;">
                    Empowering Every <br><span class="text-blue-custom">Student Journey.</span>
                </h1>
                <p class="lead text-muted mb-5 fs-4" style="max-width: 600px;">
                    Studora is a modern student management system that simplifies student records, attendance, academic performance, course management, and communication efficiently.
                </p>
               
                <div class="d-grid d-sm-flex justify-content-sm-center justify-content-lg-start mt-4">
                    <a href="{{ route('dashboard') }}" class="btn btn-blue-custom shadow">
                        Get Started <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>

            <!-- Right Side: Student Image -->
            <div class="col-lg-6 pe-lg-5 text-center text-lg-end">
                <div class="position-relative d-inline-block w-100">
                    <img src="{{ asset('images/student.jpg') }}" alt="StuDora Student" class="hero-image">  
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>