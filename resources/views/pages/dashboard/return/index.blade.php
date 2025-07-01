@extends('layouts.main')

@section('title', 'Inshony - Data Pengembalian')

@section('content')
<h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Data Pengembalian</h1>
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        @if(request('rental_id'))
            <a href="{{ route('returns.index') }}" class="text-sm text-blue-600 hover:text-blue-800">
                Kembali ke semua pengembalian
            </a>
        @endif
    </div>

    @if(request('rental_id'))
        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-blue-700">
                        Anda sedang memproses pengembalian untuk pemesanan #{{ request('rental_id') }}. 
                        Silahkan isi form di bawah ini.
                    </p>
                </div>
            </div>
        </div>
    @endif

    <!-- Return History -->
    <div class="card bg-white shadow-sm rounded-lg">
        <div class="card-body p-6">
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-[#a08963]">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">No. Pemesanan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Pelanggan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Tanggal Pesan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Tanggal Kembali</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Kondisi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Denda</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($returns as $return)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $return->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">#{{ $return->id_pemesanan }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $return->nama_pelanggan }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($return->tanggal_pemesanan)->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($return->tanggal_pengembalian)->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @switch($return->kondisi)
                                    @case('sangat_baik')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Sangat Baik
                                        </span>
                                        @break
                                    @case('baik')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            Baik
                                        </span>
                                        @break
                                    @case('rusak')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Rusak
                                        </span>
                                        @break
                                    @case('hilang')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Hilang
                                        </span>
                                        @break
                                @endswitch
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap font-bold {{ $return->denda > 0 ? 'text-red-600' : 'text-green-600' }}">
                                {{ $return->denda ? 'Rp ' . number_format($return->denda, 0, ',', '.') : '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button onclick="showDetailModal('{{ $return->id }}')" 
                                        class="text-xs bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md transition-colors">
                                    Detail
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada data pengembalian
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Detail Modal -->
@foreach($returns as $return)
<div id="modal-detail-{{ $return->id }}" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-6 pt-6 pb-4">
                <h3 class="text-xl font-semibold text-gray-900 mb-4 border-b pb-2">Detail Pengembalian</h3>
                <div class="grid grid-cols-1 gap-4">
                    <div class="grid grid-cols-3 gap-2">
                        <!-- Konten modal -->
                        <div class="text-gray-500 font-medium">ID Pengembalian</div>
                        <div class="col-span-2">{{ $return->id }}</div>
                        
                        <div class="text-gray-500 font-medium">No. Pemesanan</div>
                        <div class="col-span-2">#{{ $return->id_pemesanan }}</div>
                        
                        <div class="text-gray-500 font-medium">Pelanggan</div>
                        <div class="col-span-2">{{ $return->nama_pelanggan }}</div>
                        
                        <div class="text-gray-500 font-medium">Tanggal Pemesanan</div>
                        <div class="col-span-2">{{ \Carbon\Carbon::parse($return->tanggal_pemesanan)->format('d/m/Y H:i') }}</div>
                        
                        <div class="text-gray-500 font-medium">Tanggal Pengembalian</div>
                        <div class="col-span-2">{{ $return->tanggal_pengembalian->format('d/m/Y H:i') }}</div>
                        
                        <div class="text-gray-500 font-medium">Kondisi</div>
                        <div class="col-span-2">
                            @switch($return->kondisi)
                                @case('sangat_baik')
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Sangat Baik</span>
                                    @break
                                @case('baik')
                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">Baik</span>
                                    @break
                                @case('rusak')
                                    <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">Rusak</span>
                                    @break
                                @case('hilang')
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Hilang</span>
                                    @break
                                @default
                                    <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-full text-xs">-</span>
                            @endswitch
                        </div>
                        
                        <div class="text-gray-500 font-medium">Denda</div>
                        <div class="col-span-2">{{ $return->denda ? 'Rp '.number_format($return->denda, 0, ',', '.') : '-' }}</div>
                        
                        <div class="text-gray-500 font-medium">Catatan</div>
                        <div class="col-span-2">{{ $return->catatan ?? '-' }}</div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-6 py-4 flex justify-end">
                <button onclick="closeModal('modal-detail-{{ $return->id }}')" 
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition-colors">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
    // Fungsi untuk menutup modal
    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }
    
    // Fungsi untuk membuka modal
    function showDetailModal(modalId) {
        document.getElementById('modal-detail-' + modalId).classList.remove('hidden');
    }
</script>
@endsection