@extends('layouts.user')

@section('title', 'My Orders')
@section('page_title', 'My Orders')

@section('content')
<div class="mb-4">
    <h3 class="fw-bold" style="color: var(--litebite-primary);">My Orders</h3>
    <p class="text-muted">Review your past meal requests and their status.</p>
</div>

@if ($orders->count() > 0)
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4 table-responsive">
            <table class="table table-hover align-middle mb-0" id="ordersTable">
                <thead class="table-light text-uppercase text-muted" style="font-size: 0.85rem;">
                    <tr>
                        <th class="fw-semibold border-0 py-3 rounded-start">#</th>
                        <th class="fw-semibold border-0 py-3">Items</th>
                        <th class="fw-semibold border-0 py-3">Total Amount</th>
                        <th class="fw-semibold border-0 py-3">Status</th>
                        <th class="fw-semibold border-0 py-3">Method</th>
                        <th class="fw-semibold border-0 py-3 rounded-end">Ordered At</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @foreach ($orders as $order)
                        <tr>
                            <td class="text-muted">#{{ $order->id }}</td>
                            <td>
                                <ul class="list-unstyled mb-0 small">
                                    @foreach($order->items as $item)
                                        <li class="mb-2">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset($item->product->image_url ?? '') }}" alt="Img" width="32" height="32" class="me-2 rounded shadow-sm object-fit-cover" onerror="this.onerror=null; this.src='{{ asset('assets/images/default-menu.png') }}';">
                                                <span>
                                                    <span class="badge bg-light text-dark border px-2 py-1 me-1">{{ $item->quantity }}x</span>
                                                    <span class="fw-semibold" style="color: var(--litebite-primary);">{{ $item->product->name ?? 'Unknown' }}</span>
                                                </span>
                                            </div>
                                            @if($item->notes)
                                                <small class="text-muted d-block mt-1 ms-5 fst-italic">Note: {{ $item->notes }}</small>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <span class="fw-semibold text-success">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </td>
                            <td>
                                @if($order->payment_status === 'paid')
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1">Paid</span>
                                @elseif($order->payment_status === 'failed')
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-2 py-1">Failed</span>
                                @else
                                    <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 px-2 py-1">Pending</span>
                                @endif
                            </td>
                            <td>
                                <span class="text-uppercase text-muted small fw-semibold">{{ str_replace('_', ' ', $order->payment_method ?? '-') }}</span>
                            </td>
                            <td class="text-muted small">{{ $order->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@else
    <div class="alert alert-info border-0 shadow-sm rounded-4 d-flex align-items-center p-4" style="background-color: rgba(204, 213, 174, 0.15);">
        <i class="bi bi-info-circle fs-3 me-3 text-info"></i>
        <div>
            <h5 class="alert-heading fw-bold mb-1" style="color: var(--litebite-primary);">No Orders Found</h5>
            <p class="mb-0 text-muted">You haven't placed any orders yet. <a href="{{ route('menu') }}" class="fw-semibold text-decoration-none" style="color: var(--litebite-primary);">Browse our Menu</a></p>
        </div>
    </div>
@endif

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        if($('#ordersTable').length) {
            $('#ordersTable').DataTable({
                "responsive": true,
                "autoWidth": false,
                "dom": '<"row mb-3"<"col-md-6"l><"col-md-6"f>>rt<"row mt-3"<"col-md-6"i><"col-md-6"p>>'
            });
        }
    });
</script>
@endsection
