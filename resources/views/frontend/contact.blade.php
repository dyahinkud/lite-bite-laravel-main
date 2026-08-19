@extends('layouts.frontend')

@section('title', 'Contact Us')

@section('content')
<!-- Contact Form Section -->
<div class="form-bg" style="background-image: url('{{ asset('assets/images/bg2.jpg') }}'); background-size: cover; background-position: center;">
  <div class="container py-5 content-wrapper">
    <h2 class="contact-title-wrapper text-center mb-4">Contact Us</h2>
    <div class="row justify-content-center">
      <div class="col-md-6 form-section bg-white p-4 rounded shadow">
        <form id="contactForm">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" required>
          </div>
          <div class="mb-3">
            <label for="subject" class="form-label">Subject</label>
            <input type="text" class="form-control" id="subject" required>
          </div>
          <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" id="message" rows="4" required></textarea>
          </div>
          <button type="submit" class="btn btn-order w-100" style="background-color: var(--litebite-primary); color: white;">Submit</button>
        </form>
        <div id="contactResponse" class="alert alert-success mt-4 d-none" role="alert">
          Thank you! Your message has been sent successfully.
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Marquee -->
<div class="top-marquee bg-dark text-white py-2 overflow-hidden">
  <div class="marquee-content d-inline-block" style="white-space: nowrap; animation: marquee 15s linear infinite;">
    Nourish your body, delight your taste buds – healthy eating reimagined for modern lifestyles. Order now!
  </div>
</div>

<style>
  @keyframes marquee {
    0% { transform: translateX(100vw); }
    100% { transform: translateX(-100%); }
  }
</style>

<!-- Contact Info Section -->
<div class="contact-footer py-5" style="background-color: #f9f8f4;">
  <div class="container d-flex flex-column flex-md-row justify-content-between align-items-start">
    <div class="mb-4 mb-md-0 text-center text-md-start">
      <img src="{{ asset('assets/images/logo3.png') }}" alt="Lite Bite Logo" style="height: 120px;">
    </div>

    <div class="mb-4 mb-md-0">
      <h5 class="fw-bold mb-3" style="color: var(--litebite-primary);">CONNECT WITH US</h5>
      <p class="mb-2"><i class="bi bi-instagram me-2"></i> @Lite_Bite.id</p>
      <p class="mb-2"><i class="bi bi-whatsapp me-2"></i> 0812-78994-5299 (Customer Care)</p>
      <p class="mb-0"><i class="bi bi-envelope me-2"></i> green@litebite.id</p>
    </div>

    <div>
      <h5 class="fw-bold mb-3 text-center text-md-start" style="color: var(--litebite-primary);">ORDER ONLINE</h5>
      <div class="d-flex gap-3 justify-content-center justify-content-md-start">
        <img src="{{ asset('assets/images/grabfood.png') }}" alt="GrabFood" style="height: 40px; width: auto; object-fit: contain;">
        <img src="{{ asset('assets/images/gofood.png') }}" alt="GoFood" style="height: 40px; width: auto; object-fit: contain;">
        <img src="{{ asset('assets/images/shopeefood.png') }}" alt="ShopeeFood" style="height: 40px; width: auto; object-fit: contain;">
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById("contactForm").addEventListener("submit", function(e) {
    e.preventDefault();
    document.getElementById("contactResponse").classList.remove("d-none");
    this.reset();
  });
</script>
@endsection
