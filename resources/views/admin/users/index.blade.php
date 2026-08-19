@extends('layouts.admin')

@section('title', 'Manage Users')
@section('page_title', 'Manage Users')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-0" style="color: var(--litebite-primary);">Manage Users</h3>
        <p class="text-muted mb-0">View, edit, or delete users.</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="btn text-white rounded-pill px-4 shadow-sm" style="background-color: var(--litebite-primary);">
        <i class="bi bi-plus-lg me-1"></i> Add New User
    </a>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4 table-responsive">
        <table class="table table-hover align-middle mb-0" id="usersTable">
            <thead class="table-light text-uppercase text-muted" style="font-size: 0.85rem;">
                <tr>
                    <th class="fw-semibold border-0 py-3 rounded-start">#</th>
                    <th class="fw-semibold border-0 py-3">Username</th>
                    <th class="fw-semibold border-0 py-3">Email</th>
                    <th class="fw-semibold border-0 py-3">Role</th>
                    <th class="fw-semibold border-0 py-3">Registered At</th>
                    <th class="fw-semibold border-0 py-3 rounded-end text-end" style="width: 150px;">Actions</th>
                </tr>
            </thead>
            <tbody class="border-top-0">
                @forelse ($users as $user)
                    <tr>
                        <td class="text-muted">{{ $loop->iteration }}</td>
                        <td class="fw-semibold" style="color: var(--litebite-primary);">{{ $user->username }}</td>
                        <td class="text-muted">{{ $user->email }}</td>
                        <td>
                            @if ($user->role === 'admin')
                                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-2 py-1 rounded-pill">Admin</span>
                            @else
                                <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 px-2 py-1 rounded-pill">User</span>
                            @endif
                        </td>
                        <td class="text-muted small">{{ $user->created_at->format('d M Y H:i') }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-primary rounded-circle me-1" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline delete-form">
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
                            No users found.
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
        if($('#usersTable').length) {
            $('#usersTable').DataTable({
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
