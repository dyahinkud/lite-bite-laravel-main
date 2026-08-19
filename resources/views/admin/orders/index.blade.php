@extends('layouts.admin')

@section('title', 'Manage Orders')
@section('page_title', 'Manage Orders')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-0" style="color: var(--litebite-primary);">Manage Orders</h3>
        <p class="text-muted mb-0">View all customer orders.</p>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4 table-responsive">
        <table class="table table-hover align-middle mb-0" id="ordersTable">
            <thead class="table-light text-uppercase text-muted" style="font-size: 0.85rem;">
                <tr>
                    <th class="fw-semibold border-0 py-3 rounded-start" style="width: 50px;">ID</th>
                    <th class="fw-semibold border-0 py-3">Customer</th>
                    <th class="fw-semibold border-0 py-3">Order Items</th>
                    <th class="fw-semibold border-0 py-3">Total</th>
                    <th class="fw-semibold border-0 py-3">Status</th>
                    <th class="fw-semibold border-0 py-3">Method</th>
                    <th class="fw-semibold border-0 py-3 rounded-end">Date</th>
                </tr>
            </thead>
            <tbody class="border-top-0">
                @forelse($orders as $order)
                    <tr>
                        <td class="text-muted">#{{ $order->id }}</td>
                        <td>
                            <div class="d-flex flex-column">
                                <span class="fw-semibold" style="color: var(--litebite-primary);">{{ $order->customer_name }}</span>
                                <small class="text-muted"><i class="bi bi-telephone me-1"></i>{{ $order->phone }}</small>
                            </div>
                        </td>
                        <td>
                            <ul class="list-unstyled mb-0 small">
                                @foreach($order->items as $item)
                                    <li>
                                        <span class="badge bg-light text-dark border px-2 py-1 me-1">{{ $item->quantity }}x</span>
                                        {{ $item->product->name ?? 'Unknown' }}
                                        @if($item->notes)
                                            <small class="text-muted d-block ms-4 fst-italic">Note: {{ $item->notes }}</small>
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
                        <td class="text-muted small">
                            {{ $order->created_at->format('M d, Y h:i A') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                            No orders found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        if($('#ordersTable').length) {
            $('#ordersTable').DataTable({
                "order": [[0, "desc"]], // Order by ID descending (newest first)
                "responsive": true,
                "autoWidth": false,
                "dom": '<"row mb-3"<"col-md-6"l><"col-md-6"f>>rt<"row mt-3"<"col-md-6"i><"col-md-6"p>>'
            });
        }
    });
</script>
@endsection
