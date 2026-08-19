@extends('layouts.admin')

@section('title', 'Manage Categories')
@section('page_title', 'Manage Categories')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-0" style="color: var(--litebite-primary);">Manage Categories</h3>
        <p class="text-muted mb-0">View, edit, or delete meal categories.</p>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="btn text-white rounded-pill px-4 shadow-sm" style="background-color: var(--litebite-primary);">
        <i class="bi bi-plus-lg me-1"></i> Add Category
    </a>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4 table-responsive">
        <table class="table table-hover align-middle mb-0" id="categoriesTable">
            <thead class="table-light text-uppercase text-muted" style="font-size: 0.85rem;">
                <tr>
                    <th class="fw-semibold border-0 py-3 rounded-start" style="width: 50px;">#</th>
                    <th class="fw-semibold border-0 py-3">Category Name</th>
                    <th class="fw-semibold border-0 py-3">Slug</th>
                    <th class="fw-semibold border-0 py-3">Icon</th>
                    <th class="fw-semibold border-0 py-3">Products Count</th>
                    <th class="fw-semibold border-0 py-3 rounded-end text-end" style="width: 120px;">Actions</th>
                </tr>
            </thead>
            <tbody class="border-top-0">
                @forelse($categories as $category)
                    <tr id="row-{{ $category->id }}">
                        <td class="text-muted">{{ $loop->iteration }}</td>
                        <td>
                            <span class="fw-semibold" style="color: var(--litebite-primary);">{{ $category->name }}</span>
                        </td>
                        <td>{{ $category->slug }}</td>
                        <td>
                            @if($category->icon)
                                <i class="bi bi-{{ $category->icon }} fs-4 text-muted"></i> ({{ $category->icon }})
                            @else
                                <span class="text-muted">None</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border px-2 py-1">{{ $category->menuItems()->count() }} items</span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-outline-primary rounded-circle me-1" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline delete-form">
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
                        <td colspan="6" class="text-center py-4 text-muted">
                            <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                            No categories found.
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
        if($('#categoriesTable').length) {
            $('#categoriesTable').DataTable({
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
