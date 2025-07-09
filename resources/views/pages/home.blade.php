@extends('layouts.app')

@section('title', 'Insphony - Sewa Alat Musik Modern')

@section('content')
    <!-- Hero Section with Sequential Animation -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-cover bg-center" 
                style="background-image: url('https://c.animaapp.com/knqlfAnT/img/image-1.png')"
                data-aos="fade-in" 
                data-aos-duration="1000">
        
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/50 to-black/80">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxkZWZzPjxwYXR0ZXJuIGlkPSJtdXNpY1dhdmUiIHBhdHRlcm5Vbml0cz0idXNlclNwYWNlT25Vc2UiIHdpZHRoPSIxMDAiIGhlaWdodD0iMTAwIj48cGF0aCBkPSJNMCA1MCBRIDI1IDAgNTAgNTAgVCAxMDAgNTAiIHN0cm9rZT0icmdiYSgyNTUsMjU1LDI1NSwwLjA1KSIgc3Ryb2tlLXdpZHRoPSIyIiBmaWxsPSJub25lIi8+PC9wYXR0ZXJuPjwvZGVmcz48cmVjdCB4PSIwIiB5PSIwIiB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSJ1cmwoI211c2ljV2F2ZSkiIG9wYWNpdHk9IjAuNSIvPjwvc3ZnPg==')] 
                        opacity-20 animate-[wave_60s_linear_infinite]"></div>
        </div>
        
        <!-- Floating Music Elements (Smaller) -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute text-white/10 text-5xl animate-[float_18s_ease-in-out_infinite] left-[15%] top-[20%]">
                <span class="drop-shadow-[0_0_8px_rgba(160,137,99,0.3)]">🎸</span>
            </div>
            <div class="absolute text-white/15 text-3xl animate-[float_14s_ease-in-out_infinite_2s] left-[80%] top-[30%]">
                <span class="drop-shadow-[0_0_5px_rgba(160,137,99,0.2)]">♫</span>
            </div>
            <div class="absolute text-white/10 text-4xl animate-[float_20s_ease-in-out_infinite_3s] left-[70%] top-[70%]">
                <span class="drop-shadow-[0_0_8px_rgba(160,137,99,0.3)]">🎹</span>
            </div>
        </div>
        
        <!-- Content Container -->
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center text-white space-y-6">
                <!-- Title -->
                <h1 class="text-4xl md:text-5xl font-bold" data-aos="fade-down" data-aos-delay="300">
                    <span class="inline-block bg-clip-text text-transparent bg-gradient-to-r from-[#a08963] via-[#d9d9d9] to-[#a08963] animate-[text-gradient_6s_linear_infinite] bg-[length:300%_auto] tracking-tight">
                        Sewa Alat Musik Modern
                    </span>
                </h1>

                <!-- Subtitle -->
                <div class="h-16 flex items-center justify-center">
                    <p class="text-lg md:text-xl max-w-2xl mx-auto font-light" 
                        data-aos="fade-up" 
                        data-aos-delay="500"
                        style="text-shadow: 0 2px 4px rgba(0,0,0,0.3)">
                        Temukan berbagai pilihan alat musik berkualitas untuk kebutuhan kreativitas Anda
                    </p>
                </div>

                <!-- Button -->
                <div data-aos="zoom-in" data-aos-delay="700">
                    <button id="reservationBtn" class="reservation-btn relative overflow-hidden group text-white font-medium rounded-full px-8 py-3 text-base"
                        style="background: linear-gradient(135deg, #a08963 0%, #c5a876 50%, #a08963 100%);">
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            Reservasi Sekarang
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform duration-300 group-hover:translate-x-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-[#b79b76] to-[#7a6247] opacity-0 group-hover:opacity-100 transition-opacity duration-300 mix-blend-overlay"></div>
                    </button>
                </div>
            </div>
        </div>

        <!-- Scroll Down Indicator -->
        <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2" data-aos="fade-up" data-aos-delay="900">
            <div class="flex flex-col items-center">
                <span class="text-white/80 text-xs mb-1 tracking-wider">SCROLL</span>
                <div class="animate-[bounce_2s_infinite]">
                    <svg class="w-6 h-6 text-white drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Section -->
    <section id="produk" class="py-12 sm:py-16 bg-gradient-to-b from-gray-100 to-gray-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-4" data-aos="fade-up" data-aos-delay="300">Produk Kami</h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="300">Berbagai jenis alat musik berkualitas tinggi siap memenuhi kebutuhan kreativitas Anda</p>
            </div>

            <!-- Filter Form -->
            <div class="mb-12" data-aos="fade-up" data-aos-delay="400">
                <form id="filter-form" class="bg-white rounded-xl shadow-lg p-5 sm:p-6 border border-gray-100">
                    <div class="flex flex-col sm:flex-row gap-4 items-end">
                        <!-- Search Input -->
                        <div class="flex-grow w-full">
                            <label for="search-input" class="block mb-2 text-sm font-medium text-gray-700">Cari Alat Musik</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-earth-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" name="search" id="search-input" value="{{ $search ?? '' }}" 
                                    placeholder="Gitar, drum, piano..." 
                                    class="w-full pl-10 pr-4 py-2.5 border border-earth-300 text-gray-900 rounded-lg focus:ring-2 focus:ring-earth-500 focus:border-earth-500 transition-all duration-200 placeholder-gray-400">
                            </div>
                        </div>

                        <!-- Category Select -->
                        <div class="w-full sm:w-56">
                            <label for="category-select" class="block mb-2 text-sm font-medium text-gray-700">Kategori</label>
                            <div class="relative">
                                <select name="category" id="category-select" 
                                        class="appearance-none w-full p-2.5 pl-3 pr-8 border border-earth-300 text-earth-700 bg-white rounded-lg focus:ring-2 focus:ring-earth-500 focus:border-earth-500 transition-all duration-200">
                                    <option value="">Semua Kategori</option>
                                    <option value="Elektrofon" {{ (isset($category) && $category == 'Elektrofon') ? 'selected' : '' }}>Elektrofon</option>
                                    <option value="Aerofon" {{ (isset($category) && $category == 'Aerofon') ? 'selected' : '' }}>Aerofon</option>
                                    <option value="Kordofon" {{ (isset($category) && $category == 'Kordofon') ? 'selected' : '' }}>Kordofon</option>
                                    <option value="Idiofon" {{ (isset($category) && $category == 'Idiofon') ? 'selected' : '' }}>Idiofon</option>
                                    <option value="Membranofon" {{ (isset($category) && $category == 'Membranofon') ? 'selected' : '' }}>Membranofon</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-earth-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Products Grid -->
            <div id="products-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($products as $index => $product)
                    <div data-aos="fade-up" data-aos-delay="{{ 400 + ($index * 100) }}">
                        <x-product-card :product="$product" />
                    </div>
                @endforeach
            </div>

            <!-- Load More Button -->
            @if($products->count() >= 6)
                <div class="text-center mt-10" data-aos="fade-up" data-aos-delay="{{ 500 + (count($products) * 50) }}">
                    <button id="load-more-btn" data-offset="6" 
                            class="px-6 py-2 border border-earth-500 text-earth-600 font-medium rounded-lg hover:bg-earth-50 hover:shadow-md transition-all">
                        Tampilkan Lainnya
                    </button>
                    <div id="loading-spinner" class="hidden mt-4">
                        <svg class="animate-spin h-5 w-5 text-earth-600 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Requirements Section -->
    <section id="syarat" class="py-12 sm:py-16 bg-gradient-to-b from-gray-100 to-gray-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-4" data-aos="fade-up" data-aos-delay="300">Prosedur & Persyaratan Sewa</h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="300">Dengan menggunakan layanan Insphony, Anda setuju untuk mematuhi seluruh ketentuan berikut:</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($requirements as $index => $requirement)
                    <div data-aos="fade-up" data-aos-delay="{{ 400 + ($index * 100) }}">
                        <x-requirement-card :requirement="$requirement" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    
   <!-- Reviews Section -->
<section id="ulasan" class="py-12 sm:py-16 bg-gradient-to-b from-gray-100 to-gray-100">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-4" data-aos="fade-up" data-aos-delay="100">Mengapa Memilih Kami?</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">Kami menawarkan pengalaman penyewaan alat musik yang mudah dan terpercaya</p>
        </div>
        
        @if(count($reviews) > 0)
            <div class="relative mx-auto max-w-7xl" data-aos="fade-up" data-aos-delay="300">
                <!-- Carousel Container -->
                <div class="overflow-hidden px-4">
                    <div id="review-carousel" class="flex transition-transform duration-500 ease-in-out pb-4">
                        @foreach($reviews as $review)
                            <div class="w-full sm:w-1/2 lg:w-1/3 px-3 flex-shrink-0" data-aos="fade-up" data-aos-delay="{{ 400 + ($loop->index * 100) }}">
                                <x-review-card :review="$review" class="h-full" />
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- Navigation Arrows -->
                <button id="prev-review" class="absolute -left-4 top-1/2 -translate-y-1/2 -translate-x-4 bg-white p-3 rounded-full shadow-md hover:bg-gray-50 transition-colors z-10 hidden sm:block" data-aos="fade-right" data-aos-delay="500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#8a7552]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button id="next-review" class="absolute -right-4 top-1/2 -translate-y-1/2 translate-x-4 bg-white p-3 rounded-full shadow-md hover:bg-gray-50 transition-colors z-10 hidden sm:block" data-aos="fade-left" data-aos-delay="500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#8a7552]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
            
            <!-- Dots Indicator -->
            <div class="flex justify-center mt-6 space-x-2" data-aos="fade-up" data-aos-delay="600">
                @foreach($reviews as $index => $review)
                    <button class="review-dot w-3 h-3 rounded-full bg-gray hover:bg-gray-400 transition-colors {{ $index === 0 ? 'bg-gray-600' : '' }}"
                            data-index="{{ $index }}" data-aos="fade-up" data-aos-delay="{{ 600 + ($index * 50) }}"></button>
                @endforeach
            </div>
        @else
            <div class="text-center py-12 bg-white rounded-lg shadow-sm max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">Belum ada ulasan</h3>
                <p class="mt-1 text-gray-500">Jadilah yang pertama memberikan ulasan</p>
            </div>
        @endif
    </div>
</section>

    <!-- Contact Section -->
    <section id="kontak" class="py-16 bg-gradient-to-b from-gray-100 to-gray-100">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up" data-aos-delay="300">
                <h2 class="text-4xl font-semibold mb-4">Kontak Kami</h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">Silakan hubungi kami untuk informasi lebih lanjut atau pemesanan</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Map Section -->
                <div class="h-full" data-aos="fade-right" data-aos-delay="400">
                    <div class="rounded-xl overflow-hidden shadow-lg h-full border border-gray-200 hover:shadow-xl transition-shadow duration-300">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5360.296427177568!2d104.04588167613073!3d1.118720498870545!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d98921856ddfab%3A0xf9d9fc65ca00c9d!2sPoliteknik%20Negeri%20Batam!5e1!3m2!1sen!2sid!4v1750124900396!5m2!1sen!2sid"
                            class="w-full h-full min-h-[400px]"
                            allowfullscreen="" 
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
                
                <!-- Contact Info Section -->
                <div class="bg-white shadow-lg rounded-xl p-8 border border-gray-200 hover:shadow-xl transition-shadow duration-300" data-aos="fade-left" data-aos-delay="400">
                    <h3 class="text-xl font-semibold mb-6 pb-2 border-b border-gray-200">Informasi Kontak</h3>
                    
                    <div class="space-y-5">
                        <!-- Address -->
                        <div class="flex items-start group" data-aos="fade-left" data-aos-delay="500">
                            <div class="bg-gray-100 p-2 rounded-lg mr-4 group-hover:bg-gray-200 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-700">Alamat</h4>
                                <p class="text-gray-600">Jl. Ahmad Yani No. 10, Batam</p>
                            </div>
                        </div>
                        
                        <!-- Phone -->
                        <div class="flex items-start group" data-aos="fade-left" data-aos-delay="600">
                            <div class="bg-gray-100 p-2 rounded-lg mr-4 group-hover:bg-gray-200 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-700">Telepon/WhatsApp</h4>
                                <a href="https://wa.me/62879732844" class="text-gray-600 hover:text-gray-800 transition-colors">+62 879732844</a>
                            </div>
                        </div>
                        
                        <!-- Email -->
                        <div class="flex items-start group" data-aos="fade-left" data-aos-delay="700">
                            <div class="bg-gray-100 p-2 rounded-lg mr-4 group-hover:bg-gray-200 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-700">Email</h4>
                                <a href="mailto:Insphonymusik@gmail.com" class="text-gray-600 hover:text-gray-800 transition-colors">Insphonymusik@gmail.com</a>
                            </div>
                        </div>
                        
                        <!-- Hours -->
                        <div class="flex items-start group" data-aos="fade-left" data-aos-delay="800">
                            <div class="bg-gray-100 p-2 rounded-lg mr-4 group-hover:bg-gray-200 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-700">Jam Operasional</h4>
                                <p class="text-gray-600">Senin - Jum'at: 09:00-21:00</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Fungsi untuk memuat produk dengan filter
        function loadProducts(resetOffset = true) {
            const search = document.getElementById('search-input').value;
            const category = document.getElementById('category-select').value;
            const offset = resetOffset ? 0 : parseInt(document.getElementById('load-more-btn')?.dataset.offset || 0);
            
            const spinner = document.getElementById('loading-spinner');
            const loadMoreBtn = document.getElementById('load-more-btn');
            
            if (resetOffset) {
                spinner?.classList.remove('hidden');
                loadMoreBtn?.classList.add('hidden');
            } else {
                loadMoreBtn?.classList.add('hidden');
                spinner?.classList.remove('hidden');
            }
            
            // Buat URL dengan parameter pencarian dan kategori
            let url = `/load-more?offset=${offset}`;
            if (search) url += `&search=${encodeURIComponent(search)}`;
            if (category) url += `&category=${encodeURIComponent(category)}`;
            
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (resetOffset) {
                        document.getElementById('products-container').innerHTML = data.html;
                    } else {
                        document.getElementById('products-container').insertAdjacentHTML('beforeend', data.html);
                    }
                    
                    if (loadMoreBtn) {
                        loadMoreBtn.dataset.offset = offset + 6;
                        
                        if(data.count < 6) {
                            loadMoreBtn.style.display = 'none';
                        } else {
                            loadMoreBtn.style.display = 'inline-block';
                        }
                    }
                    
                    spinner?.classList.add('hidden');
                    loadMoreBtn?.classList.remove('hidden');
                    
                    // Initialize AOS for newly loaded items
                    AOS.refresh();
                })
                .catch(error => {
                    console.error('Error:', error);
                    spinner?.classList.add('hidden');
                    loadMoreBtn?.classList.remove('hidden');
                });
        }
        
        // Debounce function untuk optimasi performa
        function debounce(func, timeout = 500) {
            let timer;
            return (...args) => {
                clearTimeout(timer);
                timer = setTimeout(() => { func.apply(this, args); }, timeout);
            };
        }
        
        // Event listener untuk pencarian otomatis dengan debounce
        document.getElementById('search-input').addEventListener('input', debounce(() => {
            loadProducts(true);
        }));
        
        // Event listener untuk perubahan kategori
        document.getElementById('category-select').addEventListener('change', () => {
            loadProducts(true);
        });
        
        // Event listener untuk tombol load more
        document.getElementById('load-more-btn')?.addEventListener('click', () => {
            loadProducts(false);
        });
        
        // Inisialisasi AOS
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 600,
                easing: 'ease-out-cubic',
                offset: 120,
            });

            // Refresh AOS setelah konten dimuat
            window.addEventListener('load', function() {
                AOS.refresh();
            });
        });
    </script>
    <script>
        // Animasi tombol reservasi
        document.getElementById('reservationBtn')?.addEventListener('click', function(e) {
            // Ripple effect
            const btn = e.currentTarget;
            const circle = document.createElement("span");
            const diameter = Math.max(btn.clientWidth, btn.clientHeight);
            const radius = diameter / 2;
            
            circle.style.width = circle.style.height = `${diameter}px`;
            circle.style.left = `${e.clientX - (btn.getBoundingClientRect().left + radius)}px`;
            circle.style.top = `${e.clientY - (btn.getBoundingClientRect().top + radius)}px`;
            circle.classList.add("ripple");
            
            const ripple = btn.getElementsByClassName("ripple")[0];
            if (ripple) {
                ripple.remove();
            }
            
            btn.appendChild(circle);
            
            // Smooth scroll to produk section
            setTimeout(() => {
                document.getElementById('produk').scrollIntoView({ 
                    behavior: 'smooth' 
                });
            }, 300);
            
            // Animasi tekan
            btn.style.transform = 'scale(0.96)';
            setTimeout(() => {
                btn.style.transform = '';
            }, 150);
        });
    </script>

    <style>
        /* Animasi yang sudah ada... */
        @keyframes gradient-x {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        @keyframes float {
            0%, 100% { 
                transform: translateY(0) rotate(0deg) scale(1); 
            }
            50% { 
                transform: translateY(-50px) rotate(5deg) scale(1.1); 
            }
        }
        
        @keyframes wave {
            0% { background-position-x: 0%; }
            100% { background-position-x: 100%; }
        }
            
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes text-gradient {
            0% { background-position: 0% center; }
            100% { background-position: 200% center; }
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-15px); }
            60% { transform: translateY(-7px); }
        }

        /* Animasi baru untuk tombol reservasi */
        @keyframes pulse-gold {
            0%, 100% { box-shadow: 0 0 0 0 rgba(192, 161, 107, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(192, 161, 107, 0); }
        }

        @keyframes float-btn {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }

        .reservation-btn {
            animation: float-btn 6s ease-in-out infinite;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .reservation-btn:hover {
            animation: pulse-gold 1.5s infinite, float-btn 6s ease-in-out infinite;
            transform: translateY(-3px) scale(1.02);
        }

        .reservation-btn:active {
            transform: scale(0.96);
        }

        .reservation-btn::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, 
                rgba(255,255,255,0.1) 0%, 
                rgba(255,255,255,0.3) 50%, 
                rgba(255,255,255,0.1) 100%);
            background-size: 200% auto;
            opacity: 0;
            transition: opacity 0.3s ease, background-position 0.5s ease;
        }

        .reservation-btn:hover::after {
            opacity: 1;
            animation: shine 1.5s infinite;
        }

        @keyframes shine {
            0% { background-position: -100% center; }
            100% { background-position: 100% center; }
        }

        /* Ripple effect */
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255,255,255,0.8) 0%, rgba(255,255,255,0) 70%);
            transform: scale(0);
            animation: ripple 0.6s linear;
            pointer-events: none;
        }
        
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        [data-aos] {
            transition-property: transform, opacity;
            will-change: transform, opacity;
        }
        
        /* Animasi khusus untuk kartu produk */
        .product-card-enter {
            opacity: 0;
            transform: translateY(20px);
        }
        .product-card-enter-active {
            opacity: 1;
            transform: translateY(0);
            transition: all 600ms cubic-bezier(0.215, 0.61, 0.355, 1);
        }
        
        /* Efek hover */
        .hover-scale {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-scale:hover {
            transform: scale(1.02);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
    </style>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById('review-carousel')) {
            const carousel = document.getElementById('review-carousel');
            const items = document.querySelectorAll('#review-carousel > div');
            const prevBtn = document.getElementById('prev-review');
            const nextBtn = document.getElementById('next-review');
            const dots = document.querySelectorAll('.review-dot');
            
            const itemCount = items.length;
            let currentIndex = 0;
            let itemWidth = items[0].clientWidth;
            let visibleItems = window.innerWidth >= 1024 ? 3 : window.innerWidth >= 640 ? 2 : 1;
            let isTransitioning = false;
            let autoSlideInterval;
            
            // Set initial position
            carousel.style.transform = `translateX(0)`;
            
            function updateCarousel(animate = true) {
                if (isTransitioning) return;
                
                // Handle loop
                if (currentIndex >= itemCount) {
                    currentIndex = 0;
                } else if (currentIndex < 0) {
                    currentIndex = itemCount - 1;
                }
                
                // Apply transition if animating
                if (animate) {
                    carousel.style.transition = 'transform 0.5s ease-in-out';
                    isTransitioning = true;
                    
                    setTimeout(() => {
                        isTransitioning = false;
                    }, 500);
                }
                
                const offset = -currentIndex * itemWidth;
                carousel.style.transform = `translateX(${offset}px)`;
                
                // Update dots
                dots.forEach((dot, index) => {
                    dot.classList.toggle('bg-[#8a7552]', index === currentIndex);
                    dot.classList.toggle('bg-gray-300', index !== currentIndex);
                });
            }
            
            // Navigation
            nextBtn.addEventListener('click', () => {
                currentIndex++;
                updateCarousel();
            });
            
            prevBtn.addEventListener('click', () => {
                currentIndex--;
                updateCarousel();
            });
            
            // Dot navigation
            dots.forEach(dot => {
                dot.addEventListener('click', () => {
                    const targetIndex = parseInt(dot.dataset.index);
                    currentIndex = targetIndex;
                    updateCarousel();
                });
            });
            
            // Touch support for mobile
            let touchStartX = 0;
            let touchEndX = 0;
            let touchStartTime = 0;
            
            carousel.addEventListener('touchstart', (e) => {
                touchStartX = e.changedTouches[0].screenX;
                touchStartTime = Date.now();
            }, {passive: true});
            
            carousel.addEventListener('touchend', (e) => {
                touchEndX = e.changedTouches[0].screenX;
                const touchDuration = Date.now() - touchStartTime;
                handleSwipe(touchDuration);
            }, {passive: true});
            
            function handleSwipe(touchDuration) {
                const threshold = 50;
                const velocityThreshold = 0.3;
                const distance = touchEndX - touchStartX;
                const velocity = Math.abs(distance) / touchDuration;
                
                if (velocity > velocityThreshold || Math.abs(distance) > threshold) {
                    if (distance < 0) {
                        currentIndex++;
                    } else {
                        currentIndex--;
                    }
                    updateCarousel();
                }
            }
            
            // Responsive adjustments
            function handleResize() {
                const newVisibleItems = window.innerWidth >= 1024 ? 3 : window.innerWidth >= 640 ? 2 : 1;
                if (newVisibleItems !== visibleItems) {
                    visibleItems = newVisibleItems;
                    itemWidth = items[0].clientWidth;
                    updateCarousel(false);
                }
            }
            
            window.addEventListener('resize', handleResize);
            
            // Auto-advance
            function startAutoSlide() {
                autoSlideInterval = setInterval(() => {
                    currentIndex++;
                    updateCarousel();
                }, 5000);
            }
            
            // Initialize
            updateCarousel(false);
            startAutoSlide();
            
            // Pause on hover
            carousel.addEventListener('mouseenter', () => {
                clearInterval(autoSlideInterval);
            });
            
            carousel.addEventListener('mouseleave', () => {
                startAutoSlide();
            });
        }
    });
</script>

<style>
    #review-carousel {
        display: flex;
        will-change: transform;
    }
    
    #review-carousel > div {
        flex: 0 0 auto;
        transition: transform 0.5s ease-in-out;
    }
    
    #prev-review:disabled,
    #next-review:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
    
    @media (max-width: 639px) {
        #review-carousel > div {
            width: 100%;
        }
    }
    
    @media (min-width: 640px) and (max-width: 1023px) {
        #review-carousel > div {
            width: 50%;
        }
    }
    
    @media (min-width: 1024px) {
        #review-carousel > div {
            width: 33.333%;
        }
    }
</style>
@endsection