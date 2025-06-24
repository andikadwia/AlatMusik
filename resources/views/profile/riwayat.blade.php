@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="container mx-auto px-4">
        <!-- Tombol Kembali ke Beranda -->
        <button onclick="window.location.href='{{ url('/') }}'" 
                class="mb-4 flex items-center px-4 py-2 bg-white text-primary border border-primary rounded-lg hover:bg-primary/10 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Beranda
        </button>
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Sidebar Profile -->
            <div class="w-full md:w-64 lg:w-80 flex-shrink-0">
                <div class="bg-white rounded-lg shadow-sm p-6 h-[calc(114vh-4rem)] flex flex-col">
                    <!-- User Profile Image and Info -->
                    <div class="flex flex-col items-center">
                        <div class="relative mb-4">
                            <img src="{{ $user->foto_profil ? asset($user->foto_profil) : asset('images/gitar.jpg') }}" 
                                alt="Foto Profil" 
                                class="w-24 h-24 rounded-full object-cover border-2 border-primary">
                        </div>
                        <h2 class="text-xl font-bold text-gray-800">{{ $user->name }}</h2>
                        <h3 class="text-gray-600 text-sm">{{ $user->email }}</h3>
                    </div>

                    <!-- Navigation Menu -->
                    <nav class="mt-8">
                        <ul class="space-y-2">
                            <li>
                                <a href="{{ route('profile') }}" class="flex items-center px-4 py-2 text-gray-600 hover:text-primary hover:bg-gray-100 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Informasi Pribadi
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('riwayat') }}" class="flex items-center px-4 py-2 text-primary bg-primary/10 rounded-lg font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    Riwayat Sewa
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
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

            <!-- Main Content -->
            <div class="flex-1">
                <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                    <!-- Header dan Filter -->
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-800">Riwayat Penyewaan</h2>
                        @if(session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded text-sm">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>

                    <!-- Daftar Riwayat -->
                    <div class="space-y-4">
                        @forelse($pemesanans as $pemesanan)
                        @php
                            $item = $pemesanan->items->first();
                            $produk = $item->produk ?? null;
                            $gambar = $produk->path_gambar ? explode('|', $produk->path_gambar)[0] : 'images/gitar.jpg';
                            
                            // Status dan class
                            if ($pemesanan->status_penyewaan == 'belum_dipinjam') {
                                $status = 'Menunggu Pengambilan';
                                $statusClass = 'bg-blue-100 text-blue-800';
                            } elseif ($pemesanan->status_penyewaan == 'sedang_dipinjam') {
                                $status = 'Sedang Dipinjam';
                                $statusClass = 'bg-yellow-100 text-yellow-800';
                            } elseif ($pemesanan->status_penyewaan == 'sudah_dikembalikan') {
                                $status = 'Selesai';
                                $statusClass = 'bg-green-100 text-green-800';
                            } else {
                                $status = 'Menunggu Pembayaran';
                                $statusClass = 'bg-gray-100 text-gray-800';
                            }

                            // Durasi
                            $duration = '-';
                            if ($pemesanan->tanggal_mulai && $pemesanan->tanggal_selesai) {
                                $tanggalMulai = \Carbon\Carbon::parse($pemesanan->tanggal_mulai);
                                $tanggalSelesai = \Carbon\Carbon::parse($pemesanan->tanggal_selesai);
                                $duration = $tanggalMulai->diffInDays($tanggalSelesai) . ' hari';
                            }
                        @endphp

                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow"
                            data-pemesanan-id="{{ $pemesanan->id }}"
                            data-produk-nama="{{ $produk->nama ?? 'Alat Musik' }}"
                            data-produk-gambar="{{ asset($gambar) }}"
                            data-produk-harga="{{ $produk->harga_sewa ?? 0 }}"
                            data-tanggal-mulai="{{ $pemesanan->tanggal_mulai ? \Carbon\Carbon::parse($pemesanan->tanggal_mulai)->format('d M Y') : '-' }}"
                            data-tanggal-selesai="{{ $pemesanan->tanggal_selesai ? \Carbon\Carbon::parse($pemesanan->tanggal_selesai)->format('d M Y') : '-' }}"
                            data-durasi="{{ $duration }}"
                            data-metode-pembayaran="{{ $pemesanan->verifikasiPembayaran ? 'Transfer Bank' : 'Pembayaran Langsung' }}"
                            data-total-harga="{{ $pemesanan->total_harga }}"
                            data-status="{{ $status }}"
                            data-status-class="{{ $statusClass }}"
                            data-tanggal-pemesanan="{{ $pemesanan->tanggal_pemesanan ? \Carbon\Carbon::parse($pemesanan->tanggal_pemesanan)->format('d M Y H:i') : '-' }}">

                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset($gambar) }}" alt="{{ $produk->nama ?? 'Alat Musik' }}" class="w-16 h-16 object-cover rounded-lg">
                                    </div>
                                    <div>
                                        <h3 class="font-medium text-gray-800">{{ $produk->nama ?? 'Alat Musik' }}</h3>
                                        <p class="text-sm text-gray-600 mt-1">
                                            <span class="font-medium">Periode:</span> 
                                            {{ $pemesanan->tanggal_mulai ? \Carbon\Carbon::parse($pemesanan->tanggal_mulai)->format('d M Y') : '-' }} - 
                                            {{ $pemesanan->tanggal_selesai ? \Carbon\Carbon::parse($pemesanan->tanggal_selesai)->format('d M Y') : '-' }}
                                        </p>
                                        <p class="text-sm text-gray-600">
                                            <span class="font-medium">Durasi:</span> {{ $duration }}
                                        </p>
                                        <div class="mt-2">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusClass }}">
                                                {{ $status }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-gray-800">Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</p>
                                    <p class="text-sm text-gray-600 mt-1">
                                        {{ $pemesanan->verifikasiPembayaran ? 'Transfer Bank' : 'Pembayaran Langsung' }}
                                    </p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $pemesanan->tanggal_pemesanan ? \Carbon\Carbon::parse($pemesanan->tanggal_pemesanan)->format('d M Y H:i') : '-' }}
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Tombol Aksi -->
                            <div class="flex justify-end space-x-2 mt-4">
                                <button onclick="showDetailModal(this.closest('[data-pemesanan-id]'))" 
                                        class="px-3 py-1 border border-gray-300 text-gray-700 text-sm rounded-lg hover:bg-gray-50 transition-colors">
                                    Detail
                                </button>
                                <a href="{{ route('pemesanan.invoice', $pemesanan->id) }}" 
                                    class="px-3 py-1 border border-gray-300 text-gray-700 text-sm rounded-lg hover:bg-gray-50 transition-colors">
                                    Unduh Invoice
                                </a>
                                    <!-- Tombol Beri Ulasan tanpa syarat status -->
    <button onclick="document.getElementById('ulasan-form-{{ $pemesanan->id }}').classList.toggle('hidden')"
            class="px-3 py-1 border border-gray-300 text-gray-700 text-sm rounded-lg hover:bg-gray-50 transition-colors">
        Beri Ulasan
    </button>
