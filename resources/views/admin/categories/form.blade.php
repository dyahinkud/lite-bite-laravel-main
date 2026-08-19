@extends('layouts.admin')

@section('title', isset($category) ? 'Edit Category' : 'Add Category')
@section('page_title', isset($category) ? 'Edit Category' : 'Add Category')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-0" style="color: var(--litebite-primary);">{{ isset($category) ? 'Edit' : 'Add New' }} Category</h3>
        <p class="text-muted mb-0">Fill in the details for the meal category.</p>
    </div>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
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
        <h5 class="fw-bold mb-0" style="color: var(--litebite-primary);">Category Information</h5>
    </div>

    <form method="POST" action="{{ isset($category) ? route('admin.categories.update', $category->id) : route('admin.categories.store') }}">
        @csrf
        @if(isset($category))
            @method('PUT')
        @endif
        <div class="card-body p-4">
            <div class="mb-4">
                <label class="form-label fw-semibold text-muted small text-uppercase">Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control form-control-lg rounded-3 bg-light border-0" required value="{{ old('name', $category->name ?? '') }}" placeholder="E.g., Salads & Wraps">
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold text-muted small text-uppercase">Slug <span class="text-danger">*</span></label>
                <input type="text" name="slug" class="form-control form-control-lg rounded-3 bg-light border-0" required value="{{ old('slug', $category->slug ?? '') }}" placeholder="E.g., salad">
                <div class="form-text">A URL-friendly version of the name. Must be unique.</div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold text-muted small text-uppercase">Icon</label>
                <input type="text" name="icon" class="form-control form-control-lg rounded-3 bg-light border-0" value="{{ old('icon', $category->icon ?? '') }}" placeholder="E.g., egg-fried">
                <div class="form-text">Bootstrap Icons class name (without the 'bi-' prefix). For example: <code>egg-fried</code>, <code>stack</code>, <code>cup-straw</code>. Find more at <a href="https://icons.getbootstrap.com/" target="_blank">icons.getbootstrap.com</a>.</div>
            </div>
        </div>

        <div class="card-footer bg-transparent border-top-0 px-4 pb-4 text-end">
            <button type="submit" class="btn text-white rounded-pill px-4 py-2" style="background-color: var(--litebite-primary);">
                <i class="bi bi-{{ isset($category) ? 'check2-circle' : 'plus-lg' }} me-1"></i>
                {{ isset($category) ? 'Update' : 'Add' }} Category
            </button>
        </div>
    </form>
</div>

@endsection
