@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <!-- Page Header -->
    <div class="mb-4">
        <h3 class="fw-bold mb-1">My Profile</h3>
        <p class="text-muted">Manage your account settings and profile information.</p>
    </div>

    <div class="row g-4">
        <!-- Left Column: Forms -->
        <div class="col-12 col-lg-8">
            <!-- Profile Info Form -->
            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-body p-4">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Password Form -->
            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-body p-4">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account Form -->
            <div class="card border-0 shadow-sm rounded-3 border-danger-subtle">
                <div class="card-body p-4">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>

        <!-- Right Column: User Quick Info -->
        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm rounded-3 text-center p-4">
                <div class="mb-3">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mx-auto" style="width: 80px; height: 80px; font-size: 32px;">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                </div>
                <h5 class="fw-bold mb-1">{{ auth()->user()->name }}</h5>
                <p class="text-muted small mb-2">{{ auth()->user()->email }}</p>
                <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill text-capitalize d-inline-block">
                    {{ auth()->user()->role ?? 'User' }} Account
                </span>
            </div>
        </div>
    </div>

</div>
@endsection