@extends('layouts.frontend')

@section('title', $product->name . ' | Lite Bite')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card mb-4 shadow-sm border-0 rounded-4">
                <div class="row g-0 flex-column flex-md-row align-items-center">
                    <!-- Image -->
                    <div class="col-md-5 text-center p-4">
                        <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}" class="img-fluid rounded-4 shadow-sm" style="max-height: 350px; object-fit: contain;" onerror="this.onerror=null; this.src='{{ asset('assets/images/default-menu.png') }}';">
                    </div>
                    <!-- Product Info -->
                    <div class="col-md-7">
                        <div class="card-body p-4 p-md-5">
                            <h2 class="card-title fw-bold mb-3" style="color: var(--litebite-primary);">{{ $product->name }}</h2>
                            <p class="card-text text-muted mb-4 fs-5">{{ $product->description }}</p>

                            <div class="my-4">
                                <div class="row text-center g-3">
                                    <div class="col-6 col-sm-3">
                                        <div class="p-3 bg-light rounded-3 h-100 shadow-sm border border-white">
                                            <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.75rem;">Carbs</small>
                                            <strong class="fs-5" style="color: var(--litebite-primary);">{{ $product->carb }}g</strong>
                                        </div>
                                    </div>
                                    <div class="col-6 col-sm-3">
                                        <div class="p-3 bg-light rounded-3 h-100 shadow-sm border border-white">
                                            <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.75rem;">Protein</small>
                                            <strong class="fs-5" style="color: var(--litebite-primary);">{{ $product->protein }}g</strong>
                                        </div>
                                    </div>
                                    <div class="col-6 col-sm-3">
                                        <div class="p-3 bg-light rounded-3 h-100 shadow-sm border border-white">
                                            <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.75rem;">Fat</small>
                                            <strong class="fs-5" style="color: var(--litebite-primary);">{{ $product->fat }}g</strong>
                                        </div>
                                    </div>
                                    <div class="col-6 col-sm-3">
                                        <div class="p-3 rounded-3 h-100 shadow-sm" style="background-color: var(--litebite-accent); color: var(--litebite-primary);">
                                            <small class="d-block text-uppercase fw-bold" style="font-size: 0.75rem;">Calories</small>
                                            <strong class="fs-5">{{ $product->calories }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @auth
                                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-4">
                                    @csrf
                                    <div class="row g-2 align-items-center mb-3">
                                        <div class="col-auto">
                                            <label for="quantity" class="col-form-label fw-bold">Quantity:</label>
                                        </div>
                                        <div class="col-3">
                                            <input type="number" id="quantity" name="quantity" class="form-control" value="1" min="1" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <textarea name="notes" class="form-control" rows="2" placeholder="Notes (Optional)"></textarea>
                                    </div>
                                    <button type="submit" class="btn w-100 py-3 rounded-pill fw-bold fs-5 shadow-sm" style="background-color: var(--litebite-primary); color: white; transition: all 0.3s ease;">
                                        <i class="bi bi-cart-plus-fill me-2"></i> Add to Cart - Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="btn w-100 mt-4 py-3 rounded-pill fw-bold fs-5 shadow-sm" style="background-color: var(--litebite-primary); color: white; transition: all 0.3s ease;">
                                    <i class="bi bi-box-arrow-in-right me-2"></i> Login to Order
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <div class="text-center mt-4">
                <a href="{{ route('menu') }}" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="bi bi-arrow-left-circle me-2"></i> Back to Menu
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
