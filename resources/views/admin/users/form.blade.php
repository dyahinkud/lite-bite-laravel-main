@extends('layouts.admin')

@section('title', isset($user) ? 'Edit User' : 'Add User')
@section('page_title', isset($user) ? 'Edit User' : 'Add User')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-0" style="color: var(--litebite-primary);">{{ isset($user) ? 'Edit User Details' : 'Add New User' }}</h3>
                <p class="text-muted mb-0">Fill in the user details below.</p>
            </div>
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                <i class="bi bi-arrow-left me-1"></i> Back
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 shadow-sm">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                <h5 class="fw-bold mb-0" style="color: var(--litebite-primary);">User Information</h5>
            </div>

            <form action="{{ isset($user) ? route('admin.users.update', $user) : route('admin.users.store') }}" method="POST">
                @csrf
                @if(isset($user))
                    @method('PUT')
                @endif

                <div class="card-body p-4">
                    <div class="mb-4">
                        <label for="username" class="form-label fw-semibold text-muted small text-uppercase">Username <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg rounded-3 bg-light border-0" id="username" name="username" value="{{ old('username', $user->username ?? '') }}" required placeholder="e.g. johndoe">
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label fw-semibold text-muted small text-uppercase">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control form-control-lg rounded-3 bg-light border-0" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required placeholder="e.g. john@example.com">
                    </div>

                    <div class="mb-4">
                        <label for="role" class="form-label fw-semibold text-muted small text-uppercase">Role <span class="text-danger">*</span></label>
                        <select class="form-select form-select-lg rounded-3 bg-light border-0" id="role" name="role" required>
                            <option value="user" {{ old('role', $user->role ?? '') === 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ old('role', $user->role ?? '') === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>

                    <hr class="my-4 text-muted border-top border-2 border-opacity-10">
                    <h6 class="fw-bold mb-3" style="color: var(--litebite-primary);">Security</h6>

                    <div class="mb-4">
                        <label for="password" class="form-label fw-semibold text-muted small text-uppercase">
                            Password 
                            @if(isset($user))
                                <span class="text-muted fw-normal text-lowercase">(leave blank to keep current)</span>
                            @else
                                <span class="text-danger">*</span>
                            @endif
                        </label>
                        <input type="password" class="form-control form-control-lg rounded-3 bg-light border-0" id="password" name="password" {{ isset($user) ? '' : 'required' }} placeholder="••••••••">
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label fw-semibold text-muted small text-uppercase">
                            Confirm Password 
                            @if(!isset($user))
                                <span class="text-danger">*</span>
                            @endif
                        </label>
                        <input type="password" class="form-control form-control-lg rounded-3 bg-light border-0" id="password_confirmation" name="password_confirmation" {{ isset($user) ? '' : 'required' }} placeholder="••••••••">
                    </div>

                </div>

                <div class="card-footer bg-transparent border-top-0 px-4 pb-4 text-end">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-light rounded-pill px-4 py-2 me-2">Cancel</a>
                    <button type="submit" class="btn text-white rounded-pill px-4 py-2" style="background-color: var(--litebite-primary);">
                        <i class="bi bi-{{ isset($user) ? 'check2-circle' : 'plus-lg' }} me-1"></i> 
                        {{ isset($user) ? 'Update User' : 'Save User' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
