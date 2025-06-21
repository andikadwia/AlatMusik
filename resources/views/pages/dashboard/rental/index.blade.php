@extends('layouts.main')

@section('title', 'Inshony - Data Penyewaan')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Data Penyewa Aktif</h1>

    <div class="card bg-white shadow-sm rounded-lg mb-8">
        <div class="card-body p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pemesan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Sewa</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($rentals as $rental)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">#{{ $rental->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $rental->nama_pelanggan }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $rental->tanggal_pemesanan }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @switch($rental->status_penyewaan)
                                    @case('belum_dipinjam')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Belum Dipinjam
                                        </span>
                                        @break
                                    @case('sedang_dipinjam')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            Sedang Dipinjam
                                        </span>
                                        @break
                                    @default
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                            Belum Dipinjam
                                        </span>
                                @endswitch
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button onclick="showUpdateStatusModal({{ $rental->id }}, '{{ $rental->status_penyewaan }}')" 
                                        class="text-xs bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md mr-2">
                                    Ubah Status
                                </button>
                                
                                @if ($rental->status_penyewaan == 'sedang_dipinjam')
                                <button onclick="showPengembalianModal({{ $rental->id }})"
                                    class="text-xs bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-md">
                                    Proses Pengembalian
                                </button>
                                 @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada data penyewaan aktif
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include ('pages.dashboard.rental.ubah')
@include ('pages.dashboard.rental.proses')
@endsection