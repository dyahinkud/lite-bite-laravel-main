@extends('layouts.frontend')

@section('title', 'Lite Bite - Home')

@section('content')
<!-- Hero Banner -->
<section class="hero-banner position-relative overflow-hidden shadow-sm" style="min-height: 500px; display: flex; align-items: center;">
    <div class="position-absolute top-0 start-0 w-100 h-100"
         style="background-image: url('{{ asset('assets/images/aboutus2.png') }}'); background-size: cover; background-position: center; opacity: 0.3; z-index: 0; mix-blend-mode: overlay;">
    </div>

    <div class="hero-content position-relative z-1 text-center w-100" style="padding: 3rem;">
        <h1 class="fw-bold display-3 mb-3" style="font-family: var(--litebite-font); letter-spacing: -1px; color: var(--litebite-accent); text-shadow: 0 2px 10px rgba(0,0,0,0.5);">Welcome to Lite Bite</h1>
        <p class="lead fs-4 mb-4 fw-light" style="color: #ffffff; text-shadow: 0 2px 5px rgba(0,0,0,0.5);">Where freshness meets flavor every day</p>
        <a href="{{ route('menu') }}" class="btn btn-light rounded-pill px-5 py-3 fw-bold mt-2 shadow-lg" style="color: var(--litebite-primary); transition: all 0.3s ease;">
            Explore Menu
        </a>
    </div>
</section>

<!-- Menu Section -->
<section class="py-5" id="menu" style="background-color: var(--body-bg);">
    <div class="container py-4">
        <h2 class="text-center mb-2 section-title">Our Signature Menu</h2>
        <p class="text-center text-muted mb-5 pb-2">Discover our most loved dishes, prepared fresh daily.</p>

        @if ($menu_items->count() > 0)
            <div class="scrolling-wrapper px-2 py-4">
                @foreach ($menu_items as $item)
                    <div class="menu-card" style="min-width: 320px;">
                        <div class="text-center">
                            <img src="{{ asset($item->image_url) }}"
                                 alt="Picture of {{ $item->name }}"
                                 onerror="this.onerror=null; this.src='{{ asset('assets/images/default-menu.png') }}';">
                        </div>
                        <div class="text-center d-flex flex-column justify-content-start mt-2">
                            <h5 class="fw-bold fs-4 mb-3" style="color: var(--litebite-primary); font-family: var(--litebite-font);">{{ $item->name }}</h5>
                            <p class="menu-description">{!! nl2br(e($item->description)) !!}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5 bg-white rounded-4 shadow-sm">
                <i class="bi bi-emoji-frown display-1 text-muted opacity-50"></i>
                <h4 class="mt-4 text-muted">No menu items found</h4>
                <p class="text-muted mb-0">Please check back later, we're updating our menu!</p>
            </div>
        @endif

        <div class="text-center mt-5 pt-3">
            <a href="{{ route('menu') }}" class="btn btn-custom btn-lg">VIEW FULL MENU</a>
        </div>
    </div>
</section>
@endsection
