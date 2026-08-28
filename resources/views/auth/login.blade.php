<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - StuDora</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body, html {
            height: 100%;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: #f8fafc;
        }
        .login-card {
            border: none;
            border-radius: 1.25rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);
            background-color: #ffffff;
            padding: 2.5rem;
            max-width: 440px;
            width: 100%;
        }
        .login-brand {
            font-weight: 800;
            color: #0d6efd;
            letter-spacing: -0.5px;
        }
        
        /* Interactive Button Glow */
        .btn-primary-custom {
            background-color: #0d6efd;
            border: none;
            padding: 0.8rem 1.5rem;
            font-weight: 600;
            border-radius: 0.75rem;
            transition: all 0.25 ease-in-out;
        }
        .btn-primary-custom:hover {
            background-color: #0b5ed7;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(13, 110, 253, 0.3);
        }
        .btn-primary-custom:active {
            transform: translateY(0);
        }
        
        /* Focus Outline Fix */
        .input-group {
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            background-color: #f8fafc;
            transition: all 0.2s ease-in-out;
            overflow: hidden;
        }
        .input-group:focus-within {
            border-color: #0d6efd;
            background-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.15);
        }
        .input-group-text {
            border: none;
            background-color: transparent;
            padding-left: 1rem;
        }
        .form-control-custom {
            border: none;
            background-color: transparent;
            padding: 0.75rem 1rem 0.75rem 0.5rem;
            box-shadow: none !important;
        }
        .form-control-custom:focus {
            background-color: transparent;
        }

        /* Checkbox Accent Styling */
        .form-check-input:checked {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
        .form-check-input:focus {
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.2);
            border-color: #0d6efd;
        }
        
        /* Eye Icon Cursor */
        .toggle-password {
            cursor: pointer;
            user-select: none;
        }
    </style>
</head>
<body class="d-flex flex-column justify-content-between min-vh-100 py-4">

<!-- Main Content Centered -->
<div class="my-auto d-flex justify-content-center align-items-center px-3">
    <div class="card login-card">
        
        <!-- StuDora Logo Header -->
        <div class="text-center mb-4">
            <a href="/" class="text-decoration-none d-inline-flex align-items-center">
                <i class="bi bi-mortarboard-fill fs-2 text-primary me-2"></i>
                <span class="fs-3 login-brand">Stu<span class="text-dark">Dora</span></span>
            </a>
            <h4 class="fw-bold text-dark mt-3 mb-1">Welcome Back! 👋</h4>
            <p class="text-muted small mb-0">Enter your credentials to access your account.</p>
        </div>

        <!-- Breeze Session Status -->
        <x-auth-session-status class="mb-3" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-3">
                <label for="email" class="form-label text-dark fw-semibold small">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text text-muted">
                        <i class="bi bi-envelope"></i>
                    </span>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                           class="form-control form-control-custom @error('email') is-invalid @enderror" 
                           placeholder="name@example.com">
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-1 small text-danger list-unstyled" />
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label text-dark fw-semibold small mb-1">Password</label>
                <div class="input-group">
                    <span class="input-group-text text-muted">
                        <i class="bi bi-lock"></i>
                    </span>
                    <input id="password" type="password" name="password" required autocomplete="current-password" 
                           class="form-control form-control-custom @error('password') is-invalid @enderror" 
                           placeholder="••••••••">
                    <span class="input-group-text text-muted toggle-password" onclick="togglePasswordVisibility()">
                        <i class="bi bi-eye" id="toggleIcon"></i>
                    </span>
                </div>
                
                <!-- Forgot Password -->
                @if (Route::has('password.request'))
                    <div class="text-end mt-1">
                        <a href="{{ route('password.request') }}" class="text-primary text-decoration-none small fw-semibold">Forgot password?</a>
                    </div>
                @endif
                <x-input-error :messages="$errors->get('password')" class="mt-1 small text-danger list-unstyled" />
            </div>

            <!-- Remember Me -->
            <div class="form-check mb-4">
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                <label for="remember_me" class="form-check-label small text-muted">Remember me on this device</label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary-custom text-white w-100 d-flex align-items-center justify-content-center">
                <span>Sign In</span>
                <i class="bi bi-arrow-right-short fs-4 ms-1"></i>
            </button>
        </form>

    </div>
</div>

<!-- Footer -->
<div class="text-center">
    <small class="text-muted">© 2026 StuDora Management System. All rights reserved.</small>
</div>

<!-- Password Toggle Script -->
<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('bi-eye');
            toggleIcon.classList.add('bi-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('bi-eye-slash');
            toggleIcon.classList.add('bi-eye');
        }
    }
</script>

</body>
</html>