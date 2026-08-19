@extends('layouts.user')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')
<div class="mb-4">
    <h3 class="fw-bold" style="color: var(--litebite-primary);">Welcome, {{ Auth::user()->username }} 👋</h3>
    <p class="text-muted">Manage your orders and explore delicious meals.</p>
</div>

<div class="row g-4">
    <!-- Browse Menu -->
    <div class="col-md-6">
        <div class="card border-0 shadow-sm rounded-4 h-100" style="background-color: rgba(43, 50, 27, 0.03);">
            <div class="card-body p-4 d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="fw-bold mb-1" style="color: var(--litebite-primary);">Browse Menu</h5>
                    <p class="text-muted mb-0 small">Explore our delicious meals</p>
                </div>
                <div class="rounded-circle p-3 d-flex align-items-center justify-content-center" style="background-color: rgba(204, 213, 174, 0.3); width: 64px; height: 64px;">
                    <i class="bi bi-cup-hot fs-3" style="color: var(--litebite-primary);"></i>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 px-4 pb-4 pt-0">
                <a href="{{ route('menu') }}" class="btn rounded-pill px-4 text-white" style="background-color: var(--litebite-primary);">
                    Explore Menu
                </a>
            </div>
        </div>
    </div>

    <!-- My Orders -->
    <div class="col-md-6">
        <div class="card border-0 shadow-sm rounded-4 h-100" style="background-color: rgba(43, 50, 27, 0.03);">
            <div class="card-body p-4 d-flex align-items-center justify-content-between">
                <div>
                    <p class="text-muted mb-1 fw-semibold text-uppercase" style="font-size: 0.85rem;">My Total Orders</p>
                    <h2 class="mb-0 fw-bold" style="color: var(--litebite-primary);">{{ $totalOrders ?? 0 }}</h2>
                </div>
                <div class="rounded-circle p-3 d-flex align-items-center justify-content-center" style="background-color: rgba(204, 213, 174, 0.3); width: 64px; height: 64px;">
                    <i class="bi bi-receipt fs-3" style="color: var(--litebite-primary);"></i>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 px-4 pb-4 pt-0">
                <a href="{{ route('orders.index') }}" class="btn btn-outline-dark rounded-pill px-4">
                    View Orders
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
