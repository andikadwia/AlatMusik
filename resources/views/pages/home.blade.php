@extends('layouts.app')

@section('title', 'Insphony - Sewa Alat Musik Modern')

@section('content')
    <!-- Hero Section -->
    <section class="hero min-h-[688px] relative bg-cover bg-center flex items-center" style="background-image: url('https://c.animaapp.com/knqlfAnT/img/image-1.png');">
        <div class="absolute inset-0 bg-black bg-opacity-60"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center text-white">
                <h1 class="font-roboto text-4xl md:text-5xl lg:text-6xl font-bold mb-5">Sewa Alat Musik Modern</h1>
                <p class="text-xl md:text-2xl mb-8">Temukan berbagai pilihan alat musik berkualitas untuk kebutuhan anda</p>
                <button class="text-white bg-primary hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg px-5 py-2.5 text-center">
                    Reservasi sekarang
                </button>
            </div>
        </div>
    </section>

    <!-- Products Section -->
<section id="produk" class="py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-semibold mb-8">Produk</h2>
        <div class="flex flex-col md:flex-row justify-between items-center p-5 bg-white rounded-lg shadow">
            <!-- Filter controls tetap sama -->
            <div class="flex-grow mr-2 mb-4 md:mb-0">
                <input type="text" placeholder="Cari alat musik..." class="bg-white-50 border border-primary text-gray-900 rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
            </div>
            <div class="w-full md:w-48 mr-2 mb-4 md:mb-0">
                <select class="bg-white-50 border border-primary text-primary rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                    <option selected>Semua Kategori</option>
                </select>
            </div>
        </div>

        <div id="products-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-10">
            @foreach($products as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>

        <div class="text-center mt-8">
            <button id="load-more-btn" class="text-primary-600 hover:text-primary-800 font-medium" data-page="2">
                Lainnya....
            </button>
            <div id="loading-spinner" class="hidden mt-4">
                <svg class="animate-spin h-5 w-5 text-primary-600 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
        </div>
    </div>
</section>

    <section id="syarat" class="py-16 bg-gradient-to-b from-[#f5f5f5] to-[#d9d9d9]">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-semibold mb-8">Syarat Reservasi</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($requirements as $requirement)
            <x-requirement-card :requirement="$requirement" />
            @endforeach
        </div>
    </div>
</section>

    <!-- Reviews Section -->
    <section id="ulasan" class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-semibold mb-8">Komentar dan Ulasan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($reviews as $review)
                    <x-review-card :review="$review" />
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="kontak" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-semibold mb-8">Kontak Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <img src="https://c.animaapp.com/knqlfAnT/img/image.png" alt="Map" class="w-full rounded-lg">
                </div>
                <div class="bg-white shadow rounded-lg p-8">
                    <h3 class="text-xl font-semibold mb-6">Informasi Kontak</h3>
                    <div class="flex items-center mb-5">
                        <img src="https://c.animaapp.com/knqlfAnT/img/geoaltfill@2x.png" alt="Address" class="w-6 h-6 mr-4">
                        <p>Jl. Ahmad Yani No. 10, Batam</p>
                    </div>
                    <div class="flex items-center mb-5">
                        <img src="https://c.animaapp.com/knqlfAnT/img/telephonefill@2x.png" alt="Phone" class="w-6 h-6 mr-4">
                        <p>+62 879732844</p>
                    </div>
                    <div class="flex items-center mb-5">
                        <img src="https://c.animaapp.com/knqlfAnT/img/envelopefill@2x.png" alt="Email" class="w-6 h-6 mr-4">
                        <p>Insphonymusik@gmail.com</p>
                    </div>
                    <div class="flex items-center">
                        <img src="https://c.animaapp.com/knqlfAnT/img/clockfill@2x.png" alt="Hours" class="w-6 h-6 mr-4">
                        <p>Senin - Jum'at: 09:00-21:00</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection