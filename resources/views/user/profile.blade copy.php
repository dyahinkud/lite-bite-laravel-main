@extends('layouts.user')

@section('title', 'Profile Settings')
@section('page_title', 'Profile Settings')

@section('content')
<div class="mb-4">
    <h3 class="fw-bold" style="color: var(--litebite-primary);">Profile Settings</h3>
    <p class="text-muted">Update your account information and password.</p>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 shadow-sm" role="alert">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <h5 class="fw-bold mb-3" style="color: var(--litebite-primary);">Account Information</h5>

            <div class="mb-4">
                <label class="form-label fw-semibold text-muted">Profile Photo</label>
                <div class="d-flex align-items-center mb-2">
                    <img src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : asset('assets/images/user-default.png') }}" alt="Profile Photo" class="rounded-circle me-3" style="width: 80px; height: 80px; object-fit: cover; border: 2px solid var(--litebite-primary);">
                    <input type="file" class="form-control rounded-3" id="profile_photo" name="profile_photo" accept="image/jpeg,image/png,image/jpg,image/gif">
                </div>
            </div>

            <div class="mb-3">
                <label for="username" class="form-label fw-semibold text-muted">Username</label>
                <input type="text" class="form-control rounded-3" id="username" name="username" value="{{ old('username', $user->username) }}" required>
            </div>

            <div class="mb-4">
                <label for="email" class="form-label fw-semibold text-muted">Email Address</label>
                <input type="email" class="form-control rounded-3" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <hr class="mb-4 text-muted">

            <h5 class="fw-bold mb-3" style="color: var(--litebite-primary);">Change Password</h5>
            <p class="text-muted small mb-3">Leave blank if you do not want to change your password.</p>

            <div class="mb-3">
                <label for="password" class="form-label fw-semibold text-muted">New Password</label>
                <input type="password" class="form-control rounded-3" id="password" name="password">
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="form-label fw-semibold text-muted">Confirm New Password</label>
                <input type="password" class="form-control rounded-3" id="password_confirmation" name="password_confirmation">
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn text-white fw-semibold rounded-3 px-4 py-2 shadow-sm" style="background-color: var(--litebite-primary);">Save Changes</button>
            </div>
        </form>
    </div>
</div>

@endsection
