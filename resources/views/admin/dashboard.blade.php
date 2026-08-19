@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')
<div class="row g-4 justify-content-center">
    <div class="col-12 col-md-4">
        <div class="card border-0 shadow-sm rounded-4 h-100" style="background-color: rgba(43, 50, 27, 0.03);">
            <div class="card-body p-4 d-flex align-items-center justify-content-between">
                <div class="text-truncate pe-3">
                    <p class="text-muted mb-1 fw-semibold text-uppercase text-truncate" style="font-size: 0.8rem;">Categories</p>
                    <h2 class="mb-0 fw-bold" style="color: var(--litebite-primary);">{{ $totalCategories }}</h2>
                </div>
                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="background-color: rgba(204, 213, 174, 0.3); width: 56px; height: 56px;">
                    <i class="bi bi-tags fs-4" style="color: var(--litebite-primary);"></i>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 px-4 pb-4 pt-0">
                <a href="{{ route('admin.categories.index') }}" class="text-decoration-none fw-semibold" style="color: var(--litebite-primary); font-size: 0.9rem;">
                    Manage Categories <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="card border-0 shadow-sm rounded-4 h-100" style="background-color: rgba(43, 50, 27, 0.03);">
            <div class="card-body p-4 d-flex align-items-center justify-content-between">
                <div class="text-truncate pe-3">
                    <p class="text-muted mb-1 fw-semibold text-uppercase text-truncate" style="font-size: 0.8rem;">Total Products</p>
                    <h2 class="mb-0 fw-bold" style="color: var(--litebite-primary);">{{ $totalProducts }}</h2>
                </div>
                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="background-color: rgba(204, 213, 174, 0.3); width: 56px; height: 56px;">
                    <i class="bi bi-cup-hot fs-4" style="color: var(--litebite-primary);"></i>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 px-4 pb-4 pt-0">
                <a href="{{ route('admin.products.index') }}" class="text-decoration-none fw-semibold" style="color: var(--litebite-primary); font-size: 0.9rem;">
                    Manage Products <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="card border-0 shadow-sm rounded-4 h-100" style="background-color: rgba(43, 50, 27, 0.03);">
            <div class="card-body p-4 d-flex align-items-center justify-content-between">
                <div class="text-truncate pe-3">
                    <p class="text-muted mb-1 fw-semibold text-uppercase text-truncate" style="font-size: 0.8rem;">Total Users</p>
                    <h2 class="mb-0 fw-bold" style="color: var(--litebite-primary);">{{ $totalUsers }}</h2>
                </div>
                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="background-color: rgba(204, 213, 174, 0.3); width: 56px; height: 56px;">
                    <i class="bi bi-people fs-4" style="color: var(--litebite-primary);"></i>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 px-4 pb-4 pt-0">
                <a href="{{ route('admin.users.index') }}" class="text-decoration-none fw-semibold" style="color: var(--litebite-primary); font-size: 0.9rem;">
                    Manage Users <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mt-1 justify-content-center">
    <div class="col-12 col-md-4">
        <div class="card border-0 shadow-sm rounded-4 h-100" style="background-color: rgba(43, 50, 27, 0.03);">
            <div class="card-body p-4 d-flex align-items-center justify-content-between">
                <div class="text-truncate pe-3">
                    <p class="text-muted mb-1 fw-semibold text-uppercase text-truncate" style="font-size: 0.8rem;">Total Orders</p>
                    <h2 class="mb-0 fw-bold" style="color: var(--litebite-primary);">{{ $totalOrders }}</h2>
                </div>
                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="background-color: rgba(204, 213, 174, 0.3); width: 56px; height: 56px;">
                    <i class="bi bi-bag-check fs-4" style="color: var(--litebite-primary);"></i>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 px-4 pb-4 pt-0">
                <a href="{{ route('admin.orders.index') }}" class="text-decoration-none fw-semibold" style="color: var(--litebite-primary); font-size: 0.9rem;">
                    Manage Orders <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