</div>
<div id="ulasan-form-{{ $pemesanan->id }}" class="mt-4 border p-6 rounded-lg bg-white shadow-sm hidden">
    <h3 class="text-center text-lg font-bold mb-4">Ulasan</h3>
    
    <form action="{{ route('ulasan.store') }}" method="POST">
        @csrf
        <input type="hidden" name="id_pemesanan" value="{{ $pemesanan->id }}">
        <input type="hidden" name="id_produk" value="{{ $item->id_produk }}">

        <!-- Rating -->
        <label for="rating-{{ $pemesanan->id }}" class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
        <div class="flex justify-center mb-4" id="rating-stars-{{ $pemesanan->id }}">
            @for ($i = 1; $i <= 5; $i++)
                <svg xmlns="http://www.w3.org/2000/svg" data-value="{{ $i }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" 
                     class="w-8 h-8 cursor-pointer star hover:scale-110 transition-transform text-yellow-400">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                          d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.618 4.985a1 1 0 00.95.69h5.246c.969 0 1.371 1.24.588 1.81l-4.244 3.085a1 1 0 00-.364 1.118l1.618 4.985c.3.921-.755 1.688-1.54 1.118l-4.244-3.085a1 1 0 00-1.176 0l-4.244 3.085c-.785.57-1.84-.197-1.54-1.118l1.618-4.985a1 1 0 00-.364-1.118L2.647 10.41c-.783-.57-.38-1.81.588-1.81h5.246a1 1 0 00.95-.69l1.618-4.985z" />
                </svg>
            @endfor
        </div>
        <input type="hidden" name="rating" id="rating-input-{{ $pemesanan->id }}" required>

        <!-- Komentar -->
        <label for="komentar" class="block text-sm font-medium text-gray-700 mb-2">Ulasan</label>
        <textarea name="komentar" rows="4" placeholder="Bagikan pengalaman anda..." 
                  class="w-full border border-gray-300 p-3 rounded-lg mb-4 resize-none focus:outline-none focus:ring-2 focus:ring-yellow-400" required></textarea>

        <button type="submit" 
                class="w-full bg-[#a47a4e] hover:bg-[#8b623a] text-white py-2 rounded-lg font-semibold transition-colors">
            Kirim
        </button>
    </form>
</div>

