@extends('layouts.main')

@section('title', 'Isnphony - Kelola Produk')

@section('content')
<h1 class="text-2xl font-bold text-center">Kelola Produk</h1>
<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <button class="btn btn-primary mb-4" onclick="document.getElementById('modal-tambah').showModal()">
        Tambah Produk
        </button>
    </div>
@include('pages.dashboard.product.create')
    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Nama Produk</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Kategori</th>
                    <th>Rating</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produks as $index => $produk)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        @if($produk->path_gambar)
                            <img src="{{ asset($produk->path_gambar) }}" class="w-28 h-14 object-cover">
                        @else
                            <div class="w-16 h-16 bg-gray-200 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                    </td>
                    <td>{{ $produk->nama }}</td>
                    <td>{{ $produk->deskripsi }}</td>
                    <td>Rp{{ number_format($produk->harga, 0, ',', '.') }}</td>
                    <td>{{ $produk->stok }}</td>
                    <td>
                            {{ $produk->kategori }}
                    </td>
                    <td>
                        <div class="flex items-center">
                            <span class="text-yellow-500 mr-1">{{ $produk->rating_rata }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <span class="text-gray-500 text-sm ml-1">({{ $produk->total_ulasan }})</span>
                        </div>
                    </td>
                    <td class="vertical-align: middle;">
                        <div class="flex gap-2">
                            <!-- Tombol edit (modal) -->
                            <button onclick="document.getElementById('editModal-{{ $produk->id }}').showModal()" class="btn btn-sm btn-warning">Ubah</button>
                            <!-- Tombol hapus -->
                            <form action="{{ route('dashboard.produk.destroy', $produk->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-error">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>

                <!-- Modal Ubah Produk -->
                @include('pages.dashboard.product.edit')
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection