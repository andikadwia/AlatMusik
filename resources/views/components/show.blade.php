@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 sm:px-6 py-6">
        <!-- Back Button -->
        <a href="{{ url()->previous() }}" class="mb-4 inline-flex items-center gap-2 text-gray-600 hover:text-primary transition-colors text-sm md:text-base">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Kembali ke Katalog
        </a>

        <!-- Product Container -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <!-- Main Product Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8 p-4 sm:p-6">
                <!-- Product Image Gallery -->
                <div class="space-y-4">
                    <!-- Main Image -->
                    <div class="relative group overflow-hidden rounded-xl bg-gray-100 aspect-square">
                        @if(isset($product['images']) && count($product['images']) > 0)
                            <img
                                src="{{ asset($product['images'][0]) }}" 
                                alt="{{ $product['name'] }}" 
                                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                                loading="lazy"
                                id="main-product-image"
                            >
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                        <!-- Availability Badge -->
                        <div class="absolute top-3 right-3">
                            @php
                                $stock = $product['stock'] ?? 0;
                            @endphp
                            @if(($product['availability'] ?? false) && $stock > 0)
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.293l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                    TERSEDIA
                                </span>
                            @else
                                <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                    </svg>
                                    TIDAK TERSEDIA
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Thumbnail Gallery -->
                    <div class="grid grid-cols-4 gap-3">
                        @if(isset($product['images']) && count($product['images']) > 0)
                            @foreach($product['images'] as $index => $image)
                                <button type="button" 
                                    class="thumbnail-btn aspect-square rounded-lg overflow-hidden border-2 {{ $index === 0 ? 'border-blue-500' : 'border-transparent' }} hover:border-blue-500 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-300"
                                    onclick="changeMainImage(this, '{{ asset($image) }}')">
                                    <img 
                                        src="{{ asset($image) }}" 
                                        alt="Thumbnail {{ $index + 1 }}" 
                                        class="w-full h-full object-cover"
                                    >
                                </button>
                            @endforeach
                        @endif
                        
                        @for($i = isset($product['images']) ? count($product['images']) : 0; $i < 4; $i++)
                            <div class="aspect-square rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endfor
                    </div>
                </div>

                <!-- Product Details -->
                <div class="space-y-6">
                    <!-- Title and Basic Info -->
                    <div class="space-y-3">
                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-3">
                            <div>
                                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 leading-tight">
                                    {{ $product['name'] ?? 'Nama Produk' }}
                                </h1>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-0.5 rounded">
                                        {{ $product['category'] ?? 'Kategori' }}
                                    </span>
                                </div>
                            </div>
                            <div class="text-right">
                                @php
                                    $stock = $product['stock'] ?? 0;
                                @endphp
                                @if($stock > 0)
                                    <span class="text-xl font-bold text-green-600">{{ $stock }}</span>
                                    <p class="text-xs text-green-600 font-medium">Stok Tersedia</p>
                                @else
                                    <span class="text-xl font-bold text-gray-400">0</span>
                                    <p class="text-xs text-gray-500 font-medium">Stok Habis</p>
                                @endif
                            </div>
                        </div>

                        <!-- Rating -->
                        <div class="flex items-center gap-3">
                            <div class="flex items-center">
                                <div class="flex mr-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= floor($product['rating'] ?? 0))
                                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        @endif
                                    @endfor
                                </div>
                                <span class="text-gray-600 font-medium text-sm">
                                    {{ number_format((float)$product['rating'] ?? 0, 1) }}/5.0
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Price Section -->
                    <div class="py-4 border-y border-gray-200">
                        <div class="flex items-baseline gap-2">
                            <span class="text-2xl sm:text-3xl font-bold text-gray-900">
                                {{ $product['price'] ?? 'Rp 0' }}
                            </span>
                        </div>
                        <div class="flex items-center gap-1 mt-1">
                            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.293l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-xs text-gray-500">Harga termasuk pajak dan biaya layanan</span>
                        </div>
                    </div>

                    <!-- Description Section -->
                    @if(!empty($product['description']))
                        <div class="space-y-2">
                            <h3 class="text-lg font-semibold text-gray-900">Deskripsi Produk</h3>
                            <p class="text-gray-700 leading-relaxed">
                                {{ $product['description'] }}
                            </p>
                        </div>
                    @endif


                    <!-- Rental Form Section -->
