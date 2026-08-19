@extends('layouts.admin')

@section('title', isset($product) ? 'Edit Product' : 'Add Product')
@section('page_title', isset($product) ? 'Edit Product' : 'Add Product')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-0" style="color: var(--litebite-primary);">{{ isset($product) ? 'Edit' : 'Add New' }} Product</h3>
        <p class="text-muted mb-0">Fill in the details for the meal item.</p>
    </div>
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
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
        <h5 class="fw-bold mb-0" style="color: var(--litebite-primary);">Product Information</h5>
    </div>

    <form method="POST" action="{{ isset($product) ? route('admin.products.update', $product->id) : route('admin.products.store') }}" enctype="multipart/form-data">
        @csrf
        @if(isset($product))
            @method('PUT')
        @endif
        <div class="card-body p-4">
            <div class="mb-4">
                <label class="form-label fw-semibold text-muted small text-uppercase">Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control form-control-lg rounded-3 bg-light border-0" required value="{{ old('name', $product->name ?? '') }}" placeholder="E.g., Chicken Caesar Salad">
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold text-muted small text-uppercase">Description <span class="text-danger">*</span></label>
                <textarea name="description" rows="3" class="form-control form-control-lg rounded-3 bg-light border-0" required placeholder="Describe the meal...">{{ old('description', $product->description ?? '') }}</textarea>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold text-muted small text-uppercase">Price <span class="text-danger">*</span></label>
                <div class="input-group input-group-lg">
                    <span class="input-group-text bg-light border-0 text-muted rounded-start-3">Rp</span>
                    <input type="number" step="1000" name="price" class="form-control form-control-lg rounded-end-3 bg-light border-0" required value="{{ old('price', $product->price ?? '') }}" placeholder="E.g., 25000">
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold text-muted small text-uppercase">Category <span class="text-danger">*</span></label>
                <select name="category_id" class="form-select form-select-lg rounded-3 bg-light border-0" required>
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold text-muted small text-uppercase">Upload Image</label>
                <input type="file" name="image_file" class="form-control form-control-lg rounded-3 bg-light border-0">
                @if(isset($product) && $product->image_url)
                    <div class="mt-3">
                        <p class="mb-2 fw-semibold small text-muted">Current Image:</p>
                        <img src="{{ asset($product->image_url) }}" alt="Current Image" width="120" class="rounded-3 shadow-sm object-fit-cover" style="object-fit: cover;" onerror="this.onerror=null; this.src='{{ asset('assets/images/default-menu.png') }}';">
                    </div>
                @endif
            </div>

            <label class="form-label fw-semibold text-muted small text-uppercase mb-3">Nutritional Information</label>
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-light border-0 text-muted rounded-start-3">Carb (g)</span>
                        <input type="text" name="carb" class="form-control bg-light border-0 rounded-end-3" value="{{ old('carb', $product->carb ?? '') }}" placeholder="0">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-light border-0 text-muted rounded-start-3">Protein (g)</span>
                        <input type="text" name="protein" class="form-control bg-light border-0 rounded-end-3" value="{{ old('protein', $product->protein ?? '') }}" placeholder="0">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-light border-0 text-muted rounded-start-3">Fat (g)</span>
                        <input type="text" name="fat" class="form-control bg-light border-0 rounded-end-3" value="{{ old('fat', $product->fat ?? '') }}" placeholder="0">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-light border-0 text-muted rounded-start-3">Calories</span>
                        <input type="text" name="calories" class="form-control bg-light border-0 rounded-end-3" value="{{ old('calories', $product->calories ?? '') }}" placeholder="0">
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer bg-transparent border-top-0 px-4 pb-4 text-end">
            <button type="submit" class="btn text-white rounded-pill px-4 py-2" style="background-color: var(--litebite-primary);">
                <i class="bi bi-{{ isset($product) ? 'check2-circle' : 'plus-lg' }} me-1"></i>
                {{ isset($product) ? 'Update' : 'Add' }} Product
            </button>
        </div>
    </form>
</div>

@endsection
