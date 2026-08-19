@extends('layouts.frontend')

@section('title', 'Payment')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-6">
            <div class="text-center mb-5">
                <h2 class="fw-bold" style="color: var(--litebite-primary);">Complete Your Payment</h2>
                <p class="text-muted">Order ID: #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger rounded-4 border-0 shadow-sm mb-4">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card shadow-sm border-0 rounded-4 overflow-hidden mb-4">
                <div class="card-header bg-light border-bottom-0 p-4 text-center">
                    <p class="text-muted text-uppercase small fw-bold mb-1">Amount to Pay</p>
                    <h1 class="display-5 fw-bold text-success mb-0">Rp {{ number_format($order->total_price, 0, ',', '.') }}</h1>
                </div>
                <div class="card-body p-4 p-md-5">
                    
                    <h5 class="fw-bold mb-4" style="color: var(--litebite-primary);">Select Payment Method</h5>
                    
                    <form id="paymentForm" method="POST" action="{{ route('payment.process', $order->id) }}">
                        @csrf
                        
                        <!-- Payment Options -->
                        <div class="row g-3 mb-5">
                            <div class="col-12">
                                <input type="radio" class="btn-check" name="payment_method" id="qris" value="qris" required>
                                <label class="btn btn-outline-light w-100 p-4 rounded-4 text-start payment-label border shadow-sm" for="qris">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-box rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                            <i class="bi bi-qr-code-scan fs-4"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold text-dark mb-1">QRIS</h6>
                                            <small class="text-muted">Pay instantly using any e-Wallet or Banking app</small>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            
                            <div class="col-12">
                                <input type="radio" class="btn-check" name="payment_method" id="bank_transfer" value="bank_transfer">
                                <label class="btn btn-outline-light w-100 p-4 rounded-4 text-start payment-label border shadow-sm" for="bank_transfer">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-box rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                            <i class="bi bi-bank fs-4"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold text-dark mb-1">Bank Transfer</h6>
                                            <small class="text-muted">Virtual Account BCA, Mandiri, BNI, BRI</small>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <div class="col-12">
                                <input type="radio" class="btn-check" name="payment_method" id="ewallet" value="ewallet">
                                <label class="btn btn-outline-light w-100 p-4 rounded-4 text-start payment-label border shadow-sm" for="ewallet">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-box rounded-circle bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                            <i class="bi bi-wallet2 fs-4"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold text-dark mb-1">E-Wallet</h6>
                                            <small class="text-muted">GoPay, OVO, ShopeePay, DANA</small>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <button type="button" id="payButton" class="btn w-100 py-3 fw-bold rounded-pill shadow-lg text-white" style="background-color: var(--litebite-primary); font-size: 1.1rem;">
                            Pay Now <i class="bi bi-arrow-right-circle ms-2"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .payment-label {
        transition: all 0.2s ease;
        border-color: #e9ecef !important;
    }
    .payment-label:hover {
        border-color: var(--litebite-accent) !important;
        background-color: #fafaf9;
    }
    .btn-check:checked + .payment-label {
        border-color: var(--litebite-primary) !important;
        background-color: rgba(204, 213, 174, 0.15) !important;
        box-shadow: 0 0 0 2px rgba(43, 50, 27, 0.2) !important;
    }
</style>

<script>
document.getElementById('payButton').addEventListener('click', function() {
    const selectedMethod = document.querySelector('input[name="payment_method"]:checked');
    
    if (!selectedMethod) {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Please select a payment method first!',
            customClass: { popup: 'rounded-4' }
        });
        return;
    }

    Swal.fire({
        title: 'Processing Payment',
        html: 'Please wait while we secure your transaction...',
        timer: 1500,
        timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading();
        },
        willClose: () => {
            document.getElementById('paymentForm').submit();
        }
    });
});
</script>
@endsection