<div class="mt-6 space-y-4">
    <h3 class="text-lg font-semibold text-gray-900">Penyewaan</h3>
    
    <!-- Quantity Input -->
    <div>
        <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Jumlah</label>
        <input 
            type="number" 
            id="quantity" 
            name="quantity"
            min="1"
            max="{{ $product['stock'] ?? 1 }}"
            value="1"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
            required
        >
    </div>
                        <h3 class="text-lg font-semibold text-gray-900">Durasi Sewa</h3>
                        
                        <!-- Date Selection -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">
                                    Tanggal Mulai
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <input 
                                        type="date" 
                                        id="start_date" 
                                        name="start_date"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                                        min="{{ date('Y-m-d') }}"
                                        required
                                    >
                                </div>
                            </div>
                            
                            <div>
                                <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">
                                    Tanggal Selesai
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <input 
                                        type="date" 
                                        id="end_date" 
                                        name="end_date"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                                        min="{{ date('Y-m-d') }}"
                                        required
                                    >
                                </div>
                            </div>
                        </div>
                        
                        <!-- Rental Summary -->
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Durasi Sewa</h4>
                                    <p id="duration-display" class="text-lg font-bold text-gray-900">Pilih tanggal</p>
                                </div>
                                <div class="text-left sm:text-right">
                                    <h4 class="text-sm font-medium text-gray-500">Total Biaya</h4>
                                    <p id="total-price" class="text-2xl font-bold text-[#a08963]">
                                        Rp 0
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                            @php
                                $stock = $product['stock'] ?? 0;
                                $isAvailable = $stock > 0 && ($product['availability'] ?? false);
                            @endphp
                            
                            @if($isAvailable)
                              <form action="{{ route('penyewaan.form') }}" method="GET">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product['id'] ?? 0 }}">
    <input type="hidden" name="quantity" id="hidden_quantity" value="1">
    <input type="hidden" name="start_date" id="hidden_start_date">
    <input type="hidden" name="end_date" id="hidden_end_date">
    <button type="submit" class="w-full text-white bg-[#a08963] hover:bg-[#8b7556] font-medium rounded-lg text-sm px-5 py-3 text-center flex items-center justify-center gap-2">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.293l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd"></path>
        </svg>
        Sewa Sekarang
    </button>
