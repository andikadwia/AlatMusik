@extends('layouts.main')

@section('title', 'Inshony - Data Pelanggan')

@section('content')
<h1 class="text-2xl font-bold text-center">Data Pelanggan</h1>
<div class="container mx-auto px-4 py-6">
    <div class="card bg-white shadow-sm rounded-lg mb-8">
        <div class="card-body p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telepon</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Bergabung</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($pelanggans as $pelanggan)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $pelanggan->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $pelanggan->nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $pelanggan->email ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $pelanggan->telepon }}</td>
                            <td class="px-6 py-4">{{ $pelanggan->alamat ?? 'Alamat belum diisi' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $pelanggan->dibuat_pada->format('d/m/Y H:i') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada data pelanggan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection