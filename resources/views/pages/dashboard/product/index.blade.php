@extends('layouts.main')

@section('title', 'Isnphony - Kelola Produk')

@section('content')
<h1 class="text-2xl font-bold text-center text-[#5a4d3a] mb-6">Kelola Produk</h1>
<div class="p-6">
    <!-- Header with Add Button -->
    <div class="flex justify-between items-center mb-6">
        <button 
            class="bg-[#a08963] hover:bg-[#8a7555] text-white px-4 py-2 rounded-lg transition-colors shadow-md"
            onclick="document.getElementById('modal-tambah').showModal()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Tambah Produk
        </button>
    </div>

    @include('pages.dashboard.product.create')

    <!-- Products Table -->
    <div class="bg-white shadow rounded-lg overflow-hidden border border-[#d4c8a8]">
        <table class="min-w-full divide-y divide-[#d4c8a8]" id="products-table">
            <thead class="bg-[#a08963]">
                <tr>
                    <th scope="col" class="w-12 px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">No</th>
                    <th scope="col" class="w-32 px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">Gambar</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">Nama Produk</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">Deskripsi</th>
                    <th scope="col" class="w-24 px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">Harga</th>
                    <th scope="col" class="w-16 px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">Stok</th>
                    <th scope="col" class="w-24 px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">Kategori</th>
                    <th scope="col" class="w-32 px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">Rating</th>
                    <th scope="col" class="w-32 px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-[#d4c8a8]">
                @forelse($produks as $index => $produk)
                    <tr class="hover:bg-[#f5f1e9] transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-[#5a4d3a]">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($produk->path_gambar)
                                @php
                                    $images = explode('|', $produk->path_gambar);
                                    $firstImage = $images[0];
                                @endphp
                                <div class="relative group">
                                    <img src="{{ asset($firstImage) }}" 
                                         class="w-16 h-16 object-cover rounded border border-[#d4c8a8]"
                                         alt="Thumbnail Produk">
                                    <div class="hidden group-hover:block absolute z-10 bottom-full left-0 bg-white p-2 shadow-lg rounded-lg w-64 border border-[#d4c8a8]">
                                        <div class="grid grid-cols-2 gap-2">
                                            @foreach($images as $image)
                                                <img src="{{ asset($image) }}" 
                                                     class="w-full h-24 object-cover border border-[#d4c8a8]"
                                                     alt="Gambar Produk {{ $loop->iteration }}">
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="w-16 h-16 bg-[#f5f1e9] flex items-center justify-center rounded border border-[#d4c8a8]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#a08963]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-[#5a4d3a]">{{ $produk->nama }}</td>
                        <td class="px-6 py-4 text-sm text-[#5a4d3a] max-w-xs">
                            <div class="description-cell" data-full-text="{{ $produk->deskripsi }}">
                                <span class="description-text">
                                    {{ Str::limit($produk->deskripsi, 100) }}
                                </span>
                                @if(strlen($produk->deskripsi) > 100)
                                    <button class="read-more-btn text-[#a08963] hover:text-[#8a7555] underline text-xs ml-1" 
                                            onclick="toggleDescription(this)">
                                        Selengkapnya
                                    </button>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-[#5a4d3a]">Rp{{ number_format($produk->harga, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-[#5a4d3a]">{{ $produk->stok }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-[#5a4d3a]">
                            <span class="px-2 py-1 bg-[#f5f1e9] rounded-full text-xs">{{ $produk->kategori }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <span class="text-[#d4a017] mr-1 text-sm">{{ $produk->rating_rata }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#d4a017]" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="text-[#a08963] text-xs ml-1">({{ $produk->total_ulasan }})</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex gap-2">
                                <button onclick="document.getElementById('editModal-{{ $produk->id }}').showModal()" 
                                        class="bg-[#d4c8a8] hover:bg-[#c5b797] text-[#5a4d3a] px-3 py-1 rounded-lg transition-colors text-xs">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                    Ubah
                                </button>
                                            <form action="{{ route('dashboard.produk.destroy', $produk->id) }}" method="POST" id="delete-form-{{ $produk->id }}">
                @csrf @method('DELETE')
                <button type="button" 
                        class="bg-[#9c6644] hover:bg-[#8a5a3a] text-white px-3 py-1 rounded-lg transition-colors text-xs"onclick="confirmDelete({{ $produk->id }})">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    Hapus
                </button>
            </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-6 py-4 text-center text-[#5a4d3a]">
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
<script>
function toggleDescription(button) {
    const cell = button.closest('.description-cell');
    const textSpan = cell.querySelector('.description-text');
    const fullText = cell.getAttribute('data-full-text');
    const isExpanded = button.textContent === 'Sembunyikan';
    
    if (isExpanded) {
        // Collapse
        textSpan.textContent = fullText.substring(0, 100) + '...';
        button.textContent = 'Selengkapnya';
    } else {
        // Expand
        textSpan.textContent = fullText;
        button.textContent = 'Sembunyikan';
    }
}
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Konfirmasi Penghapusan',
        html: '<div class="text-left"><p class="mb-4">Data yang dihapus tidak dapat dikembalikan. Yakin ingin melanjutkan?</p></div>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#5a4d3a',
        cancelButtonColor: '#d4c8a8',
        confirmButtonText: '<span class="font-medium px-3">Ya, Hapus</span>',
        cancelButtonText: '<span class="font-medium px-3">Batalkan</span>',
        buttonsStyling: true,
        allowOutsideClick: false,
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
        },
        customClass: {
            container: 'font-sans',
            popup: 'rounded-lg shadow-xl',
            header: 'border-b border-gray-200',
            title: 'text-xl font-semibold text-gray-800',
            content: 'text-gray-600',
            actions: 'gap-3 mt-4',
            confirmButton: 'shadow-md hover:bg-[#4a3f32] transition-colors',
            cancelButton: 'border border-gray-300 hover:bg-gray-100 transition-colors'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Dihapus!',
                text: 'Data telah berhasil dihapus.',
                icon: 'success',
                confirmButtonColor: '#5a4d3a',
                timer: 1500
            }).then(() => {
                document.getElementById('delete-form-' + id).submit();
            });
        }
    });
}
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<!-- Modal Edit -->
@foreach($produks as $produk)
    @include('pages.dashboard.product.edit', ['produk' => $produk])
@endforeach

@endsection