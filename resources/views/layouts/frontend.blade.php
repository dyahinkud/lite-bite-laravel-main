<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Lite Bite')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/styles/litebite_combined.css') }}" />
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600&display=swap" rel="stylesheet" />
    <style>
        .btn {
            transition: all 0.3s ease;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg px-3 sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <img src="{{ asset('assets/images/logo-1.png') }}" alt="Logo" width="45" height="45" class="me-2 rounded-circle shadow-sm">
                <span>Lite Bite</span>
            </a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarContent">
                <!-- Navigation Menu -->
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 nav-pills gap-1">
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active fw-bold' : '' }}" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('menu') ? 'active fw-bold' : '' }}" href="{{ route('menu') }}">Menu</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('location') ? 'active fw-bold' : '' }}" href="{{ route('location') }}">Location</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('about') ? 'active fw-bold' : '' }}" href="{{ route('about') }}">About Us</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('contact') ? 'active fw-bold' : '' }}" href="{{ route('contact') }}">Contact</a></li>
                </ul>

                <!-- Right Side: Cart & Auth -->
                <div class="d-flex align-items-center ms-lg-4 mt-3 mt-lg-0 gap-3">
                    @auth
                        @php
                            $cartItemCount = 0;
                            if(Auth::check()) {
                                $cart = \App\Models\Cart::where('user_id', Auth::id())->first();
                                $cartItemCount = $cart ? $cart->items->sum('quantity') : 0;
                            }
                        @endphp
                        <a href="{{ route('cart.index') }}" class="btn btn-outline-dark position-relative border-0 rounded-circle p-2 me-2">
                            <i class="bi bi-cart3 fs-5"></i>
                            @if($cartItemCount > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ $cartItemCount }}
                                    <span class="visually-hidden">items in cart</span>
                                </span>
                            @endif
                        </a>
                    @endauth

                    <!-- User Dropdown or Login Button -->
                    @auth
                        <div class="dropdown">
                            <button class="btn btn-custom dropdown-toggle px-4 shadow-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="display: flex; align-items: center; gap: 0.5rem;">
                                <img src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : asset('assets/images/user-default.png') }}" alt="User" class="rounded-circle" width="24" height="24" style="object-fit: cover;">
                                {{ Auth::user()->username }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-3 mt-2">
                                @if (Auth::user()->role === 'admin')
                                    <li><a class="dropdown-item py-2" href="{{ route('admin.products.index') }}"><i class="bi bi-speedometer2 me-2"></i>Admin Dashboard</a></li>
                                @else
                                    <li><a class="dropdown-item py-2" href="{{ route('dashboard') }}"><i class="bi bi-layout-text-window me-2"></i>Dashboard</a></li>
                                @endif
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger py-2"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-custom px-4 shadow-sm">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
            });
        @endif
    </script>
</body>
</html>