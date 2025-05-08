@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Sidebar Profil -->
            <div class="w-full md:w-64 lg:w-80 flex-shrink-0">
                <div class="bg-white rounded-lg shadow-sm p-6 h-[calc(114vh-4rem)] flex flex-col">
                    <!-- Foto Profil dan Info -->
                    <div class="flex flex-col items-center">
                        <div class="relative mb-4">
                            <img src="{{ asset('images/gitar.jpg') }}" 
                                 alt="Avatar" 
                                 class="w-24 h-24 rounded-full object-cover border-2 border-primary">
                        </div>
                        <h2 class="text-xl font-bold text-gray-800">denyri123</h2>
                        <h3 class="text-gray-600 text-sm">denyri123@gmail.com</h3>
                    </div>

                    <!-- Menu Navigasi -->
                    <nav class="mt-8">
                        <ul class="space-y-2">
                            <li>
                                <a href="{{ route('profile') }}" class="flex items-center px-4 py-2 text-gray-600 hover:text-primary hover:bg-gray-100 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Informasi Profil
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('orders') }}" class="flex items-center px-4 py-2 text-primary bg-primary/10 rounded-lg font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    Riwayat Sewa
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="#">
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

            <!-- Konten Utama -->
            <div class="flex-1">
                <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-800">Riwayat Penyewaan</h2>
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

                    <!-- Daftar Riwayat (Data Dummy) -->
                    <div class="space-y-4">
                        <!-- Item 1 -->
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('images/gitar.jpg') }}" alt="Gitar" class="w-16 h-16 object-cover rounded-lg">
                                    </div>
                                    <div>
                                        <h3 class="font-medium text-gray-800">Sewa Gitar Akustik</h3>
                                        <p class="text-sm text-gray-600 mt-1">
                                            <span class="font-medium">Periode:</span> 15 Jan 2023 - 20 Jan 2023
                                        </p>
                                        <p class="text-sm text-gray-600">
                                            <span class="font-medium">Durasi:</span> 5 hari
                                        </p>
                                        <div class="mt-2">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Selesai
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-gray-800">Rp 1.000.000</p>
                                    <p class="text-sm text-gray-600 mt-1">
                                        Transfer Bank
                                    </p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        14 Jan 2023 10:30
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Tombol Aksi -->
                            <div class="flex justify-end space-x-2 mt-4">
                                <button class="px-3 py-1 border border-gray-300 text-gray-700 text-sm rounded-lg hover:bg-gray-50 transition-colors">
                                    Detail
                                </button>
                                <button class="px-3 py-1 border border-gray-300 text-gray-700 text-sm rounded-lg hover:bg-gray-50 transition-colors">
                                    Unduh Invoice
                                </button>
                            </div>
                        </div>

                        <!-- Item 2 -->
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('images/gitar.jpg') }}" alt="Gitar" class="w-16 h-16 object-cover rounded-lg">
                                    </div>
                                    <div>
                                        <h3 class="font-medium text-gray-800">Sewa Gitar Elektrik</h3>
                                        <p class="text-sm text-gray-600 mt-1">
                                            <span class="font-medium">Periode:</span> 1 Feb 2023 - 5 Feb 2023
                                        </p>
                                        <p class="text-sm text-gray-600">
                                            <span class="font-medium">Durasi:</span> 4 hari
                                        </p>
                                        <div class="mt-2">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Menunggu Pembayaran
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-gray-800">Rp 800.000</p>
                                    <p class="text-sm text-gray-600 mt-1">
                                        Pembayaran Langsung
                                    </p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        30 Jan 2023 14:15
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Tombol Aksi -->
                            <div class="flex justify-end space-x-2 mt-4">
                                <button class="px-3 py-1 border border-gray-300 text-gray-700 text-sm rounded-lg hover:bg-gray-50 transition-colors">
                                    Detail
                                </button>
                                <button class="px-3 py-1 bg-primary text-white text-sm rounded-lg hover:bg-primary-dark transition-colors">
                                    Bayar Sekarang
                                </button>
                                <button class="px-3 py-1 bg-red-100 text-red-700 text-sm rounded-lg hover:bg-red-200 transition-colors">
                                    Batalkan
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Contoh Empty State -->
                    <!--
                    <div class="text-center py-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <h3 class="mt-2 text-lg font-medium text-gray-900">Belum ada riwayat sewa</h3>
                        <p class="mt-1 text-gray-500">Anda belum melakukan penyewaan apapun.</p>
                        <div class="mt-6">
                            <a href="#" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors">
                                Sewa Sekarang
                            </a>
                        </div>
                    </div>
                    -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection