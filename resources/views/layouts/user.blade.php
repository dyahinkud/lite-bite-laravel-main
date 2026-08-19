<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Lite Bite</title>

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
        <a href="{{ route('home') }}" class="sidebar-logo">
            <i class="bi bi-egg-fried me-2" style="color: var(--litebite-accent);"></i> Lite Bite
        </a>
        <div class="sidebar-nav">
            <div class="d-flex align-items-center mb-4 px-3 py-2 bg-light rounded-4">
                <img src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : asset('assets/images/user-default.png') }}" alt="User" class="rounded-circle me-3 border bg-white" width="40" height="40" style="object-fit: cover;">
                <div>
                    <h6 class="mb-0 fw-bold" style="color: var(--litebite-primary);">{{ Auth::user()->username ?? 'User' }}</h6>
                    <small class="text-muted">Member</small>
                </div>
            </div>
            
            <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid"></i> Dashboard
            </a>
            <a href="{{ route('orders.index') }}" class="sidebar-link {{ request()->routeIs('orders.*') ? 'active' : '' }}">
                <i class="bi bi-receipt"></i> My Orders
            </a>
            <a href="{{ route('profile.edit') }}" class="sidebar-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                <i class="bi bi-person-gear"></i> Profile Settings
            </a>
            <hr class="my-3 text-muted">
            <a href="{{ route('home') }}" class="sidebar-link">
                <i class="bi bi-house"></i> Back to Home
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
                <a class="btn btn-light rounded-circle p-2 me-3" href="{{ route('home') }}" title="Back to Home">
                    <i class="bi bi-house-door"></i>
                </a>
                <div class="dropdown">
                    <a href="#" class="text-decoration-none text-dark d-flex align-items-center dropdown-toggle" data-bs-toggle="dropdown">
                        <img src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : asset('assets/images/user-default.png') }}" alt="User" class="rounded-circle me-2 border bg-white" width="32" height="32" style="object-fit: cover;">
                        <span class="d-none d-md-block">{{ Auth::user()->username ?? 'User' }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm mt-2 rounded-4">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="bi bi-person-gear me-2"></i> Profile Settings
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
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
