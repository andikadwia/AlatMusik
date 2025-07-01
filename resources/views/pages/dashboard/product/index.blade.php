@extends('layouts.main')

@section('title', 'Isnphony - Kelola Produk')

@section('content')
<h1 class="text-2xl font-bold text-center">Kelola Produk</h1>
<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <button class="btn btn-primary" onclick="document.getElementById('modal-tambah').showModal()">
            Tambah Produk
        </button>
    </div>

    @include('pages.dashboard.product.create')

    <!-- Tabel Produk -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="table w-full" id="products-table">
            <thead class="bg-[#a08963]">
                <tr>
                    <th scope="col" class="w-12 px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">No</th>
                    <th scope="col" class="w-32 px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Gambar</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Nama Produk</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Deskripsi</th>
                    <th scope="col" class="w-24 px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Harga</th>
                    <th scope="col" class="w-16 px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Stok</th>
                    <th scope="col" class="w-24 px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Kategori</th>
                    <th scope="col" class="w-32 px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Rating</th>
                    <th scope="col" class="w-32 px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produks as $index => $produk)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if($produk->path_gambar)
                                @php
                                    $images = explode('|', $produk->path_gambar);
                                    $firstImage = $images[0];
                                @endphp
                                <div class="relative group">
                                    <img src="{{ asset($firstImage) }}" 
                                         class="w-28 h-28 object-cover rounded"
                                         alt="Thumbnail Produk">
                                    <div class="hidden group-hover:block absolute z-10 bottom-full left-0 bg-white p-2 shadow-lg rounded-lg w-64">
                                        <div class="grid grid-cols-2 gap-2">
                                            @foreach($images as $image)
                                                <img src="{{ asset($image) }}" 
                                                     class="w-full h-30 object-cover border"
                                                     alt="Gambar Produk {{ $loop->iteration }}">
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="w-16 h-16 bg-gray-200 flex items-center justify-center rounded">
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
                        <td>{{ $produk->kategori }}</td>
                        <td>
                            <div class="flex items-center">
                                <span class="text-yellow-500 mr-1">{{ $produk->rating_rata }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="text-gray-500 text-sm ml-1">({{ $produk->total_ulasan }})</span>
                            </div>
                        </td>
                        <td>
                            <div class="flex gap-2">
                                <button onclick="document.getElementById('editModal-{{ $produk->id }}').showModal()" 
                                        class="btn btn-sm btn-warning">Ubah</button>
                                <form action="{{ route('dashboard.produk.destroy', $produk->id) }}" method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-error">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-4">
                            @if(request('search'))
                                Produk tidak ditemukan
                            @else
                                Belum ada produk
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Edit -->
@foreach($produks as $produk)
    @include('pages.dashboard.product.edit', ['produk' => $produk])
@endforeach

@endsection