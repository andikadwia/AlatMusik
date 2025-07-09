@extends('layouts.main')

@section('title', 'Insphony - Dasbor')

@section('content')
<h1 class="text-2xl font-bold text-[#5a4d3a] mb-6 text-center">Dashboard</h1>
<div class="main-content">
    <div class="bg-white rounded-lg shadow-xl p-5 border border-[#d4c8a8]">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <!-- Card Total Alat Musik -->
            <div class="bg-gradient-to-b from-[#a08963] to-[#5a4d3a] rounded-lg p-6 text-white">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-light">Total Alat Musik</p>
                        <h3 class="text-3xl font-bold">{{ $totalProduk }}</h3>
                    </div>
                    <div class="bg-white bg-opacity-20 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card Total Users -->
            <div class="bg-gradient-to-b from-[#a08963] to-[#5a4d3a] rounded-lg p-6 text-white">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-light">Total Pelanggan</p>
                        <h3 class="text-3xl font-bold">{{ $totalPelanggan }}</h3>
                    </div>
                    <div class="bg-white bg-opacity-20 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card Total Pemesan -->
            <div class="bg-gradient-to-b from-[#a08963] to-[#5a4d3a] rounded-lg p-6 text-white">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-light">Total Pemesan</p>
                        <h3 class="text-3xl font-bold">{{ $totalPemesanan }}</h3>
                    </div>
                    <div class="bg-white bg-opacity-20 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card Total Peminjam Aktif -->
            <div class="bg-gradient-to-b from-[#a08963] to-[#5a4d3a] rounded-lg p-6 text-white">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-light">Total Peminjam Aktif</p>
                        <h3 class="text-3xl font-bold">{{ $peminjamAktif }}</h3>
                    </div>
                    <div class="bg-white bg-opacity-20 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card Total Pengembalian -->
            <div class="bg-gradient-to-b from-[#a08963] to-[#5a4d3a] rounded-lg p-6 text-white">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-light">Total Pengembalian</p>
                        <h3 class="text-3xl font-bold">{{ $totalPengembalian }}</h3>
                    </div>
                    <div class="bg-white bg-opacity-20 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card Total Pendapatan -->
            <div class="bg-gradient-to-b from-[#a08963] to-[#5a4d3a] rounded-lg p-6 text-white">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-light">Total Pendapatan</p>
                        <h3 class="text-3xl font-bold">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                    </div>
                    <div class="bg-white bg-opacity-20 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection