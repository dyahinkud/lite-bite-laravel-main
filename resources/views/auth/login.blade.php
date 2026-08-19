@extends('layouts.frontend')

@section('title', 'Login')

@section('content')
<style>
    .login-container {
        max-width: 400px;
        margin: 80px auto;
        background: white;
        padding: 40px;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .login-title {
        font-family: var(--litebite-font);
        color: var(--litebite-primary);
        text-align: center;
        margin-bottom: 30px;
    }

    .btn-login {
        background-color: var(--litebite-primary);
        color: white;
        border-radius: 50px;
        padding: 10px 30px;
        transition: background-color 0.3s ease;
    }

    .btn-login:hover {
        background-color: #6B774C;
        color: white;
    }

    .form-control:focus {
        border-color: var(--litebite-accent);
        box-shadow: 0 0 0 0.2rem rgba(204, 213, 174, 0.5);
    }

    .login-footer {
        text-align: center;
        margin-top: 20px;
        font-size: 14px;
    }

    .login-footer a {
        color: var(--litebite-primary);
        text-decoration: none;
        font-weight: bold;
    }

    .login-footer a:hover {
        text-decoration: underline;
    }
</style>

<div class="login-container">
    <h2 class="login-title">Welcome Back</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <div class="mb-3">
            <label for="username" class="form-label">Email or Username</label>
            <input type="text" class="form-control" id="username" name="username" required autofocus />
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required />
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-login">Login</button>
        </div>
    </form>
    <div class="login-footer mt-4">
        Don't have an account? <a href="{{ route('register') }}">Sign up</a>
    </div>
</div>
@endsection
