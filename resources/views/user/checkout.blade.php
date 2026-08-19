@extends('layouts.frontend')

@section('title', 'Checkout')

@section('content')
<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-lg-10">

            <!-- Page Title -->
            <h3 class="fw-bold mb-4" style="color: var(--litebite-primary);">
                <i class="bi bi-shield-check me-2"></i>
                Secure Checkout
            </h3>


            <!-- Error Messages -->
            @if ($errors->any())
                <div class="alert alert-danger rounded-4 border-0 shadow-sm mb-4">

                    <ul class="mb-0">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>
            @endif


            <!-- Checkout Form -->
            <form method="POST" action="{{ route('checkout.process') }}">

                @csrf

                <div class="row g-4">


                    <!-- =========================================
                         BILLING INFORMATION
                    ========================================== -->
                    <div class="col-lg-7">

                        <div class="card shadow-sm border-0 rounded-4 h-100">

                            <div class="card-body p-4 p-md-5">

                                <h5 class="fw-bold mb-4"
                                    style="color: var(--litebite-primary);">

                                    <i class="bi bi-person-lines-fill me-2"></i>
                                    Billing Information

                                </h5>


                                <!-- Name -->
                                <div class="mb-4">

                                    <label for="name"
                                           class="form-label text-muted fw-semibold small">

                                        Full Name

                                    </label>

                                    <input
                                        type="text"
                                        id="name"
                                        class="form-control bg-light rounded-3 border-0 py-2"
                                        value="{{ $user->username }}"
                                        readonly
                                    >

                                </div>


                                <!-- Email -->
                                <div class="mb-4">

                                    <label for="email"
                                           class="form-label text-muted fw-semibold small">

                                        Email Address

                                    </label>

                                    <input
                                        type="email"
                                        id="email"
                                        class="form-control bg-light rounded-3 border-0 py-2"
                                        value="{{ $user->email }}"
                                        readonly
                                    >

                                    <small class="text-muted mt-2 d-block">

                                        <i class="bi bi-info-circle me-1"></i>

                                        Your order information will be associated
                                        with this account.

                                    </small>

                                </div>


                                <!-- Notes -->
                                <div class="mb-4">

                                    <label for="notes"
                                           class="form-label text-muted fw-semibold small">

                                        Additional Notes
                                        <span class="text-muted fw-normal">
                                            (Optional)
                                        </span>

                                    </label>

                                    <textarea
                                        name="notes"
                                        id="notes"
                                        class="form-control rounded-3"
                                        rows="4"
                                        placeholder="Any special requests for your order?"
                                    ></textarea>

                                </div>


                                <!-- Security Information -->
                                <div class="p-3 rounded-3"
                                     style="background-color: #f9f8f4;">

                                    <div class="d-flex align-items-start">

                                        <i class="bi bi-shield-check fs-4 me-3"
                                           style="color: var(--litebite-primary);">
                                        </i>

                                        <div>

                                            <h6 class="fw-bold mb-1"
                                                style="color: var(--litebite-primary);">

                                                Secure Order

                                            </h6>

                                            <small class="text-muted">

                                                Your order information is securely
                                                processed and linked to your account.

                                            </small>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>



                    <!-- =========================================
                         ORDER SUMMARY
                    ========================================== -->
                    <div class="col-lg-5">

                        <div class="card shadow-sm border-0 rounded-4 h-100"
                             style="background-color: #f9f8f4;">

                            <div class="card-body p-4 p-md-5">

                                <h5 class="fw-bold mb-4"
                                    style="color: var(--litebite-primary);">

                                    <i class="bi bi-bag-check me-2"></i>
                                    Order Summary

                                </h5>


                                <!-- Cart Items -->
                                <div class="order-items mb-4"
                                     style="max-height: 350px; overflow-y: auto;">

                                    @foreach($cartItems as $item)

                                        <div class="d-flex justify-content-between
                                                    mb-3 align-items-center">

                                            <!-- Product Information -->
                                            <div class="d-flex align-items-center">

                                                <img
                                                    src="{{ asset($item->product->image_url) }}"
                                                    alt="{{ $item->product->name }}"
                                                    class="rounded-3 shadow-sm me-3"
                                                    style="
                                                        width: 60px;
                                                        height: 60px;
                                                        object-fit: cover;
                                                    "
                                                    onerror="this.onerror=null; this.src='{{ asset('assets/images/default-menu.png') }}';"
                                                >

                                                <div>

                                                    <h6 class="mb-1 fw-bold"
                                                        style="font-size: 0.95rem;">

                                                        {{ $item->product->name }}

                                                    </h6>

                                                    <small class="text-muted">

                                                        {{ $item->quantity }}
                                                        ×
                                                        Rp {{ number_format($item->product->price, 0, ',', '.') }}

                                                    </small>

                                                </div>

                                            </div>


                                            <!-- Item Total -->
                                            <span class="fw-semibold"
                                                  style="
                                                    color: var(--litebite-primary);
                                                    font-size: 0.95rem;
                                                  ">

                                                Rp
                                                {{ number_format(
                                                    $item->product->price * $item->quantity,
                                                    0,
                                                    ',',
                                                    '.'
                                                ) }}

                                            </span>

                                        </div>

                                    @endforeach

                                </div>


                                <hr class="opacity-25 mb-4">


                                <!-- Subtotal -->
                                <div class="d-flex justify-content-between mb-2">

                                    <span class="text-muted">
                                        Subtotal
                                    </span>

                                    <span class="fw-semibold">

                                        Rp
                                        {{ number_format(
                                            $subtotal,
                                            0,
                                            ',',
                                            '.'
                                        ) }}

                                    </span>

                                </div>


                                <!-- Shipping -->
                                <div class="d-flex justify-content-between mb-3">

                                    <span class="text-muted">
                                        Shipping
                                    </span>

                                    <span class="fw-semibold">
                                        Free
                                    </span>

                                </div>


                                <hr class="opacity-25 mb-4">


                                <!-- Total -->
                                <div class="d-flex justify-content-between
                                            align-items-center mb-4">

                                    <h5 class="fw-bold mb-0">
                                        Total Amount
                                    </h5>

                                    <h4 class="fw-bold mb-0"
                                        style="color: var(--litebite-primary);">

                                        Rp
                                        {{ number_format(
                                            $subtotal,
                                            0,
                                            ',',
                                            '.'
                                        ) }}

                                    </h4>

                                </div>


                                <!-- Confirm Order -->
                                <button
                                    type="submit"
                                    class="btn w-100 py-3 fw-bold rounded-pill shadow-sm"
                                    style="
                                        background-color: var(--litebite-primary);
                                        color: white;
                                        transition: all 0.3s ease;
                                    "
                                >

                                    <i class="bi bi-check-circle me-2"></i>

                                    Confirm Order

                                </button>


                                <!-- Edit Cart -->
                                <div class="text-center mt-3">

                                    <a
                                        href="{{ route('cart.index') }}"
                                        class="btn btn-link text-decoration-none text-muted small"
                                    >

                                        <i class="bi bi-arrow-left me-1"></i>

                                        Edit Cart

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