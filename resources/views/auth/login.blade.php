<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studora - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light d-flex align-items-center justify-content-center min-vh-100">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-lg p-4 bg-white" style="border-radius: 20px;">
                <div class="text-center mb-4">
                    <h3 class="fw-bold text-primary mb-1">Studora</h3>
                    <p class="text-muted fs-7">Academic Management System Login</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger border-0 rounded-3 mb-3 py-2 fs-7">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold fs-7">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="email" class="form-control bg-light border-0" placeholder="user@studora.com" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-muted fw-semibold fs-7">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="bi bi-lock"></i></span>
                            <input type="password" name="password" class="form-control bg-light border-0" placeholder="••••••••" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-semibold">Sign In</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>