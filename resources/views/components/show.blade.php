@extends('layouts.app')

@section('content')
<div class="bg-white min-h-screen">
    <div class="container mx-auto px-4 py-8 bg-white relative">
        <!-- Back Button -->
        <a href="{{ url()->previous() }}" class="absolute left-4 top-4 inline-flex items-center gap-2 text-gray-700 hover:text-primary transition-colors text-[clamp(0.875rem,2vw,1rem)]">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Kembali ke Katalog
        </a>

        <div class="w-full max-w-full lg:max-w-[90%] xl:max-w-[1200px] mx-auto px-4 pt-16 pb-8">
            <!-- Product Container -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <!-- Main Product Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-10 p-4 lg:p-8">
                    <!-- Product Image Gallery -->
                    <div class="space-y-4">
                        <!-- Main Image -->
                        <div class="relative group overflow-hidden rounded-xl bg-gray-100 aspect-[4/3]">
                            <img
                                src="{{ asset($product['image']) }}" 
                                alt="{{ $product['name'] }}" 
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                loading="lazy"
                            >
                            <!-- Availability Badge -->
                            <div class="absolute top-3 right-3">
                                @php
                                    $stock = $product['stock'] ?? $product['stok'] ?? 0;
                                @endphp
                                @if(($product['availability'] ?? false) && $stock > 0)
                                    <span class="bg-green-500 text-white text-xs lg:text-sm font-bold px-3 py-1 rounded-full shadow-lg">
                                        TERSEDIA
                                    </span>
                                @else
                                    <span class="bg-red-500 text-white text-xs lg:text-sm font-bold px-3 py-1 rounded-full shadow-lg">
                                        TIDAK TERSEDIA
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Thumbnail Gallery -->
                        <div class="grid grid-cols-4 gap-3">
                            @for ($i = 1; $i <= 4; $i++)
                                <div class="cursor-pointer border-2 border-transparent hover:border-blue-500 rounded-lg overflow-hidden aspect-square">
                                    <img src="{{ asset($product['image'] ?? 'placeholder-thumbnail.jpg') }}" alt="Thumbnail {{ $i }}" class="w-full h-full object-cover">
                                </div>
                            @endfor
                        </div>
                    </div>

                    <!-- Product Details -->
                    <div class="space-y-6">
                        <!-- Title and Basic Info -->
                        <div class="space-y-3">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h1 class="text-2xl lg:text-3xl xl:text-4xl font-bold text-gray-900 leading-tight">
                                        {{ $product['name'] ?? 'Nama Produk' }}
                                    </h1>
                                    <span class="text-gray-500 text-sm lg:text-base">
                                        {{ $product['category'] ?? 'Kategori' }}
                                    </span>
                                </div>
                                <div class="text-right">
                                    @php
                                        $stock = $product['stock'] ?? $product['stok'] ?? 0;
                                    @endphp
                                    @if($stock)
                                        <span class="text-xl lg:text-2xl font-bold text-green-600">{{ $stock }}</span>
                                        <p class="text-xs text-green-600 font-medium">Stok Tersedia</p>
                                    @else
                                        <span class="text-xl lg:text-2xl font-bold text-gray-400">0</span>
                                        <p class="text-xs text-gray-500 font-medium">Stok Habis</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Rating -->
                            <div class="flex items-center gap-2">
                                <div class="flex items-center">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= floor($product['rating'] ?? 0))
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 lg:h-6 lg:w-6 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 lg:h-6 lg:w-6 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endif
                                    @endfor
                                    <span class="ml-2 text-gray-600 font-medium text-sm lg:text-base">
                                        {{ $product['rating'] ?? 0 }}/5.0
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Price Section -->
                        <div class="py-4 border-b border-gray-200">
                            <div class="text-xl lg:text-2xl xl:text-3xl font-bold text-gray-900">
                                {{ $product['price'] ?? 'Rp 0' }}
                            </div>
                            <div class="text-xs lg:text-sm text-gray-500 mt-1">
                                Harga termasuk pajak dan biaya layanan
                            </div>
                        </div>

                        <!-- Description Section -->
                        @if(!empty($product['deskripsi']) || !empty($product['description']))
                            <div class="space-y-2">
                                <h3 class="text-lg lg:text-xl font-semibold text-gray-900">Deskripsi</h3>
                                <p class="text-sm lg:text-base text-gray-700 leading-relaxed">
                                    {{ $product['deskripsi'] ?? $product['description'] ?? '' }}
                                </p>
                            </div>
                        @endif

                        <!-- Rental Form Section -->
                        <div class="mt-6 space-y-4">
                            <h3 class="text-lg lg:text-xl font-semibold text-gray-900">Durasi Sewa</h3>
                            
                            <!-- Date Selection -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="start_date" class="block text-sm lg:text-base font-medium text-gray-700 mb-1">
                                        Tanggal Mulai
                                    </label>
                                    <input 
                                        type="date" 
                                        id="start_date" 
                                        name="start_date"
                                        class="w-full rounded-lg border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2 text-gray-700 font-medium text-sm lg:text-base"
                                        min="{{ date('Y-m-d') }}"
                                        required
                                    >
                                </div>
                                
                                <div>
                                    <label for="end_date" class="block text-sm lg:text-base font-medium text-gray-700 mb-1">
                                        Tanggal Selesai
                                    </label>
                                    <input 
                                        type="date" 
                                        id="end_date" 
                                        name="end_date"
                                        class="w-full rounded-lg border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2 text-gray-700 font-medium text-sm lg:text-base"
                                        min="{{ date('Y-m-d') }}"
                                        required
                                    >
                                </div>
                            </div>
                            
                            <!-- Rental Summary -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2">
                                    <div>
                                        <h4 class="text-sm lg:text-base font-medium text-gray-500">Durasi Sewa</h4>
                                        <p id="duration-display" class="text-lg font-bold text-gray-900">Pilih tanggal</p>
                                    </div>
                                    <div class="text-left sm:text-right">
                                        <h4 class="text-sm lg:text-base font-medium text-gray-500">Total Biaya</h4>
                                        <p id="total-price" class="text-xl lg:text-2xl font-bold text-primary">
                                            Rp 0
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                                @php
                                    $stock = $product['stock'] ?? $product['stok'] ?? 0;
                                    $isAvailable = $stock > 0 && ($product['availability'] ?? false);
                                @endphp
                                
                                @if($isAvailable)
                                    <a href="#" class="w-full bg-primary hover:bg-primary-dark text-white py-3 px-6 rounded-lg font-bold transition-colors duration-200 flex items-center justify-center gap-2 text-sm lg:text-base">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.293l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd" />
                                        </svg>
                                        Sewa Sekarang
                                    </a>
                                    <button type="button" class="w-full bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 py-3 px-6 rounded-lg font-bold transition-colors duration-200 flex items-center justify-center gap-2 text-sm lg:text-base">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                        </svg>
                                        Tambah ke Keranjang
                                    </button>
                                @else
                                    <button disabled class="w-full bg-gray-400 text-white py-3 px-6 rounded-lg font-bold cursor-not-allowed flex items-center justify-center gap-2 text-sm lg:text-base">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M13.477 14.89A6 6 0 015.11 6.524l8.367 8.368zm1.414-1.414L6.524 5.11a6 6 0 018.367 8.367zM18 10a8 8 0 11-16 0 8 8 0 0116 0z" clip-rule="evenodd" />
                                        </svg>
                                        Tidak Tersedia
                                    </button>
                                    <button disabled class="w-full bg-gray-200 border border-gray-300 text-gray-500 py-3 px-6 rounded-lg font-bold cursor-not-allowed flex items-center justify-center gap-2 text-sm lg:text-base">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                        </svg>
                                        Keranjang
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reviews Section -->
                <div class="border-t border-gray-200 px-4 lg:px-8 py-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Ulasan & Komentar</h2>
                    
                    <!-- Rating Summary -->
                    <div class="flex flex-col md:flex-row gap-8 mb-8">
                        <!-- Overall Rating -->
                        <div class="text-center bg-gray-50 p-6 rounded-lg md:w-1/3">
                            <div class="text-5xl font-bold text-gray-900 mb-2">{{ $product['rating'] ?? 0 }}</div>
                            <div class="flex justify-center mb-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= floor($product['rating'] ?? 0))
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endif
                                @endfor
                            </div>
                            <p class="text-gray-600">Berdasarkan {{ rand(10, 50) }} ulasan</p>
                        </div>
                        
                        <!-- Rating Breakdown -->
                        <div class="flex-1 space-y-3">
                            @for($i = 5; $i >= 1; $i--)
                                <div class="flex items-center">
                                    <span class="w-12 text-sm font-medium text-gray-600">{{ $i }} bintang</span>
                                    <div class="flex-1 mx-3 h-3 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="h-full bg-yellow-400 rounded-full" style="width: {{ rand(30, 100) }}%"></div>
                                    </div>
                                    <span class="w-10 text-right text-sm text-gray-500">{{ rand(1, 20) }}</span>
                                </div>
                            @endfor
                        </div>
                    </div>
                    
                    <!-- Review List -->
                    <div class="space-y-6">
                        <h3 class="text-xl font-semibold text-gray-900">Ulasan Pelanggan</h3>
                        
                        <!-- Sample Review 1 -->
                        <div class="border-b border-gray-200 pb-6">
                            <div class="flex justify-between items-start mb-3">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-gray-300 mr-3 overflow-hidden">
                                        <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="User" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <h4 class="font-medium">Sarah Johnson</h4>
                                        <p class="text-sm text-gray-500">2 minggu yang lalu</p>
                                    </div>
                                </div>
                                <div class="flex">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= 4)
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                            <p class="text-gray-700 mb-3">Produknya sangat bagus dan sesuai dengan deskripsi. Pengiriman cepat dan seller ramah. Akan sewa lagi di lain waktu!</p>
                            <div class="flex gap-2">
                                <div class="w-16 h-16 rounded-md overflow-hidden border border-gray-200">
                                    <img src="{{ asset($product['image']) }}" 
                                alt="{{ $product['name'] }}"  class="w-full h-full object-cover">
                                </div>
                                <div class="w-16 h-16 rounded-md overflow-hidden border border-gray-200">
                                    <img src="{{ asset($product['image']) }}" 
                                alt="{{ $product['name'] }}"  class="w-full h-full object-cover">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Sample Review 2 -->
                        <div class="border-b border-gray-200 pb-6">
                            <div class="flex justify-between items-start mb-3">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-gray-300 mr-3 overflow-hidden">
                                        <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="User" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <h4 class="font-medium">Budi Santoso</h4>
                                        <p class="text-sm text-gray-500">1 bulan yang lalu</p>
                                    </div>
                                </div>
                                <div class="flex text-yellow-400">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                            <p class="text-gray-700">Sangat puas dengan pelayanannya. Produk bekerja dengan sempurna dan kondisi sangat baik. Recommended!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');
        const durationDisplay = document.getElementById('duration-display');
        const totalPriceElement = document.getElementById('total-price');
        
        // Clean price value by removing non-numeric characters
        const pricePerDay = parseInt("{{ str_replace(['Rp', '.', ' '], '', $product['price'] ?? 0) }}") || 0;
        
        function formatRupiah(amount) {
            return 'Rp ' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
        
        function calculateDuration() {
            if (startDateInput.value && endDateInput.value) {
                const startDate = new Date(startDateInput.value);
                const endDate = new Date(endDateInput.value);
                
                // Calculate difference in hours
                const diffTime = Math.abs(endDate - startDate);
                const diffHours = Math.ceil(diffTime / (1000 * 60 * 60));
                
                // Calculate number of 24-hour periods
                const periods24Hours = Math.ceil(diffHours / 24);
                
                durationDisplay.textContent = diffHours + ' Jam (' + periods24Hours + ' x 24 Jam)';
                totalPriceElement.textContent = formatRupiah(periods24Hours * pricePerDay);
            }
        }
        
        startDateInput.addEventListener('change', function() {
            if (this.value) {
                endDateInput.min = this.value;
                if (endDateInput.value && endDateInput.value < this.value) {
                    endDateInput.value = this.value;
                }
                calculateDuration();
            }
        });
        
        endDateInput.addEventListener('change', calculateDuration);
        
        // Initialize end date min to today
        endDateInput.min = "{{ date('Y-m-d') }}";
    });
</script>
@endsection