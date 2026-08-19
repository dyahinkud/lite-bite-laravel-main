@extends('layouts.user')

@section('title', 'My Cart')
@section('page_title', 'My Cart')

@section('content')
<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <h3 class="fw-bold" style="color: var(--litebite-primary);">Shopping Cart</h3>
        <p class="text-muted">Review your items before checkout.</p>
    </div>
    <a href="{{ route('menu') }}" class="btn btn-outline-secondary rounded-pill px-4">
        <i class="bi bi-cart-plus me-1"></i> Add More Items
    </a>
</div>

@if ($cartItems->count() > 0)
    <div class="row">
        <div class="col-lg-8 mb-4 mb-lg-0">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    @foreach ($cartItems as $item)
                        <div class="d-flex align-items-center mb-4 {{ !$loop->last ? 'border-bottom pb-4' : '' }}">
                            <img src="{{ asset($item->product->image_url) }}" alt="{{ $item->product->name }}" class="rounded-3 shadow-sm object-fit-cover me-4" style="width: 80px; height: 80px;" onerror="this.onerror=null; this.src='{{ asset('assets/images/default-menu.png') }}';">
                            <div class="flex-grow-1">
                                <h5 class="fw-bold mb-1" style="color: var(--litebite-primary);">{{ $item->product->name }}</h5>
                                <p class="text-success fw-semibold mb-2">Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                                @if($item->notes)
                                    <small class="text-muted"><i class="bi bi-pencil me-1"></i>{{ $item->notes }}</small>
                                @endif
                            </div>
                            <div class="d-flex flex-column align-items-end">
                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex align-items-center mb-2">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="quantity" class="form-control form-control-sm text-center me-2" value="{{ $item->quantity }}" min="1" style="width: 60px;" onchange="this.form.submit()">
                                </form>
                                <h6 class="fw-bold mb-2">Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</h6>
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-link text-danger p-0 text-decoration-none"><i class="bi bi-trash3 me-1"></i>Remove</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 position-sticky" style="top: 100px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4" style="color: var(--litebite-primary);">Order Summary</h5>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Subtotal ({{ $cartItems->sum('quantity') }} items)</span>
                        <span class="fw-semibold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-4">
                        <span class="fw-bold" style="font-size: 1.1rem; color: var(--litebite-primary);">Total</span>
                        <span class="fw-bold text-success" style="font-size: 1.2rem;">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    
                    <a href="{{ route('checkout') }}" class="btn w-100 py-3 fw-bold rounded-pill shadow-sm" style="background-color: var(--litebite-primary); color: white;">
                        Proceed to Checkout <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-5 text-center">
            <div class="mb-4">
                <i class="bi bi-cart-x text-muted" style="font-size: 4rem;"></i>
            </div>
            <h4 class="fw-bold mb-3" style="color: var(--litebite-primary);">Your Cart is Empty</h4>
            <p class="text-muted mb-4">Looks like you haven't added anything to your cart yet.</p>
            <a href="{{ route('menu') }}" class="btn text-white rounded-pill px-5 py-2" style="background-color: var(--litebite-primary);">
                Start Browsing
            </a>
        </div>
    </div>
@endif
@endsection
