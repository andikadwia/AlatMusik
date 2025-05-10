@extends('layouts.main')

@section('title', 'Inshony - Data Pengembalian')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Data Pengembalian</h1>

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
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Pemesanan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pesan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Kembali</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kondisi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Denda</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($returns as $return)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $return->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">#{{ $return->id_pemesanan }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $return->nama_pelanggan }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $return->tanggal_pemesanan }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $return->tanggal_pengembalian->format('d/m/Y H:i') }}</td>
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
                                <button onclick="showDetailModal({{ json_encode($return) }})" 
                                        class="text-xs bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md">
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
<div id="modal-detail" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Detail Pengembalian</h3>
                <div id="detail-content" class="space-y-2">
                    <!-- Content will be filled by JavaScript -->
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="closeModal('modal-detail')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function showDetailModal(data) {
        const content = document.getElementById('detail-content');
        const kondisi = {
            'sangat_baik': 'Sangat Baik',
            'baik': 'Baik',
            'rusak': 'Rusak',
            'hilang': 'Hilang'
        };
        
        content.innerHTML = `
            <div class="space-y-2">
                <p><strong>ID Pengembalian:</strong> ${data.id}</p>
                <p><strong>No. Pemesanan:</strong> #${data.id_pemesanan}</p>
                <p><strong>Pelanggan:</strong> ${data.nama_pelanggan}</p>
                <p><strong>Tanggal Pemesanan:</strong> ${data.tanggal_pemesanan}</p>
                <p><strong>Tanggal Pengembalian:</strong> ${new Date(data.tanggal_pengembalian).toLocaleString()}</p>
                <p><strong>Kondisi:</strong> ${kondisi[data.kondisi] || '-'}</p>
                <p><strong>Denda:</strong> ${data.denda ? 'Rp ' + data.denda.toLocaleString('id-ID') : '-'}</p>
                <p><strong>Catatan:</strong> ${data.catatan || '-'}</p>
            </div>
        `;
        
        document.getElementById('modal-detail').classList.remove('hidden');
    }
    
    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }
</script>
@endsection