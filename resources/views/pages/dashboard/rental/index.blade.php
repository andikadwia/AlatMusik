@extends('layouts.main')

@section('title', 'Inshony - Data Penyewaan')

@section('content')
<h1 class="text-2xl font-bold text-[#5a4d3a] mb-6 text-center">Data Penyewa Aktif</h1>
<div class="container mx-auto px-4 py-6">
    <div class="bg-white shadow rounded-lg overflow-hidden border border-[#d4c8a8]">
        <table class="min-w-full divide-y divide-[#d4c8a8]">
            <thead class="bg-[#a08963]">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">Pemesan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">Tanggal Sewa</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-[#d4c8a8]">
                @forelse ($rentals as $rental)
                <tr class="hover:bg-[#f5f1e9] transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[#5a4d3a]">#{{ $rental->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[#5a4d3a] font-medium">{{ $rental->nama_pelanggan }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[#5a4d3a]">{{ \Carbon\Carbon::parse($rental->tanggal_pemesanan)->format('d M Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @switch($rental->status_penyewaan)
                            @case('belum_dipinjam')
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-[#f5e8c9] text-[#8a7555]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Belum Dipinjam
                                </span>
                                @break
                            @case('sedang_dipinjam')
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-[#e3f2e9] text-[#4a7c5f]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Sedang Dipinjam
                                </span>
                                @break
                            @default
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    Unknown
                                </span>
                        @endswitch
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex gap-2">
                            <button onclick="showUpdateStatusModal('{{ $rental->id }}', '{{ $rental->status_penyewaan }}')" 
                                    class="bg-[#d4c8a8] hover:bg-[#c5b797] text-[#5a4d3a] px-3 py-1 rounded-lg transition-colors text-xs flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Ubah Status
                            </button>
                            
                            @if ($rental->status_penyewaan == 'sedang_dipinjam')
                                <button onclick="showPengembalianModal('{{ $rental->id }}')"
                                class="bg-[#9c6644] hover:bg-[#8a5a3a] text-white px-3 py-1 rounded-lg transition-colors text-xs flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                                Proses Pengembalian
                            </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-[#5a4d3a]">
                        <div class="flex flex-col items-center justify-center py-8">
                            <p class="mt-2 text-sm">Tidak ada data penyewaan aktif</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@include('pages.dashboard.rental.ubah')
@include('pages.dashboard.rental.proses')

@endsection