<script>
    // Bintang interaktif per pemesanan
    document.querySelectorAll('#rating-stars-{{ $pemesanan->id }} .star').forEach(star => {
        star.addEventListener('click', function () {
            const selectedValue = this.getAttribute('data-value');
            document.getElementById('rating-input-{{ $pemesanan->id }}').value = selectedValue;

            const stars = document.querySelectorAll('#rating-stars-{{ $pemesanan->id }} .star');
            stars.forEach((s, index) => {
                s.setAttribute('fill', index < selectedValue ? 'currentColor' : 'none');
            });
        });
    });
</script>

                            </div>
                        </div>
                        @empty
                        <div class="text-center py-8">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <h3 class="mt-2 text-lg font-medium text-gray-900">Belum ada riwayat penyewaan</h3>
                            <p class="mt-1 text-sm text-gray-500">Anda belum pernah menyewa alat musik di Insphony.</p>
                            <div class="mt-6">
                                <a href="{{ route('produk.index') }}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors inline-flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Sewa Alat Musik
                                </a>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Container -->
<div id="detailModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            <!-- Modal content akan diisi oleh JavaScript -->
        </div>
    </div>
</div>

<script>
    function showDetailModal(pemesananElement) {
        const modal = document.getElementById('detailModal');
        const modalContent = modal.querySelector('div > div');
        
        // Ambil data dari element
        const data = {
            id: pemesananElement.getAttribute('data-pemesanan-id'),
            produkNama: pemesananElement.getAttribute('data-produk-nama'),
            produkGambar: pemesananElement.getAttribute('data-produk-gambar'),
            produkHarga: pemesananElement.getAttribute('data-produk-harga'),
            tanggalMulai: pemesananElement.getAttribute('data-tanggal-mulai'),
            tanggalSelesai: pemesananElement.getAttribute('data-tanggal-selesai'),
            durasi: pemesananElement.getAttribute('data-durasi'),
            metodePembayaran: pemesananElement.getAttribute('data-metode-pembayaran'),
            totalHarga: pemesananElement.getAttribute('data-total-harga'),
            status: pemesananElement.getAttribute('data-status'),
            statusClass: pemesananElement.getAttribute('data-status-class'),
            tanggalPemesanan: pemesananElement.getAttribute('data-tanggal-pemesanan')
        };

        // Format harga
        const formatRupiah = (number) => {
            return parseInt(number).toLocaleString('id-ID');
        };

        // Buat konten modal
        modalContent.innerHTML = `
            <!-- Modal Header -->
            <div class="flex justify-between items-center border-b p-4">
                <h3 class="text-lg font-bold">Detail Pemesanan #${data.id}</h3>
                <button onclick="hideDetailModal()" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Info Produk -->
                    <div>
                        <h4 class="font-medium text-gray-900 mb-2">Produk</h4>
                        <div class="flex items-start space-x-4">
                            <img src="${data.produkGambar}" alt="${data.produkNama}" class="w-16 h-16 object-cover rounded-lg">
                            <div>
                                <p class="font-medium">${data.produkNama}</p>
                                <p class="text-sm text-gray-600">Rp ${formatRupiah(data.produkHarga)}/hari</p>
                            </div>
                        </div>
                    </div>
                    <!-- Info Penyewaan -->
                    <div>
                        <h4 class="font-medium text-gray-900 mb-2">Periode Sewa</h4>
                        <p class="text-sm text-gray-600">${data.tanggalMulai} - ${data.tanggalSelesai}</p>
                        <p class="text-sm text-gray-600 mt-1"><span class="font-medium">Durasi:</span> ${data.durasi}</p>
                    </div>
                </div>
                <!-- Info Pembayaran -->
                <div class="mt-6 border-t pt-4">
                    <h4 class="font-medium text-gray-900 mb-2">Pembayaran</h4>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Metode</p>
                            <p class="font-medium">${data.metodePembayaran}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Total Harga</p>
                            <p class="font-medium">Rp ${formatRupiah(data.totalHarga)}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Status</p>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${data.statusClass}">
                                ${data.status}
                            </span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Tanggal Pemesanan</p>
                            <p class="font-medium">${data.tanggalPemesanan}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Footer -->
            <div class="border-t p-4 flex justify-end space-x-2">
                <button onclick="hideDetailModal()" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                    Tutup
                </button>
                <a href="/pemesanan/${data.id}/invoice" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">
                    Unduh Invoice
                </a>
            </div>
        `;

        // Tampilkan modal
        modal.classList.remove('hidden');
    }

    function hideDetailModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }

    // Tutup modal saat klik di luar konten
    document.getElementById('detailModal').addEventListener('click', function(e) {
        if (e.target === this) {
            hideDetailModal();
        }
    });
</script>
@endsection