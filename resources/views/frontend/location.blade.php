@extends('layouts.frontend')

@section('title', 'Locations')

@section('content')

{{-- =========================================================
    LOCATION HEADER
========================================================= --}}

<div class="location-header">

    <h2 class="location-main-title">
        Find Our Locations
    </h2>

    <div class="location-nav">

        <a href="#surabaya">Surabaya</a>
        <a href="#malang">Malang</a>
        <a href="#yogyakarta">Yogyakarta</a>
        <a href="#jabodetabek">Jabodetabek</a>
        <a href="#bali">Bali</a>

    </div>

</div>


{{-- =========================================================
    LOCATION DATA
========================================================= --}}

@php

$locations = [

    'surabaya' => [
        'title' => 'SURABAYA',
        'image' => 'loc1.jpg',

        'stores' => [

            [
                'name' => 'Galaxy Mall 1',
                'address' => 'Galaxy Mall 1, Lt 2, Kec. Mulyorejo, Surabaya',
            ],

            [
                'name' => 'PTC',
                'address' => 'Foodcourt PTC, Pakuwon Mall, Surabaya',
            ],

            [
                'name' => 'San Antonio',
                'address' => 'Jl. Kalisari Utara I No.81, Mulyorejo',
            ],

            [
                'name' => 'Citraland',
                'address' => 'Telaga Raya International Village, Citraland, Surabaya',
            ],

            [
                'name' => 'MERR',
                'address' => 'Jl. Raya Semampir No.49E, Sukolilo',
            ],

        ],
    ],


    'malang' => [

        'title' => 'MALANG',
        'image' => 'loc2.jpg',

        'stores' => [

            [
                'name' => 'Soekarno Hatta',
                'address' => 'Jl. Simpang Coklat, Lowokwaru',
            ],

            [
                'name' => 'Mall Olympic Garden',
                'address' => 'Jl. Kawi No.24, Klojen',
            ],

            [
                'name' => 'Malang Town Square',
                'address' => 'Jl. Veteran No.2, Klojen',
            ],

            [
                'name' => 'Malang City Point',
                'address' => 'Jl. Terusan Dieng No.32',
            ],

            [
                'name' => 'Mall Dinoyo City',
                'address' => 'Jl. MT. Haryono No.195',
            ],

        ],
    ],


    'yogyakarta' => [

        'title' => 'YOGYAKARTA',
        'image' => 'loc3.jpg',

        'stores' => [

            [
                'name' => 'Ambarrukmo Plaza',
                'address' => 'Jl. Laksda Adisucipto No.80',
            ],

            [
                'name' => 'Malioboro Mall',
                'address' => 'Jl. Mataram No.31',
            ],

            [
                'name' => 'Lippo Plaza Jogja',
                'address' => 'Jl. Laksda Adisucipto No.32',
            ],

        ],
    ],


    'jabodetabek' => [

        'title' => 'JABODETABEK',
        'image' => 'loc4.jpg',

        'stores' => [

            [
                'name' => 'PIK',
                'address' => 'Kamal Muara RT.7/RW.2, Jakarta Utara',
            ],

            [
                'name' => 'BSD City',
                'address' => 'Jl. Simplicity Utama No.5',
            ],

            [
                'name' => 'Summarecon Bekasi',
                'address' => 'Jl. Baru Perjuangan No.88M',
            ],

            [
                'name' => 'Bintaro Pondok Aren',
                'address' => 'Bintaro Trade Centre A2/11',
            ],

        ],
    ],


    'bali' => [

        'title' => 'BALI',
        'image' => 'loc5.jpg',

        'stores' => [

            [
                'name' => 'Denpasar Barat',
                'address' => 'Jl. Pura Demak No.69, Denpasar',
            ],

        ],
    ],

];

@endphp



{{-- =========================================================
    LOCATION SECTIONS
========================================================= --}}

@foreach ($locations as $id => $location)

<section
    id="{{ $id }}"
    class="location-section"
>

    {{-- WALLPAPER --}}

    <img
        src="{{ asset('assets/images/' . $location['image']) }}"
        alt="{{ $location['title'] }} Wallpaper"
        class="location-wallpaper"
    >


    {{-- FOG --}}

    <div class="location-overlay"></div>


    {{-- CONTENT --}}

    <div class="location-content">

        {{-- CITY TITLE --}}

        <h3 class="location-title">
            {{ $location['title'] }}
        </h3>


        {{-- LOCATION CARDS --}}

        <div class="location-grid">

            @foreach ($location['stores'] as $store)

            <div class="location-card">

                <h4>
                    {{ $store['name'] }}
                </h4>


                <p class="address">
                    {{ $store['address'] }}
                </p>


                <p class="hours">

                    <strong>Hours:</strong>

                    <br>

                    Mon - Sun | 09.00AM - 10.00PM

                </p>


                <p class="phone">

                    <i class="bi bi-telephone-fill"></i>

                    0821-7907-6890

                </p>


                <a
                    href="#"
                    target="_blank"
                >
                    Get Direction
                </a>

            </div>

            @endforeach

        </div>

    </div>

