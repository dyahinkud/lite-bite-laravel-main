<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Admin - Lite Bite</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Cormorant+Garamond:wght@600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- DataTables Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/styles/litebite_combined.css') }}">
</head>
<body class="dashboard-body">
    
    <!-- Sidebar -->
    <aside class="sidebar shadow-sm" id="sidebar">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-logo">
            <i class="bi bi-egg-fried me-2" style="color: var(--litebite-accent);"></i> Lite Bite Admin
        </a>
        <div class="sidebar-nav">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="{{ route('admin.categories.index') }}" class="sidebar-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="bi bi-tags"></i> Manage Categories
            </a>
            <a href="{{ route('admin.products.index') }}" class="sidebar-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <i class="bi bi-cup-hot"></i> Manage Products
            </a>
            <a href="{{ route('admin.orders.index') }}" class="sidebar-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <i class="bi bi-bag-check"></i> Manage Orders
            </a>
            <a href="{{ route('admin.reports.index') }}" class="sidebar-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                <i class="bi bi-graph-up"></i> Sales Report
            </a>
            <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Manage Users
            </a>
        </div>
    </aside>

    <!-- Main Content Wrapper -->
    <div class="main-content" id="mainContent">
        <!-- Top Navbar -->
        <nav class="dashboard-navbar d-flex justify-content-between align-items-center sticky-top">
            <div class="d-flex align-items-center">
                <button class="btn btn-light border-0 me-3 d-md-none" id="sidebarToggle">
                    <i class="bi bi-list fs-4"></i>
                </button>
                <h5 class="mb-0 fw-bold" style="color: var(--litebite-primary);">@yield('page_title')</h5>
            </div>
            
            <div class="d-flex align-items-center">
                <div class="dropdown">
                    <a href="#" class="text-decoration-none text-dark d-flex align-items-center dropdown-toggle" data-bs-toggle="dropdown">
                        <img src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : asset('assets/images/user-default.png') }}" alt="Admin" class="rounded-circle me-2 border bg-white" width="32" height="32" style="object-fit: cover;">
                        <span class="d-none d-md-block">{{ Auth::user()->username ?? 'Admin' }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm mt-2 rounded-4">
                        <li>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="p-4 flex-grow-1">
            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="py-3 px-4 bg-white border-top mt-auto text-center text-muted small">
            &copy; {{ date('Y') }} Lite Bite. All rights reserved.
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        // Sidebar Toggle
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show');
        });

        // Alerts
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false,
                customClass: {
                    popup: 'rounded-4'
                }
            });
        @endif
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
                customClass: {
                    popup: 'rounded-4'
                }
            });
        @endif
    </script>

    @yield('scripts')
</body>
</html>
