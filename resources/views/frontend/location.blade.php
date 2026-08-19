@extends('layouts.frontend')

@section('title', 'Locations')

@section('content')
<div class="container text-center py-5">
    <h2 class="section-title fw-bold" style="color: var(--litebite-primary);">Find Our Locations</h2>
    <div class="location-nav d-flex justify-content-center flex-wrap gap-3 mt-4">
        <a href="#surabaya" class="btn btn-outline-success rounded-pill px-4">Surabaya</a>
        <a href="#malang" class="btn btn-outline-success rounded-pill px-4">Malang</a>
        <a href="#yogyakarta" class="btn btn-outline-success rounded-pill px-4">Yogyakarta</a>
        <a href="#jabodetabek" class="btn btn-outline-success rounded-pill px-4">Jabodetabek</a>
        <a href="#bali" class="btn btn-outline-success rounded-pill px-4">Bali</a>
    </div>
</div>

@php
function renderLocationSection($id, $title, $locations)
{
    echo "<section id='$id' class='location-section py-5' style='background-color: #f9f8f4;'>";
    echo "<div class='container'>";
    echo "<h3 class='text-center fw-bold mb-4' style='color: var(--litebite-primary);'>$title</h3>";
    echo "<div class='row g-4'>";
    foreach ($locations as $loc) {
        echo "<div class='col-md-6 col-lg-4'>
          <div class='location-card p-4 h-100 bg-white rounded shadow-sm' style='border-top: 4px solid var(--litebite-accent);'>
            <h5 class='fw-bold mb-3' style='color: var(--litebite-primary);'>{$loc['name']}</h5>
            <p class='mb-2 text-muted'>{$loc['address']}</p>
            <p class='mb-2 text-muted'><strong>Hours:</strong><br>{$loc['hours']}</p>
            <p class='mb-4 text-muted'><i class='bi bi-telephone-fill me-2'></i>{$loc['phone']}</p>
            <a href='{$loc['map_url']}' class='btn w-100 rounded-pill' style='background-color: var(--litebite-primary); color: white;' target='_blank'>Get Direction</a>
          </div>
        </div>";
    }
    echo "</div></div></section>";
}

// -- SURABAYA LOCATIONS
$surabaya = [
    ["name" => "Galaxy Mall 1", "address" => "Galaxy Mall 1, Lt 2, Kec. Mulyorejo, Surabaya", "hours" => "Mon - Sun | 09.00AM - 10.00PM", "phone" => "0821-7907-6890", "map_url" => "#"],
    ["name" => "PTC", "address" => "Foodcourt PTC, Pakuwon Mall, Surabaya", "hours" => "Mon - Sun | 09.00AM - 10.00PM", "phone" => "0821-7907-6890", "map_url" => "#"],
    ["name" => "San Antonio", "address" => "Jl. Kalisari Utara I No.81, Mulyorejo", "hours" => "Mon - Sun | 09.00AM - 10.00PM", "phone" => "0821-7907-6890", "map_url" => "#"],
    ["name" => "Citraland", "address" => "Telaga Raya International Village, Citraland, Surabaya", "hours" => "Mon - Sun | 09.00AM - 10.00PM", "phone" => "0821-7907-6890", "map_url" => "#"],
    ["name" => "MERR", "address" => "Jl. Raya Semampir No.49E, Sukolilo", "hours" => "Mon - Sun | 09.00AM - 10.00PM", "phone" => "0821-7907-6890", "map_url" => "#"]
];

// -- MALANG LOCATIONS
$malang = [
    ["name" => "Soekarno Hatta", "address" => "Jl. Simpang Coklat, Lowokwaru", "hours" => "Mon - Sun | 09.00AM - 10.00PM", "phone" => "0821-7907-6890", "map_url" => "#"],
    ["name" => "Mall Olympic Garden", "address" => "Jl. Kawi No.24, Klojen", "hours" => "Mon - Sun | 09.00AM - 10.00PM", "phone" => "0821-7907-6890", "map_url" => "#"],
    ["name" => "Malang Town Square", "address" => "Jl. Veteran No.2, Klojen", "hours" => "Mon - Sun | 09.00AM - 10.00PM", "phone" => "0821-7907-6890", "map_url" => "#"],
    ["name" => "Malang City Point", "address" => "Jl. Terusan Dieng No.32", "hours" => "Mon - Sun | 09.00AM - 10.00PM", "phone" => "0821-7907-6890", "map_url" => "#"],
    ["name" => "Mall Dinoyo City", "address" => "Jl. MT. Haryono No.195", "hours" => "Mon - Sun | 09.00AM - 10.00PM", "phone" => "0821-7907-6890", "map_url" => "#"]
];

// -- YOGYAKARTA LOCATIONS
$jogja = [
    ["name" => "Ambarrukmo Plaza", "address" => "Jl. Laksda Adisucipto No.80", "hours" => "Mon - Sun | 09.00AM - 10.00PM", "phone" => "0821-7907-6890", "map_url" => "#"],
    ["name" => "Malioboro Mall", "address" => "Jl. Mataram No.31", "hours" => "Mon - Sun | 09.00AM - 10.00PM", "phone" => "0821-7907-6890", "map_url" => "#"],
    ["name" => "Lippo Plaza Jogja", "address" => "Jl. Laksda Adisucipto No.32", "hours" => "Mon - Sun | 09.00AM - 10.00PM", "phone" => "0821-7907-6890", "map_url" => "#"]
];

// -- JABODETABEK LOCATIONS
$jabodetabek = [
    ["name" => "PIK", "address" => "Kamal Muara RT.7/RW.2, Jakarta Utara", "hours" => "Mon - Sun | 09.00AM - 10.00PM", "phone" => "0821-7907-6890", "map_url" => "#"],
    ["name" => "BSD City", "address" => "Jl. Simplicity Utama No.5", "hours" => "Mon - Sun | 09.00AM - 10.00PM", "phone" => "0821-7907-6890", "map_url" => "#"],
    ["name" => "Summarecon Bekasi", "address" => "Jl. Baru Perjuangan No.88M", "hours" => "Mon - Sun | 09.00AM - 10.00PM", "phone" => "0821-7907-6890", "map_url" => "#"],
    ["name" => "Bintaro Pondok Aren", "address" => "Bintaro Trade Centre A2/11", "hours" => "Mon - Sun | 09.00AM - 10.00PM", "phone" => "0821-7907-6890", "map_url" => "#"]
];

// -- BALI LOCATIONS
$bali = [
    ["name" => "Denpasar Barat", "address" => "Jl. Pura Demak No.69, Denpasar", "hours" => "Mon - Sun | 09.00AM - 10.00PM", "phone" => "0821-7907-6890", "map_url" => "#"]
];
@endphp

<style>
    .location-nav a:hover, .location-nav a:active {
        background-color: var(--litebite-primary) !important;
        color: white !important;
        border-color: var(--litebite-primary) !important;
    }
    .location-nav a {
        color: var(--litebite-primary);
        border-color: var(--litebite-primary);
    }
</style>

@php
// Render sections
renderLocationSection('surabaya', 'Surabaya', $surabaya);
renderLocationSection('malang', 'Malang', $malang);
renderLocationSection('yogyakarta', 'Yogyakarta', $jogja);
renderLocationSection('jabodetabek', 'Jabodetabek', $jabodetabek);
renderLocationSection('bali', 'Bali', $bali);
@endphp

@endsection
