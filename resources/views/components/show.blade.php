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
                        <img
                            src="{{ asset($product['image']) }}" 
                            alt="{{ $product['name'] }}" 
                            class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                            loading="lazy"
                        >
                        <!-- Availability Badge -->
                        <div class="absolute top-3 right-3">
                            @php
                                $stock = $product['stock'] ?? $product['stok'] ?? 0;
                            @endphp
                            @if(($product['availability'] ?? false) && $stock > 0)
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
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
                        @for ($i = 1; $i <= 4; $i++)
                            <button type="button" class="thumbnail-btn aspect-square rounded-lg overflow-hidden border-2 border-transparent hover:border-blue-500 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-300">
                                <img 
                                    src="{{ asset($product['image'] ?? 'placeholder-thumbnail.jpg') }}" 
                                    alt="Thumbnail {{ $i }}" 
                                    class="w-full h-full object-cover"
                                >
                            </button>
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
                                </div>
                            </div>
                            <div class="text-right">
                                @php
                                    $stock = $product['stock'] ?? $product['stok'] ?? 0;
                                @endphp
                                @if($stock)
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
                                    {{ $product['rating'] ?? 0 }}/5.0
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
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-xs text-gray-500">Harga termasuk pajak dan biaya layanan</span>
                        </div>
                    </div>

                    <!-- Description Section -->
                    @if(!empty($product['deskripsi']) || !empty($product['description']))
                        <div class="space-y-2">
                            <h3 class="text-lg font-semibold text-gray-900">Deskripsi Produk</h3>
                            <p class="text-gray-700 leading-relaxed">
                                {{ $product['deskripsi'] ?? $product['description'] ?? '' }}
                            </p>
                        </div>
                    @endif
                    <!-- Rental Form Section -->
                    <div class="mt-6 space-y-4">
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
                                $stock = $product['stock'] ?? $product['stok'] ?? 0;
                                $isAvailable = $stock > 0 && ($product['availability'] ?? false);
                            @endphp
                            
@if($isAvailable)
    <form action="{{ route('penyewaan.form') }}" method="GET">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product['id'] ?? 0 }}">
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
                        <div class="text-5xl font-bold text-gray-900 mb-2">{{ $product['rating'] ?? 0 }}</div>
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
                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-3 mb-3">
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
                        <p class="text-gray-700 mb-3">Produknya sangat bagus dan sesuai dengan deskripsi. Pengiriman cepat dan seller ramah. Akan sewa lagi di lain waktu!</p>
                        <div class="flex gap-2">
                            <button type="button" class="w-16 h-16 rounded-md overflow-hidden border border-gray-200">
                                <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}" class="w-full h-full object-cover">
                            </button>
                            <button type="button" class="w-16 h-16 rounded-md overflow-hidden border border-gray-200">
                                <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}" class="w-full h-full object-cover">
                            </button>
                        </div>
                    </div>
                    
                    <!-- Sample Review 2 -->
                    <div class="border-b border-gray-200 pb-6">
                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-3 mb-3">
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
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @endfor
                            </div>
                        </div>
                        <p class="text-gray-700">Sangat puas dengan pelayanannya. Produk bekerja dengan sempurna dan kondisi sangat baik. Recommended!</p>
                    </div>
                    
                    <!-- Load More Reviews Button -->
                    <div class="text-center pt-4">
                        <button type="button" class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center justify-center gap-1 mx-auto">
                            Muat lebih banyak ulasan
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Rental date calculation elements
    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');
    const durationDisplay = document.getElementById('duration-display');
    const totalPriceElement = document.getElementById('total-price');
    const hiddenStartDate = document.getElementById('hidden_start_date');
    const hiddenEndDate = document.getElementById('hidden_end_date');
    
    // Clean price value by removing non-numeric characters
    const pricePerDay = parseInt("{{ str_replace(['Rp', '.', ' '], '', $product['price'] ?? 0) }}") || 0;
    
    // Format currency as Rupiah
    function formatRupiah(amount) {
        return 'Rp ' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    
    // Calculate rental duration
    function calculateDuration() {
        if (startDateInput.value && endDateInput.value) {
            const startDate = new Date(startDateInput.value);
            const endDate = new Date(endDateInput.value);
            
            // Calculate difference in days (inclusive)
            const diffTime = Math.abs(endDate - startDate);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
            
            durationDisplay.textContent = diffDays + ' Hari';
            totalPriceElement.textContent = formatRupiah(diffDays * pricePerDay);
            
            // Update hidden fields
            hiddenStartDate.value = startDateInput.value;
            hiddenEndDate.value = endDateInput.value;
        }
    }
    
    // Initialize date inputs
    function initializeDates() {
        const today = new Date().toISOString().split('T')[0];
        startDateInput.min = today;
        endDateInput.min = today;
        
        // Set default dates (today and tomorrow)
        if (!startDateInput.value) {
            startDateInput.value = today;
        }
        if (!endDateInput.value) {
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            endDateInput.value = tomorrow.toISOString().split('T')[0];
        }
        
        calculateDuration();
    }
    
    // Event listeners
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
    
    // Thumbnail image switching
    const thumbnails = document.querySelectorAll('.thumbnail-btn');
    const mainImage = document.querySelector('.group img');
    
    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', function() {
            const img = this.querySelector('img');
            if (img && mainImage) {
                mainImage.src = img.src;
            }
        });
    });
    
    // Initialize the page
    initializeDates();
});
</script>
@endsection