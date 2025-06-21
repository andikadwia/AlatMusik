@extends('layouts.main')

@section('title', 'Insphony - Dasbor')

@section('content')
<div class="main-content">
    <div class="bg-white rounded-lg shadow-xl p-5">
        <h2 class="text-2xl font-bold mb-5">Dashboard</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mb-6">
            <!-- Card Total Alat Musik -->
            <div class="bg-gradient-to-b from-[#C9B194] to-[#3A3224] rounded-lg p-10 text-white">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-light">Total Alat Musik</p>
                        <h3 class="text-3xl font-bold">{{ $totalProduk }}</h3>
                    </div>
                    <div class="bg-white bg-opacity-20 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card Total Users -->
            <div class="bg-gradient-to-b from-[#C9B194] to-[#3A3224] rounded-lg p-10 text-white">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-light">Total Pelanggan</p>
                        <h3 class="text-3xl font-bold">{{ $totalPelanggan }}</h3>
                    </div>
                    <div class="bg-white bg-opacity-20 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card Total Pemesan -->
            <div class="bg-gradient-to-b from-[#C9B194] to-[#3A3224] rounded-lg p-10 text-white">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-light">Total Pemesan</p>
                        <h3 class="text-3xl font-bold">{{ $totalPemesanan }}</h3>
                    </div>
                    <div class="bg-white bg-opacity-20 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16h8M8 12h8m-8-4h8M4 6h16M4 10h16M4 14h16M4 18h16" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card Total Peminjam Aktif -->
            <div class="bg-gradient-to-b from-[#C9B194] to-[#3A3224] rounded-lg p-10 text-white">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-light">Total Peminjam Aktif</p>
                        <h3 class="text-3xl font-bold">{{ $peminjamAktif }}</h3>
                    </div>
                    <div class="bg-white bg-opacity-20 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 010 6.844L12 14z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card Total Pengembalian -->
            <div class="bg-gradient-to-b from-[#C9B194] to-[#3A3224] rounded-lg p-10 text-white">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-light">Total Pengembalian</p>
                        <h3 class="text-3xl font-bold">{{ $totalPengembalian }}</h3>
                    </div>
                    <div class="bg-white bg-opacity-20 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h4l3-3m0 0l3 3h4M5 20h14a2 2 0 002-2V10a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card Total Pendapatan -->
            <div class="bg-gradient-to-b from-[#C9B194] to-[#3A3224] rounded-lg p-10 text-white">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-light">Total Pendapatan</p>
                        <h3 class="text-3xl font-bold">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                    </div>
                    <div class="bg-white bg-opacity-20 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3h6c0-1.657-1.343-3-3-3zM5 12h14M7 16h10M9 20h6" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection