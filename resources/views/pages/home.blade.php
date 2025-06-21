@extends('layouts.app')

@section('title', 'Insphony - Sewa Alat Musik Modern')

@section('content')
    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center overflow-hidden pt-16 bg-cover bg-center" style="background-image: url('https://c.animaapp.com/knqlfAnT/img/image-1.png')">
        <!-- Animated Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/50 to-black/70 animate-[gradient-x_8s_ease_infinite] bg-[length:200%_200%]"></div>
        
        <!-- Floating Music Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute text-white/10 text-6xl animate-[float_15s_linear_infinite] left-[15%] top-[20%]">🎸</div>
            <div class="absolute text-white/15 text-4xl animate-[float_12s_linear_infinite_1s] left-[80%] top-[30%]">♫</div>
            <div class="absolute text-white/10 text-5xl animate-[float_18s_linear_infinite_2s] left-[70%] top-[70%]">🎹</div>
            <div class="absolute text-white/15 text-3xl animate-[float_14s_linear_infinite_3s] left-[20%] top-[60%]">♬</div>
            <div class="absolute text-white/10 text-6xl animate-[float_16s_linear_infinite_4s] left-[85%] top-[15%]">🎷</div>
        </div>

       <div class="container mx-auto px-4 relative z-10">
    <div class="text-center text-white space-y-6">
        <!-- Animated Title -->
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-5 animate-[fadeInDown_1s_ease-out_forwards]">
            <span class="inline-block bg-clip-text text-transparent bg-gradient-to-r from-[#a08963] to-[#d9d9d9] animate-[text-gradient_3s_linear_infinite] bg-[length:200%_auto]">
                Sewa Alat Musik Modern
            </span>
        </h1>

        <!-- Animated Subtitle -->
        <p class="text-xl md:text-2xl mb-8 max-w-2xl mx-auto animate-[fadeInUp_1s_ease-out_forwards_0.1s]">
            Temukan berbagai pilihan alat musik berkualitas untuk kebutuhan anda
        </p>

        <!-- Animated Button -->
        <div class="animate-[fadeInUp_1s_ease-out_forwards_0.2s]">
            <button class="relative overflow-hidden group text-white bg-[#a08963] hover:bg-[#8b7556] font-medium rounded-lg px-8 py-3 text-lg transition-all duration-500 transform hover:-translate-y-1 hover:shadow-xl">
                <span class="relative z-10">Reservasi sekarang</span>
                <div class="absolute inset-0 bg-gradient-to-r from-[#b79b76] to-[#7a6247] opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="absolute bottom-0 left-0 right-0 h-1 bg-white/30 scale-x-0 group-hover:scale-x-100 transform origin-left transition-transform duration-500"></div>
            </button>
        </div>
    </div>
</div>


        <!-- Scroll Down Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-[bounce_2s_infinite]">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </section>

    <!-- Products Section -->
    <section id="produk" class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-semibold mb-8">Produk</h2>
            <div class="flex flex-col md:flex-row justify-between items-center p-5 bg-white rounded-lg shadow">
                <div class="flex-grow mr-2 mb-4 md:mb-0">
                    <input type="text" placeholder="Cari alat musik..." class="bg-white border border-[#a08963] text-gray-900 rounded-lg focus:ring-[#a08963] focus:border-[#a08963] block w-full p-2.5 transition-all duration-200">
                </div>
                <div class="w-full md:w-48 mr-2 mb-4 md:mb-0">
                    <select class="bg-white border border-[#a08963] text-[#a08963] rounded-lg focus:ring-[#a08963] focus:border-[#a08963] block w-full p-2.5 transition-all duration-200">
                        <option selected>Semua Kategori</option>
                        <option>Elektrofon</option>
                        <option>Aerofon</option>
                        <option>Kordofon</option>
                        <option>Iliofon</option>
                        <option>Membranofon</option>
                    </select>
                </div>
            </div>

            <div id="products-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-10">
                @foreach($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>

            @if($products->count() >= 6)
                <div class="text-center mt-8">
                    <button id="load-more-btn" data-offset="6" class="text-blue-600 hover:text-blue-800 font-medium px-4 py-2 border border-blue-600 rounded-lg transition-all hover:bg-blue-50">
                        Tampilkan Lainnya
                    </button>
                    <div id="loading-spinner" class="hidden mt-4">
                        <svg class="animate-spin h-5 w-5 text-blue-600 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Requirements Section -->
    <section id="syarat" class="py-16 bg-gradient-to-b from-gray-100 to-gray-300">
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
                <div class="h-full">
                    <div class="rounded-lg overflow-hidden shadow-lg h-full">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5360.296427177568!2d104.04588167613073!3d1.118720498870545!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d98921856ddfab%3A0xf9d9fc65ca00c9d!2sPoliteknik%20Negeri%20Batam!5e1!3m2!1sen!2sid!4v1750124900396!5m2!1sen!2sid"
                            class="w-full h-full min-h-[400px]"
                            allowfullscreen="" 
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
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

    <script>
        document.getElementById('load-more-btn').addEventListener('click', function() {
            const button = this;
            const offset = parseInt(button.dataset.offset);
            const spinner = document.getElementById('loading-spinner');
            
            spinner.classList.remove('hidden');
            button.classList.add('hidden');
            
            fetch(`/load-more?offset=${offset}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('products-container').insertAdjacentHTML('beforeend', data.html);
                    button.dataset.offset = offset + 6;
                    
                    if(data.has_more === false) {
                        button.style.display = 'none';
                    }
                    
                    spinner.classList.add('hidden');
                    button.classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error:', error);
                    spinner.classList.add('hidden');
                    button.classList.remove('hidden');
                });
        });
    </script>

    <style>
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
                transform: translateY(-40px) rotate(5deg) scale(1.1); 
            }
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
            to {
                background-position: 200% center;
            }
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }
    </style>
@endsection