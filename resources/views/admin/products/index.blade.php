@extends('layouts.admin')

@section('title', 'Manage Products')
@section('page_title', 'Manage Products')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-0" style="color: var(--litebite-primary);">Manage Products</h3>
        <p class="text-muted mb-0">View, edit, or delete meal items.</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="btn text-white rounded-pill px-4 shadow-sm" style="background-color: var(--litebite-primary);">
        <i class="bi bi-plus-lg me-1"></i> Add Product
    </a>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4 table-responsive">
        <table class="table table-hover align-middle mb-0" id="productsTable">
            <thead class="table-light text-uppercase text-muted" style="font-size: 0.85rem;">
                <tr>
                    <th class="fw-semibold border-0 py-3 rounded-start" style="width: 50px;">#</th>
                    <th class="fw-semibold border-0 py-3">Product</th>
                    <th class="fw-semibold border-0 py-3">Category</th>
                    <th class="fw-semibold border-0 py-3">Price</th>
                    <th class="fw-semibold border-0 py-3">Nutritional Info</th>
                    <th class="fw-semibold border-0 py-3 rounded-end text-end" style="width: 120px;">Actions</th>
                </tr>
            </thead>
            <tbody class="border-top-0">
                @forelse($products as $product)
                    <tr id="row-{{ $product->id }}">
                        <td class="text-muted">{{ $loop->iteration }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($product->image_url)
                                    <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}" width="48" height="48" class="me-3 rounded-3 shadow-sm object-fit-cover" style="object-fit: cover;" onerror="this.onerror=null; this.src='{{ asset('assets/images/default-menu.png') }}';">
                                @else
                                    <div class="bg-light me-3 rounded-3 shadow-sm d-flex justify-content-center align-items-center" style="width: 48px; height: 48px;">
                                        <i class="bi bi-image text-muted"></i>
                                    </div>
                                @endif
                                <span class="fw-semibold" style="color: var(--litebite-primary);">{{ $product->name }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border px-2 py-1">{{ $product->category ? $product->category->name : 'N/A' }}</span>
                        </td>
                        <td>
                            <span class="fw-semibold text-dark">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        </td>
                        <td>
                            <div class="d-flex flex-wrap gap-2 small">
                                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 fw-normal">C: {{ $product->carb }}g</span>
                                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 fw-normal">P: {{ $product->protein }}g</span>
                                <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 fw-normal">F: {{ $product->fat }}g</span>
                                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 fw-normal">{{ $product->calories }} kcal</span>
                            </div>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-outline-primary rounded-circle me-1" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-outline-danger rounded-circle delete-btn" title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">
                            <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                            No products found.
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
        if($('#productsTable').length) {
            $('#productsTable').DataTable({
                "responsive": true,
                "autoWidth": false,
                "dom": '<"row mb-3"<"col-md-6"l><"col-md-6"f>>rt<"row mt-3"<"col-md-6"i><"col-md-6"p>>'
            });
        }

        $('.delete-btn').click(function(e) {
            e.preventDefault();
            var form = $(this).closest('form');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                customClass: {
                    popup: 'rounded-4'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endsection
