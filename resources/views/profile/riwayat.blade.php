@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="container mx-auto px-4">
         <!-- Tombol Kembali ke Beranda -->
        <button onclick="window.location.href='{{ url('/') }}'" 
                class="mb-4 flex items-center px-4 py-2 bg-white text-primary border border-primary rounded-lg hover:bg-primary/10 transition-colors no-print">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Beranda
        </button>
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Sidebar Profile  -->
            <div class="w-full md:w-64 lg:w-80 flex-shrink-0">
                <div class="bg-white rounded-lg shadow-sm p-6 h-[calc(114vh-4rem)] flex flex-col">
                    <!-- User Profile Image and Info -->
                    <div class="flex flex-col items-center">
                        <div class="relative mb-4">
                            <img src="{{ $user->avatar ? asset('storage/avatars/'.$user->avatar) : asset('images/gitar.jpg') }}" 
                                    alt="Avatar" 
                                    class="w-24 h-24 rounded-full object-cover border-2 border-primary">
                        </div>
                        <h2 class="text-xl font-bold text-gray-800">{{ $user->name }}</h2>
                        <h3 class="text-gray-600 text-sm">{{ $user->email }}</h3>
                    </div>

                    <!-- Navigation Menu -->
                    <nav class="mt-8">
                        <ul class="space-y-2">
                            <li>
                                <a href="{{ route('profile') }}" class="flex items-center px-4 py-2 text-gray-600 hover:text-primary hover:bg-gray-100 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Informasi Pribadi
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('riwayat') }}" class="flex items-center px-4 py-2 text-primary bg-primary/10 rounded-lg font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    Riwayat Sewa
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center px-4 py-2 text-gray-600 hover:text-primary hover:bg-gray-100 rounded-lg transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Keluar
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-800">Riwayat Penyewaan</h2>
                        <button onclick="window.print()" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                            </svg>
                            Cetak
                        </button>
                    </div>

                    <!-- Filter dan Pencarian -->
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                        <div class="flex items-center space-x-2">
                            <span class="text-sm text-gray-600">Status:</span>
                            <select class="border border-gray-300 rounded-lg px-3 py-1 text-sm focus:ring-primary focus:border-primary">
                                <option>Semua Status</option>
                                <option>Menunggu Pembayaran</option>
                                <option>Selesai</option>
                                <option>Dibatalkan</option>
                            </select>
                        </div>
                        <div class="relative">
                            <input type="text" placeholder="Cari riwayat..." class="border border-gray-300 rounded-lg pl-10 pr-4 py-1 text-sm focus:ring-primary focus:border-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 absolute left-3 top-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Daftar Riwayat -->
                    <div class="space-y-4">
                        @foreach($rentals as $rental)
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('images/'.$rental['image']) }}" alt="{{ $rental['instrument_name'] }}" class="w-16 h-16 object-cover rounded-lg">
                                    </div>
                                    <div>
                                        <h3 class="font-medium text-gray-800">{{ $rental['instrument_name'] }}</h3>
                                        <p class="text-sm text-gray-600 mt-1">
                                            <span class="font-medium">Periode:</span> {{ $rental['rent_date'] }} - {{ $rental['return_date'] }}
                                        </p>
                                        <p class="text-sm text-gray-600">
                                            <span class="font-medium">Durasi:</span> {{ $rental['duration'] }}
                                        </p>
                                        <div class="mt-2">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                {{ $rental['status'] == 'Selesai' ? 'bg-green-100 text-green-800' : 
                                                   ($rental['status'] == 'Menunggu Pembayaran' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                                {{ $rental['status'] }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-gray-800">{{ $rental['total_price'] }}</p>
                                    <p class="text-sm text-gray-600 mt-1">
                                        {{ $rental['payment_method'] }}
                                    </p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $rental['order_time'] }}
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Tombol Aksi -->
                            <div class="flex justify-end space-x-2 mt-4">
                                <button class="px-3 py-1 border border-gray-300 text-gray-700 text-sm rounded-lg hover:bg-gray-50 transition-colors">
                                    Detail
                                </button>
                                @if($rental['status'] == 'Menunggu Pembayaran')
                                    <button class="px-3 py-1 bg-primary text-white text-sm rounded-lg hover:bg-primary-dark transition-colors">
                                        Bayar Sekarang
                                    </button>
                                    <button class="px-3 py-1 bg-red-100 text-red-700 text-sm rounded-lg hover:bg-red-200 transition-colors">
                                        Batalkan
                                    </button>
                                @else
                                    <button class="px-3 py-1 border border-gray-300 text-gray-700 text-sm rounded-lg hover:bg-gray-50 transition-colors">
                                        Unduh Invoice
                                    </button>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Print Styles -->
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        .print-content, .print-content * {
            visibility: visible;
        }
        .print-content {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        .no-print {
            display: none;
        }
    }
</style>
@endsection