</section>

@endforeach



{{-- =========================================================
    CSS
========================================================= --}}

<style>

/* =========================================================
   GOOGLE FONT
========================================================= */

@import url(
    'https://fonts.googleapis.com/css2?family=Lobster&display=swap'
);



/* =========================================================
   PAGE BACKGROUND
========================================================= */

body {

    background-color: #fffbdc;

}



/* =========================================================
   LOCATION HEADER
========================================================= */

.location-header {

    text-align: center;

    padding: 55px 20px 65px;

    background-color: #fffbdc;

}



/* =========================================================
   MAIN TITLE
========================================================= */

.location-main-title {

    margin: 0;

    color: var(--litebite-primary);

    font-family: 'Lobster', cursive;

    font-size: 60px;

    font-weight: 400;

    line-height: 1.15;

    letter-spacing: 0;

    text-align: center;

    text-shadow:
        0 2px 0 rgba(79, 107, 34, 0.08);

}



/* =========================================================
   NAVIGATION
========================================================= */

.location-nav {

    display: flex;

    justify-content: center;

    align-items: center;

    flex-wrap: wrap;

    gap: 14px;

    margin-top: 32px;

}



.location-nav a {

    display: inline-block;

    padding: 9px 24px;

    border: 1px solid var(--litebite-primary);

    border-radius: 50px;

    color: var(--litebite-primary);

    background: transparent;

    text-decoration: none;

    font-weight: 600;

    transition: all 0.3s ease;

}



.location-nav a:hover {

    background-color: var(--litebite-primary);

    color: white;

    transform: translateY(-2px);

}



/* =========================================================
   LOCATION SECTION
========================================================= */

.location-section {

    position: relative;

    width: 92%;

    min-height: 500px;

    margin: 0 auto 45px;

    padding: 75px 40px;

    border-radius: 28px;

    overflow: hidden;

    isolation: isolate;

    background-color: #f7f3c8;

}



/* =========================================================
   WALLPAPER
========================================================= */

.location-wallpaper {

    position: absolute;

    inset: 0;

    width: 100%;

    height: 100%;

    object-fit: cover;

    object-position: center;

    filter: none;

    opacity: 1;

    transform: scale(1.02);

    z-index: -3;

}



/* =========================================================
   MAIN FOG
========================================================= */

.location-overlay {

    position: absolute;

    inset: 0;

    pointer-events: none;

    z-index: -2;

    background:

        linear-gradient(
            to bottom,
            rgba(255,255,255,0.82) 0%,
            rgba(255,255,255,0.62) 13%,
            rgba(255,255,255,0.40) 30%,
            rgba(255,255,255,0.20) 50%,
            rgba(255,255,255,0.40) 72%,
            rgba(255,255,255,0.72) 100%
        ),

        radial-gradient(
            ellipse 90% 75% at 50% 50%,
            rgba(255,255,255,0.58) 0%,
            rgba(255,255,255,0.48) 25%,
            rgba(255,255,255,0.32) 45%,
            rgba(255,255,255,0.15) 68%,
            rgba(255,255,255,0) 90%
        ),

        radial-gradient(
            ellipse 65% 80% at 0% 50%,
            rgba(255,255,255,0.80) 0%,
            rgba(255,255,255,0.58) 25%,
            rgba(255,255,255,0.30) 52%,
            rgba(255,255,255,0) 82%
        ),

        radial-gradient(
            ellipse 65% 80% at 100% 50%,
            rgba(255,255,255,0.80) 0%,
            rgba(255,255,255,0.58) 25%,
            rgba(255,255,255,0.30) 52%,
            rgba(255,255,255,0) 82%
        );

}



/* =========================================================
   EXTRA FOG
========================================================= */

.location-section::after {

    content: "";

    position: absolute;

    inset: 0;

    pointer-events: none;

    z-index: -1;

    background:

        radial-gradient(
            ellipse 45% 35% at 15% 25%,
            rgba(255,255,255,0.55) 0%,
            rgba(255,255,255,0.32) 35%,
            rgba(255,255,255,0) 75%
        ),

        radial-gradient(
            ellipse 45% 35% at 85% 30%,
            rgba(255,255,255,0.55) 0%,
            rgba(255,255,255,0.30) 35%,
            rgba(255,255,255,0) 75%
        ),

        radial-gradient(
            ellipse 55% 35% at 50% 75%,
            rgba(255,255,255,0.48) 0%,
            rgba(255,255,255,0.25) 38%,
            rgba(255,255,255,0) 78%
        );

}



/* =========================================================
   CONTENT
========================================================= */