</form>
                            @else
                                <button disabled class="w-full text-white bg-gray-400 font-medium rounded-lg text-sm px-5 py-3 text-center flex items-center justify-center gap-2 cursor-not-allowed">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M13.477 14.89A6 6 0 015.11 6.524l8.367 8.368zm1.414-1.414L6.524 5.11a6 6 0 018.367 8.367zM18 10a8 8 0 11-16 0 8 8 0 0116 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    Tidak Tersedia
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reviews Section -->
            <div id="reviews" class="border-t border-gray-200 px-4 sm:px-6 py-8">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Ulasan & Penilaian</h2>
                </div>
                
                <!-- Rating Summary -->
                <div class="flex flex-col md:flex-row gap-8 mb-8">
                    <!-- Overall Rating -->
                    <div class="text-center bg-gray-50 p-6 rounded-lg md:w-1/3">
                        <div class="text-5xl font-bold text-gray-900 mb-2">{{ number_format((float)$product['rating'] ?? 0, 1) }}</div>
                        <div class="flex justify-center mb-2">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= floor($product['rating'] ?? 0))
                                    <svg class="w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @else
                                    <svg class="w-6 h-6 text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @endif
                            @endfor
                        </div>
                        <p class="text-gray-600">Berdasarkan {{ $product['review_count'] ?? 0 }} ulasan</p>
                    </div>
                    
                    <!-- Rating Breakdown -->
                    <div class="flex-1 space-y-3">
                        @for($i = 5; $i >= 1; $i--)
                            <div class="flex items-center">
                                <span class="w-12 text-sm font-medium text-gray-600">{{ $i }} bintang</span>
                                <div class="flex-1 mx-3 h-3 bg-gray-200 rounded-full overflow-hidden">
                                    @php
                                        $percentage = $product['review_count'] > 0 
                                            ? (($product['rating_breakdown'][$i] ?? 0) / $product['review_count']) * 100 
                                            : 0;
                                    @endphp
                                    <div class="h-full bg-yellow-400 rounded-full" style="width: {{ $percentage }}%"></div>
                                </div>
                                <span class="w-10 text-right text-sm text-gray-500">{{ $product['rating_breakdown'][$i] ?? 0 }}</span>
                            </div>
                        @endfor
                    </div>
                </div>
                
                <!-- Review List -->
                <div class="space-y-6">
                    <h3 class="text-xl font-semibold text-gray-900">Ulasan Pelanggan</h3>
                    
                    <!-- Sample Reviews -->
                    @if(isset($product['reviews']) && count($product['reviews']) > 0)
                        @foreach($product['reviews'] as $review)
                            <div class="border-b border-gray-200 pb-6">
                                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-3 mb-3">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-full bg-gray-300 mr-3 overflow-hidden">
                                            <img src="{{ $review['user_avatar'] ?? 'https://randomuser.me/api/portraits/lego/1.jpg' }}" alt="User" class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <h4 class="font-medium">{{ $review['user_name'] }}</h4>
                                            <p class="text-sm text-gray-500">{{ $review['date'] }}</p>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review['rating'])
                                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                            @else
                                                <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                                <p class="text-gray-700 mb-3">{{ $review['comment'] }}</p>
                                @if(!empty($review['images']))
                                    <div class="flex gap-2">
                                        @foreach($review['images'] as $reviewImage)
                                            <button type="button" class="w-16 h-16 rounded-md overflow-hidden border border-gray-200">
                                                <img src="{{ $reviewImage }}" alt="Review image" class="w-full h-full object-cover">
                                            </button>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <p class="text-gray-500">Belum ada ulasan untuk produk ini.</p>
                    @endif
                    
                    <!-- Load More Reviews Button -->
                    @if(isset($product['reviews']) && count($product['reviews']) > 2)
                        <div class="text-center pt-4">
                            <button type="button" class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center justify-center gap-1 mx-auto">
                                Muat lebih banyak ulasan
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bagian HTML tetap sama, hanya tambahkan script ini di bagian bawah sebelum penutup section -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Rental date calculation elements
    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');
    const quantityInput = document.getElementById('quantity');
    const durationDisplay = document.getElementById('duration-display');
    const totalPriceElement = document.getElementById('total-price');
    const hiddenStartDate = document.getElementById('hidden_start_date');
    const hiddenEndDate = document.getElementById('hidden_end_date');
    
    // Clean price value
    const pricePerDay = parseInt("{{ str_replace(['Rp', '.', ' '], '', $product['price'] ?? 0) }}") || 0;
    
    // Format currency as Rupiah
    function formatRupiah(amount) {
        return 'Rp ' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    
    // Calculate rental duration (24 jam = 1 hari)
     function calculateDuration() {
        if (startDateInput.value && endDateInput.value) {
            const startDate = new Date(startDateInput.value);
            const endDate = new Date(endDateInput.value);
            const quantity = parseInt(quantityInput.value) || 1;
            
            // Set to start of day
            startDate.setHours(0, 0, 0, 0);
            endDate.setHours(0, 0, 0, 0);
            
            // Validasi: end date tidak boleh sebelum start date
            if (endDate < startDate) {
                alert("Tanggal selesai tidak boleh sebelum tanggal mulai");
                endDateInput.value = startDateInput.value;
                return;
            }
            
            // Calculate difference in days (24 jam = 1 hari)
            const diffTime = Math.abs(endDate - startDate);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            
            // Jika tanggal mulai dan selesai sama, tetap dihitung 1 hari
            const finalDays = diffDays === 0 ? 1 : diffDays;
            
            durationDisplay.textContent = finalDays + ' Hari';
            totalPriceElement.textContent = formatRupiah(finalDays * pricePerDay * quantity);
            
            // Update hidden fields
            hiddenStartDate.value = startDateInput.value;
            hiddenEndDate.value = endDateInput.value;
            document.getElementById('hidden_quantity').value = quantity;
        }
    }
    
    // Tambahkan event listener untuk quantity
    quantityInput.addEventListener('change', function() {
        const maxStock = parseInt(this.max);
        if (this.value > maxStock) {
            this.value = maxStock;
            alert(`Jumlah tidak boleh melebihi stok yang tersedia (${maxStock})`);
        }
        calculateDuration();
    });

    // Update end date min when start date changes
    startDateInput.addEventListener('change', function() {
        endDateInput.min = this.value;
        calculateDuration();
    });
    
    endDateInput.addEventListener('change', calculateDuration);
    
    // Change main product image when thumbnail is clicked
    function changeMainImage(thumbnail, imageUrl) {
        const mainImage = document.getElementById('main-product-image');
        if (mainImage) {
            mainImage.src = imageUrl;
        }
        
        document.querySelectorAll('.thumbnail-btn').forEach(btn => {
            btn.classList.remove('border-blue-500');
            btn.classList.add('border-transparent');
        });
        thumbnail.classList.remove('border-transparent');
        thumbnail.classList.add('border-blue-500');
    }

    // Initialize event listeners for thumbnails
    document.querySelectorAll('.thumbnail-btn').forEach(thumbnail => {
        thumbnail.addEventListener('click', function() {
            const img = this.querySelector('img');
            if (img) {
                changeMainImage(this, img.src);
            }
        });
    });
});
</script>
@endsection