@extends('layouts.frontend')

@section('title', 'Lite Bite - Menu')

@section('content')
<!-- Menu Header -->
<div class="bg-white border-bottom shadow-sm py-5 mb-5">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-3" style="font-family: var(--litebite-font); color: var(--litebite-primary);">Our Menu</h1>
        <p class="lead text-muted mx-auto" style="max-width: 600px;">
            Pure nourishment, crafted with care.<br>
            Fresh from nature, daily.
        </p>
    </div>
</div>

<div class="container pb-5 mb-5">
    @foreach ($categories as $category)
        <div class="d-flex align-items-center gap-3 mb-4 mt-5 pb-2 border-bottom">
            <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                <i class="bi bi-{{ $category->icon ?: 'tag' }} fs-4"></i>
            </div>
            <h2 class="mb-0 fw-bold" style="font-family: var(--litebite-font); font-size: 2rem;">{{ $category->name }}</h2>
        </div>

        @if ($category->menuItems->isEmpty())
            <div class="alert alert-light bg-white shadow-sm border-0 text-center py-4 rounded-4 w-100">
                <i class="bi bi-info-circle text-muted fs-3 mb-2 d-block"></i>
                <span class="text-muted">No items available in <strong>{{ $category->name }}</strong> right now.</span>
            </div>
        @else
            <div class="row g-4">
                @foreach ($category->menuItems as $item)
                    <div class="col-12 col-md-6 col-xl-4">
                        <a href="{{ route('menu.detail', $item->id) }}" class="text-decoration-none">
                            <div class="card h-100 border-0 hover-scale" style="border-radius: 20px; overflow: hidden; background: var(--card-bg);">
                                <div class="position-relative">
                                    <div class="ratio ratio-4x3 bg-light d-flex align-items-center justify-content-center overflow-hidden p-4">
                                        <img src="{{ asset($item->image_url) }}"
                                            class="img-fluid object-fit-contain"
                                            style="transition: transform 0.5s ease;"
                                            alt="{{ $item->name }}"
                                            onmouseover="this.style.transform='scale(1.1)'"
                                            onmouseout="this.style.transform='scale(1)'">
                                    </div>
                                    <div class="position-absolute top-0 end-0 m-3">
                                        <span class="badge bg-success shadow-sm px-3 py-2 rounded-pill fs-6 fw-semibold">
                                            {{ $item->calories }} Cal
                                        </span>
                                    </div>
                                </div>
                                <div class="card-body p-4 d-flex flex-column">
                                    <h4 class="card-title fw-bold mb-2" style="color: var(--litebite-primary); font-family: var(--litebite-font);">{{ $item->name }}</h4>
                                    <p class="card-text text-muted mb-4 flex-grow-1" style="line-height: 1.6;">{!! nl2br(e($item->description)) !!}</p>

                                    <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-auto">
                                        <div class="d-flex gap-2">
                                            <span class="badge-nutrition" title="Carbs">
                                                <i class="bi bi-circle-fill text-warning me-1" style="font-size: 0.5rem;"></i>{{ $item->carb }}g
                                            </span>
                                            <span class="badge-nutrition" title="Protein">
                                                <i class="bi bi-circle-fill text-danger me-1" style="font-size: 0.5rem;"></i>{{ $item->protein }}g
                                            </span>
                                            <span class="badge-nutrition" title="Fat">
                                                <i class="bi bi-circle-fill text-info me-1" style="font-size: 0.5rem;"></i>{{ $item->fat }}g
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    @endforeach

</div>
@endsection
