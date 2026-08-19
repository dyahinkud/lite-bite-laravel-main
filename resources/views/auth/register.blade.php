@extends('layouts.frontend')

@section('title', 'Sign Up')

@section('content')
<style>
    .register-container {
        max-width: 450px;
        margin: 80px auto;
        background: white;
        padding: 40px;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .register-title {
        font-family: var(--litebite-font);
        color: var(--litebite-primary);
        text-align: center;
        margin-bottom: 30px;
    }

    .btn-register {
        background-color: var(--litebite-primary);
        color: white;
        border-radius: 50px;
        padding: 10px 30px;
        transition: background-color 0.3s ease;
    }

    .btn-register:hover {
        background-color: #6B774C;
        color: white;
    }

    .form-control:focus {
        border-color: var(--litebite-accent);
        box-shadow: 0 0 0 0.2rem rgba(204, 213, 174, 0.5);
    }

    .register-footer {
        text-align: center;
        margin-top: 20px;
        font-size: 14px;
    }

    .register-footer a {
        color: var(--litebite-primary);
        text-decoration: none;
        font-weight: bold;
    }

    .register-footer a:hover {
        text-decoration: underline;
    }
</style>

<div class="register-container">
    <h2 class="register-title">Create Your Account</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('register.post') }}">
        @csrf
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required value="{{ old('username') }}" />
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" required value="{{ old('email') }}" />
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Create Password</label>
            <input type="password" class="form-control" id="password" name="password" required minlength="6" />
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-register">Sign Up</button>
        </div>
    </form>

    <div class="register-footer mt-4">
        Already have an account? <a href="{{ route('login') }}">Login</a>
    </div>
</div>
@endsection
