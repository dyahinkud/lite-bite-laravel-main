@extends('layouts.frontend')

@section('title', 'About Us')

@section('content')
<!-- Hero Banner -->
<div class="container-fluid banner p-0">
  <img src="{{ asset('assets/images/aboutus1.png') }}" alt="Lite Bite About Us Banner" class="w-100 img-fluid">
</div>

<!-- About Us & Team -->
<section class="aboutus-section py-5">
  <div class="container">

    <!-- About Us Content -->
    <div class="row align-items-center mb-5">
      <div class="col-md-6 mb-4 mb-md-0">
        <img src="{{ asset('assets/images/aboutus2.png') }}" alt="Lite Bite Dish" class="img-fluid rounded shadow-sm w-100">
      </div>
      <div class="col-md-6">
        <h2 class="fw-bold mb-3">About Us</h2>
        <p>
          At <strong>Lite Bite</strong>, we’re passionate about crafting fresh, wholesome meals that
          spark joy and nourish the body. We combine quality ingredients with creative recipes to deliver
          food that’s both nutritious and irresistibly flavorful.
        </p>
        <p>
          Our cozy, welcoming spaces are designed to bring people together—whether you're
          catching up with friends, sharing lunch with family, or enjoying a moment of calm solo.
          We’re proud to serve with heart, care, and a sprinkle of flavor in every dish.
        </p>
      </div>
    </div>

    <!-- Our Team Section -->
    <div class="team-section text-center mt-5">
      <h2 class="fw-bold mb-5">Meet The Creator</h2>
      <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-4 d-flex flex-column align-items-center mb-4">
          <div class="icon-ourtim mb-3 position-relative">
            <div class="rounded-circle shadow" style="width: 180px; height: 180px; background-image: url('{{ asset('assets/images/nana2.jpeg') }}'); background-size: 105%; background-position: right center; background-repeat: no-repeat; border: 5px solid var(--litebite-accent);"></div>
          </div>
          <h4 class="fw-bold mt-2" style="color: var(--litebite-primary);">Dyah Inkud Daifatur Rahma</h4>
          <p class="text-muted fw-semibold mb-0">Web Visual Designer and Developer</p>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- Footer Banner -->
<div class="container-fluid banner2 p-0 mt-5">
  <img src="{{ asset('assets/images/aboutus3.png') }}" alt="Lite Bite Experience" class="w-100 img-fluid">
</div>
@endsection
