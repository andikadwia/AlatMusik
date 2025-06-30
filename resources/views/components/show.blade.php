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
        @if($reviews->count() > 0)
            <span class="text-sm text-gray-500">{{ $reviews->total() }} total ulasan</span>
        @endif
    </div>
    
    <!-- Rating Summary Card -->
<div class="flex flex-col md:flex-row gap-6 mb-8">
    <!-- Overall Rating Card -->
    <div class="w-full md:w-1/3 bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="text-center">
            <div class="text-5xl font-bold text-gray-900 mb-3">{{ number_format((float)$product['rating'] ?? 0, 1) }}<span class="text-2xl text-gray-500">/5</span></div>
            <div class="flex justify-center mb-3">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= floor($product['rating'] ?? 0))
                        <svg class="w-7 h-7 text-amber-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    @elseif ($i - 0.5 <= ($product['rating'] ?? 0))
                        <svg class="w-7 h-7 text-amber-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <linearGradient id="half-star-{{ $i }}" x1="0" x2="100%" y1="0" y2="0">
                                    <stop offset="50%" stop-color="currentColor"/>
                                    <stop offset="50%" stop-color="#d1d5db"/>
                                </linearGradient>
                            </defs>
                            <path fill="url(#half-star-{{ $i }})" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    @else
                        <svg class="w-7 h-7 text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    @endif
                @endfor
            </div>
            <p class="text-gray-600 mb-4">{{ $product['review_count'] ?? 0 }} ulasan</p>
            <div class="w-full bg-gray-100 rounded-full h-2.5">
                <div class="bg-amber-500 h-2.5 rounded-full" style="width: {{ (($product['rating'] ?? 0) / 5) * 100 }}%"></div>
            </div>
        </div>
    </div>
    
    <!-- Rating Breakdown -->
    <div class="flex-1 bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-5">Detail Penilaian</h3>
        <div class="space-y-4">
            @for($i = 5; $i >= 1; $i--)
                <div class="flex items-center">
                    <div class="flex items-center w-16">
                        <span class="text-sm font-medium text-gray-600 mr-1">{{ $i }}</span>
                        <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    </div>
                    <div class="flex-1 mx-3">
                        <div class="w-full h-2.5 bg-gray-100 rounded-full overflow-hidden">
                            @php
                                $percentage = ($product['review_count'] ?? 0) > 0 
                                    ? ($rating_breakdown[$i] ?? 0) / ($product['review_count'] ?? 1) * 100 
                                    : 0;
                            @endphp
                            <div class="h-full bg-gradient-to-r from-amber-400 to-amber-500 rounded-full" style="width: {{ $percentage }}%"></div>
                        </div>
                    </div>
                    <span class="w-10 text-right text-sm font-medium text-gray-500">{{ $rating_breakdown[$i] ?? 0 }}</span>
                </div>
            @endfor
        </div>
    </div>
</div>

    <div class="space-y-6">
    @if($reviews->count() > 0)
        <!-- Header dan Sorting yang akan tetap di atas saat di-scroll -->
        <div class="sticky top-0 bg-white z-10 pt-4 pb-2 border-b border-gray-200 mb-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <h3 class="text-xl font-semibold text-gray-900">Ulasan Pelanggan</h3>
                <div class="relative w-full sm:w-auto">
                    <form method="get" id="sortForm">
                        <select name="sort" onchange="document.getElementById('sortForm').submit()" 
                                class="block w-full sm:w-48 appearance-none bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded-lg leading-tight focus:outline-none focus:ring-2 focus:ring-[#a08963] focus:border-[#a08963] text-sm">
                            <option value="terbaru" {{ $current_sort == 'terbaru' ? 'selected' : '' }}>Urutkan: Terbaru</option>
                            <option value="terlama" {{ $current_sort == 'terlama' ? 'selected' : '' }}>Terlama</option>
                            <option value="rating_tinggi" {{ $current_sort == 'rating_tinggi' ? 'selected' : '' }}>Rating Tertinggi</option>
                            <option value="rating_rendah" {{ $current_sort == 'rating_rendah' ? 'selected' : '' }}>Rating Terendah</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                            </svg>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    
    <!-- Container untuk daftar ulasan dengan scroll -->
    <div class="mt-4">
        @forelse($reviews as $review)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow mb-4">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-4 mb-4">
                    <div class="flex items-start">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-primary to-primary-dark text-white flex items-center justify-center overflow-hidden border-2 border-[#a08963] mr-4 flex-shrink-0">
    @if ($review->user->foto_profil)
        <img src="{{ asset($review->user->foto_profil) }}" alt="{{ $review->user->name }}" class="w-full h-full object-cover">
    @else
        <span class="text-lg font-semibold">{{ strtoupper(substr($review->user->name, 0, 1)) }}</span>
    @endif
</div>
                        <div>
                            <h4 class="font-medium text-gray-900">{{ $review->user->name }}</h4>
                            <p class="text-sm text-gray-500">{{ $review->dibuat_pada->format('d M Y') }}</p>
                            @if($review->verified_purchase)
                                <span class="inline-block mt-1 bg-green-100 text-green-800 text-xs px-2 py-0.5 rounded">Pembelian Terverifikasi</span>
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center bg-[#a08963]/10 px-3 py-1 rounded-full">
                        <div class="flex mr-1">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $review->rating)
                                    <svg class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @endif
                            @endfor
                        </div>
                        <span class="text-xs font-medium text-[#a08963]">{{ $review->rating }}.0</span>
                    </div>
                </div>
                <p class="text-gray-700 mb-4 whitespace-pre-line">{{ $review->komentar }}</p>
            </div>
        @empty
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
                <svg class="w-16 h-16 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">Belum ada ulasan</h3>
                <p class="mt-1 text-gray-500">Produk ini belum memiliki ulasan</p>
            </div>
        @endforelse
    </div>
    
    @if($reviews->hasPages())
        <div class="mt-6">
            {{ $reviews->appends(['sort' => $current_sort])->onEachSide(1)->links('vendor.pagination.tailwind') }}
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