.location-content {

    position: relative;

    z-index: 5;

    max-width: 1200px;

    margin: 0 auto;

}



/* =========================================================
   CITY TITLE
========================================================= */

.location-title {

    position: relative;

    z-index: 10;

    display: flex;

    align-items: center;

    justify-content: center;

    margin: 0 0 45px;

    text-align: center;

    color: var(--litebite-primary);

    font-family:
        Georgia,
        'Times New Roman',
        serif;

    /*
     * DIKECILKAN DARI 36px MENJADI 30px
     */

    font-size: 30px;

    /*
     * TETAP SUPER BOLD
     */

    font-weight: 900;

    letter-spacing: 2px;

    line-height: 1.2;

    text-transform: uppercase;

    -webkit-text-stroke:
        0.8px
        var(--litebite-primary);

    text-shadow:

        0 2px 0
        rgba(255,255,255,0.95),

        0 0 7px
        rgba(255,255,255,0.90);

}



/* =========================================================
   CITY TITLE LINES
========================================================= */

.location-title::before,
.location-title::after {

    content: "";

    display: block;

    width: 70px;

    height: 2px;

    flex-shrink: 0;

    background-color:
        rgba(79,107,34,0.38);

}



.location-title::before {

    margin-right: 18px;

}



.location-title::after {

    margin-left: 18px;

}



/* =========================================================
   LOCATION GRID
========================================================= */

.location-grid {

    display: grid;

    grid-template-columns:
        repeat(3, 1fr);

    gap: 20px;

}



/* =========================================================
   LOCATION CARD
========================================================= */

.location-card {

    display: flex;

    flex-direction: column;

    min-height: 260px;

    padding: 28px;

    background:
        rgba(255,255,255,0.96);

    border:
        2px solid
        var(--litebite-primary);

    border-radius: 20px;

    box-shadow:
        0 5px 18px
        rgba(67,83,35,0.12);

    transition:
        transform 0.3s ease,
        box-shadow 0.3s ease;

}



/* =========================================================
   CARD HOVER
========================================================= */

.location-card:hover {

    transform:
        translateY(-5px);

    box-shadow:
        0 12px 28px
        rgba(67,83,35,0.18);

}



/* =========================================================
   CARD TITLE
========================================================= */

.location-card h4 {

    margin-bottom: 18px;

    color: var(--litebite-primary);

    text-align: center;

    font-size: 20px;

    font-weight: 700;

    text-transform: uppercase;

}



/* =========================================================
   CARD TEXT
========================================================= */

.location-card p {

    margin-bottom: 14px;

    color: #333;

    font-size: 15px;

    line-height: 1.6;

}



.location-card .address {

    min-height: 48px;

}



/* =========================================================
   HOURS
========================================================= */

.location-card .hours {

    margin-bottom: 12px;

}



.location-card strong {

    color: #30352a;

    font-weight: 700;

}



/* =========================================================
   PHONE
========================================================= */

.location-card .phone {

    margin-bottom: 18px;

    color: #333;

}



.location-card .phone i {

    margin-right: 6px;

    color: var(--litebite-primary);

}



/* =========================================================
   BUTTON
========================================================= */

.location-card a {

    display: block;

    margin-top: auto;

    padding: 10px 20px;

    border-radius: 50px;

    background:
        var(--litebite-primary);

    color: white;

    text-align: center;

    text-decoration: none;

    font-weight: 600;

    transition:
        all 0.3s ease;

}



.location-card a:hover {

    background:
        var(--litebite-accent);

    color: white;

    transform:
        translateY(-1px);

}



/* =========================================================
   TABLET
========================================================= */

@media (max-width: 992px) {

    .location-grid {

        grid-template-columns:
            repeat(2, 1fr);

    }


    .location-title::before,
    .location-title::after {

        width: 45px;

    }

}



/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 768px) {

    .location-header {

        padding:
            40px 15px 45px;

    }


    .location-main-title {

        font-size: 43px;

    }


    .location-section {

        width: 94%;

        padding:
            55px 20px;

        border-radius: 20px;

    }


    .location-grid {

        grid-template-columns:
            1fr;

    }


    .location-title {

        font-size: 27px;

        font-weight: 900;

        -webkit-text-stroke:
            0.7px
            var(--litebite-primary);

        margin-bottom: 35px;

    }


    .location-title::before,
    .location-title::after {

        display: none;

    }

}



/* =========================================================
   SMALL MOBILE
========================================================= */

@media (max-width: 480px) {

    .location-main-title {

        font-size: 37px;

    }


    .location-nav {

        gap: 8px;

    }


    .location-nav a {

        padding:
            8px 16px;

        font-size: 14px;

    }


    .location-card {

        padding: 22px;

    }


    .location-card h4 {

        font-size: 18px;

    }


    .location-card p {

        font-size: 14px;

    }

}

</style>

@endsection