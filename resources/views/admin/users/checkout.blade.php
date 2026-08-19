@extends('layouts.frontend')

@section('title', 'Checkout')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <h3 class="fw-bold mb-4" style="color: var(--litebite-primary);">Secure Checkout</h3>

            @if ($errors->any())
                <div class="alert alert-danger rounded-4 border-0 shadow-sm">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('checkout.process') }}">
                @csrf
                <div class="row">
                    <!-- Billing Info -->
                    <div class="col-md-7 mb-4 mb-md-0">
                        <div class="card shadow-sm border-0 rounded-4 h-100">
                            <div class="card-body p-4 p-md-5">
                                <h5 class="fw-bold mb-4" style="color: var(--litebite-primary);"><i class="bi bi-person-lines-fill me-2"></i>Billing Information</h5>
                                
                                <div class="mb-4">
                                    <label class="form-label text-muted fw-semibold small">Full Name</label>
                                    <input type="text" class="form-control bg-light rounded-3 border-0 py-2" value="{{ $user->username }}" readonly>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label text-muted fw-semibold small">Email Address</label>
                                    <input type="email" class="form-control bg-light rounded-3 border-0 py-2" value="{{ $user->email }}" readonly>
                                    <small class="text-muted mt-2 d-block"><i class="bi bi-info-circle me-1"></i>Your order receipt will be sent to this email.</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="col-md-5">
                        <div class="card shadow-sm border-0 rounded-4 h-100" style="background-color: #f9f8f4;">
                            <div class="card-body p-4 p-md-5">
                                <h5 class="fw-bold mb-4" style="color: var(--litebite-primary);"><i class="bi bi-bag-check me-2"></i>Order Summary</h5>
                                
                                <div class="order-items mb-4" style="max-height: 300px; overflow-y: auto;">
                                    @foreach($cartItems as $item)
                                    <div class="d-flex justify-content-between mb-3 align-items-center">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset($item->product->image_url) }}" alt="" class="rounded-3 shadow-sm me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                            <div>
                                                <h6 class="mb-0 fw-bold" style="font-size: 0.95rem;">{{ $item->product->name }}</h6>
                                                <small class="text-muted">Qty: {{ $item->quantity }}</small>
                                            </div>
                                        </div>
                                        <span class="fw-semibold text-success" style="font-size: 0.95rem;">Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</span>
                                    </div>
                                    @endforeach
                                </div>

                                <hr class="opacity-25 mb-4">
                                
                                <div class="d-flex justify-content-between mb-4">
                                    <h5 class="fw-bold mb-0">Total Amount</h5>
                                    <h4 class="fw-bold text-success mb-0">Rp {{ number_format($subtotal, 0, ',', '.') }}</h4>
                                </div>

                                <button type="submit" class="btn w-100 py-3 fw-bold rounded-pill shadow-lg" style="background-color: var(--litebite-primary); color: white; transition: all 0.3s ease;">
                                    Confirm Order <i class="bi bi-shield-lock ms-2"></i>
                                </button>
                                
                                <div class="text-center mt-4">
                                    <a href="{{ route('cart.index') }}" class="btn btn-link text-decoration-none text-muted small">
                                        <i class="bi bi-arrow-left me-1"></i> Edit Cart
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
