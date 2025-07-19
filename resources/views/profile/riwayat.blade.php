@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="container mx-auto px-4">
        <!-- Tombol Kembali ke Beranda -->
        <button onclick="window.location.href='{{ url('/') }}'" 
                class="mb-4 mt-4 flex items-center px-4 py-2 bg-white text-primary border border-primary rounded-lg hover:bg-primary/10 transition-colors">
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
                        <div class="relative mb-4 group">
                            @if($user->foto_profil)
                            <div class="relative cursor-pointer" id="profile-image-container">
                                <img src="{{ asset($user->foto_profil) }}" 
                                    alt="Foto Profil" 
                                    class="w-24 h-24 rounded-full object-cover border-2 border-primary"
                                    id="profile-image-preview">
                            </div>
                        @else
                            <div class="w-24 h-24 rounded-full bg-gradient-to-br from-primary to-primary-dark flex items-center justify-center text-white overflow-hidden border-2 border-primary">
                                <span class="text-3xl font-medium">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                </span>
                            </div>
                        @endif
                            
                        </div>
                        <h2 class="text-xl font-bold text-gray-800">{{ $user->name }}</h2>
                        <h3 class="text-gray-600 text-sm">{{ '' . $user->email }}</h3>
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
                            $jumlah = $item->jumlah ?? 1;
                            $ulasan = $pemesanan->ulasan->firstWhere('id_pengguna', auth()->id());
                            
                            // Default value
                            $status = 'Menunggu Pembayaran';
                            $statusClass = 'bg-gray-100 text-gray-800';
                            
                            // Cek verifikasi pembayaran
                            if ($pemesanan->verifikasiPembayaran) {
                                switch($pemesanan->verifikasiPembayaran->status_verifikasi) {
                                    case 'diterima':
                                        // Hanya tampilkan status penyewaan jika pembayaran diterima
                                        if ($pemesanan->status_penyewaan == 'belum_dipinjam') {
                                            $status = 'Menunggu Pengambilan';
                                            $statusClass = 'bg-blue-100 text-blue-800';
                                        } elseif ($pemesanan->status_penyewaan == 'sedang_dipinjam') {
                                            $status = 'Sedang Dipinjam';
                                            $statusClass = 'bg-yellow-100 text-yellow-800';
                                        } elseif ($pemesanan->status_penyewaan == 'sudah_dikembalikan') {
                                            $status = 'Sudah Dikembalikan';
                                            $statusClass = 'bg-green-100 text-green-800';
                                        }
                                        break;
                                    case 'menunggu':
                                        $status = 'Menunggu Verifikasi Pembayaran';
                                        $statusClass = 'bg-orange-100 text-orange-800';
                                        break;
                                    case 'ditolak':
                                        $status = 'Pembayaran Ditolak';
                                        $statusClass = 'bg-red-100 text-red-800';
                                        break;
                                }
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
                            data-jumlah="{{ $jumlah }}"
                            data-tanggal-mulai="{{ $pemesanan->tanggal_mulai ? \Carbon\Carbon::parse($pemesanan->tanggal_mulai)->format('d M Y') : '-' }}"
                            data-tanggal-selesai="{{ $pemesanan->tanggal_selesai ? \Carbon\Carbon::parse($pemesanan->tanggal_selesai)->format('d M Y') : '-' }}"
                            data-durasi="{{ $duration }}"
                            data-metode-pembayaran="{{ $pemesanan->verifikasiPembayaran ? ($pemesanan->verifikasiPembayaran->status_verifikasi === 'diterima' ? 'Transfer Bank' : ($pemesanan->verifikasiPembayaran->status_verifikasi === 'menunggu' ? 'Menunggu Verifikasi' : ($pemesanan->verifikasiPembayaran->status_verifikasi === 'ditolak' ? 'Pembayaran Ditolak' : 'Pembayaran Langsung'))) : 'Pembayaran Langsung' }}"
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
                                            <span class="font-medium">Jumlah:</span> {{ $jumlah }} unit
                                        </p>
                                        <p class="text-sm text-gray-600">
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
                                        @if($pemesanan->verifikasiPembayaran)
                                            @switch($pemesanan->verifikasiPembayaran->status_verifikasi)
                                                @case('diterima')
                                                    Transfer Bank (Diterima)
                                                    @break
                                                @case('menunggu')
                                                    Transfer Bank (Menunggu Verifikasi)
                                                    @break
                                                @case('ditolak')
                                                    Transfer Bank (Ditolak)
                                                    @break
                                                @default
                                                    Pembayaran Langsung
                                            @endswitch
                                        @else
                                            Pembayaran Langsung
                                        @endif
                                    </p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $pemesanan->tanggal_pemesanan ? \Carbon\Carbon::parse($pemesanan->tanggal_pemesanan)->format('d M Y H:i') : '-' }}
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Tombol Aksi -->
                            <div class="flex justify-end space-x-2 mt-4">
                                <button onclick="showDetailModal('{{ $pemesanan->id }}')" 
                                    class="px-3 py-1 border border-gray-300 text-gray-700 text-sm rounded-lg hover:bg-gray-50 transition-colors">
                                    Detail
                                </button>
                                @if($pemesanan->verifikasiPembayaran->status_verifikasi === 'diterima')
                                    <a href="{{ route('pemesanan.invoice', $pemesanan->id) }}" 
                                    class="px-3 py-1 border border-gray-300 text-gray-700 text-sm rounded-lg hover:bg-gray-50 transition-colors">
                                        Unduh Invoice
                                    </a>
                                @endif
                                @if($status == 'Menunggu Pembayaran')
                                    <button class="px-3 py-1 bg-primary text-white text-sm rounded-lg hover:bg-primary-dark transition-colors">
                                        Bayar Sekarang
                                    </button>
                                    <button class="px-3 py-1 bg-red-100 text-red-700 text-sm rounded-lg hover:bg-red-200 transition-colors">
                                        Batalkan
                                    </button>
                                @endif
                                <!-- Tombol Ulasan -->
                                @if($pemesanan->status_penyewaan === 'sudah_dikembalikan')
                                    <button onclick="toggleUlasanSection('{{ $pemesanan->id }}')"
                                            class="px-3 py-1 border border-gray-300 text-gray-700 text-sm rounded-lg hover:bg-gray-50 transition-colors">
                                        {{ $ulasan ? 'Lihat Ulasan' : 'Beri Ulasan' }}
                                    </button>
                                @endif
                            </div>
                            <!-- Section Ulasan -->
                            <div id="ulasan-section-{{ $pemesanan->id }}" class="mt-4 hidden">
                            <div class="border border-gray-200 rounded-lg bg-white shadow-sm w-full">
                                <div class="p-6">
                                <h3 class="text-center text-lg font-bold mb-4">Ulasan</h3>
                                
                                @if($ulasan)
                                    <!-- Tampilan Ulasan yang sudah ada -->
                                    <div id="existing-review-{{ $pemesanan->id }}" class="space-y-4">
                                    <!-- Rating -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                                        <div class="flex justify-center">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg xmlns="http://www.w3.org/2000/svg" 
                                            class="w-8 h-8 {{ $i <= $ulasan->rating ? 'text-yellow-400 fill-current' : 'text-yellow-400' }}" 
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.618 4.985a1 1 0 00.95.69h5.246c.969 0 1.371 1.24.588 1.81l-4.244 3.085a1 1 0 00-.364 1.118l1.618 4.985c.3.921-.755 1.688-1.54 1.118l-4.244-3.085a1 1 0 00-1.176 0l-4.244 3.085c-.785.57-1.84-.197-1.54-1.118l1.618-4.985a1 1 0 00-.364-1.118L2.647 10.41c-.783-.57-.38-1.81.588-1.81h5.246a1 1 0 00.95-.69l1.618-4.985z" />
                                            </svg>
                                        @endfor
                                        </div>
                                    </div>

                                    <!-- Komentar -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Ulasan</label>
                                        <div class="w-full border border-gray-300 p-3 rounded-lg bg-gray-50 max-h-60 overflow-y-auto">
                                        <p class="text-gray-700 whitespace-pre-wrap break-all">{{ $ulasan->komentar }}</p>
                                        </div>
                                    </div>

                                    <div class="text-sm text-gray-500">
                                        <p>Ditulis pada: {{ $ulasan->dibuat_pada->format('d M Y H:i') }}</p>
                                        <p>Ulasan hanya dapat diedit satu kali. Pastikan isi ulasan sudah sesuai sebelum menyimpannya.</p>
                                        @if($ulasan->dibuat_pada != $ulasan->diedit_pada)
                                        <p>Terakhir diupdate: {{ $ulasan->diedit_pada->format('d M Y H:i') }}</p>
                                        @endif
                                    </div>

                                    <div class="flex justify-end space-x-2 pt-4">
                                        @if($ulasan->bisa_edit == 1)
                                        <button onclick="showEditForm('{{ $pemesanan->id }}')" 
                                            class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                                            Edit
                                        </button>
                                        @endif
                                        
                                        <form action="{{ route('ulasan.destroy', $ulasan->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                            class="px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus ulasan ini?')">
                                            Hapus
                                        </button>
                                        </form>
                                    </div>
                                    </div>
                                    
                                    <!-- Form Edit Ulasan -->
                                    <div id="edit-ulasan-form-{{ $pemesanan->id }}" class="hidden space-y-4">
                                    <form action="{{ route('ulasan.update', $ulasan->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="id_pemesanan" value="{{ $pemesanan->id }}">
                                        <input type="hidden" name="id_produk" value="{{ $item->id_produk }}">
                                        <input type="hidden" name="bisa_edit" value="0">

                                        <!-- Rating -->
                                        <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                                        <div class="flex justify-center" id="edit-rating-stars-{{ $pemesanan->id }}">
                                            @for ($i = 1; $i <= 5; $i++)
                                            <svg xmlns="http://www.w3.org/2000/svg" data-value="{{ $i }}" 
                                                class="w-8 h-8 cursor-pointer star hover:scale-110 transition-transform 
                                                {{ $i <= $ulasan->rating ? 'text-yellow-400 fill-current' : 'text-yellow-400' }}" 
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.618 4.985a1 1 0 00.95.69h5.246c.969 0 1.371 1.24.588 1.81l-4.244 3.085a1 1 0 00-.364 1.118l1.618 4.985c.3.921-.755 1.688-1.54 1.118l-4.244-3.085a1 1 0 00-1.176 0l-4.244 3.085c-.785.57-1.84-.197-1.54-1.118l1.618-4.985a1 1 0 00-.364-1.118L2.647 10.41c-.783-.57-.38-1.81.588-1.81h5.246a1 1 0 00.95-.69l1.618-4.985z" />
                                            </svg>
                                            @endfor
                                        </div>
                                        <input type="hidden" name="rating" id="edit-rating-input-{{ $pemesanan->id }}" value="{{ $ulasan->rating }}" required>
                                        </div>

                                        <!-- Komentar -->
                                        <div>
                                        <label for="komentar" class="block text-sm font-medium text-gray-700 mb-2">Ulasan</label>
                                        <textarea name="komentar" rows="4" placeholder="Bagikan pengalaman anda..." 
                                            class="w-full border border-gray-300 p-3 rounded-lg resize-none focus:outline-none focus:ring-2 focus:ring-yellow-400 whitespace-pre-wrap">{{ $ulasan->komentar }}</textarea>
                                        </div>

                                        <div class="flex justify-end space-x-2 pt-4">
                                        <button type="button" onclick="hideEditForm('{{ $pemesanan->id }}')"
                                            class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                                            Batal
                                        </button>
                                        <button type="submit" 
                                            class="px-4 py-2 bg-primary hover:bg-primary-dark text-white rounded-lg font-semibold transition-colors">
                                            Simpan Perubahan
                                        </button>
                                        </div>
                                    </form>
                                    </div>
                                @else
                                    <!-- Form Ulasan Baru -->
                                    <form action="{{ route('ulasan.store') }}" method="POST" class="space-y-4">
                                    @csrf
                                    <input type="hidden" name="id_pemesanan" value="{{ $pemesanan->id }}">
                                    <input type="hidden" name="id_produk" value="{{ $item->id_produk }}">

                                    <!-- Rating -->
                                    <div>
                                        <label for="rating-{{ $pemesanan->id }}" class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                                        <div class="flex justify-center" id="rating-stars-{{ $pemesanan->id }}">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg xmlns="http://www.w3.org/2000/svg" data-value="{{ $i }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" 
                                            class="w-8 h-8 cursor-pointer star hover:scale-110 transition-transform text-yellow-400">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.618 4.985a1 1 0 00.95.69h5.246c.969 0 1.371 1.24.588 1.81l-4.244 3.085a1 1 0 00-.364 1.118l1.618 4.985c.3.921-.755 1.688-1.54 1.118l-4.244-3.085a1 1 0 00-1.176 0l-4.244 3.085c-.785.57-1.84-.197-1.54-1.118l1.618-4.985a1 1 0 00-.364-1.118L2.647 10.41c-.783-.57-.38-1.81.588-1.81h5.246a1 1 0 00.95-.69l1.618-4.985z" />
                                            </svg>
                                        @endfor
                                        </div>
                                        <input type="hidden" name="rating" id="rating-input-{{ $pemesanan->id }}" required>
                                    </div>

                                    <!-- Komentar -->
                                    <div>
                                        <label for="komentar" class="block text-sm font-medium text-gray-700 mb-2">Ulasan</label>
                                        <textarea name="komentar" rows="4" placeholder="Bagikan pengalaman anda..." 
                                        class="w-full border border-gray-300 p-3 rounded-lg resize-none focus:outline-none focus:ring-2 focus:ring-yellow-400 whitespace-pre-wrap"></textarea>
                                    </div>

                                    <div class="flex justify-end space-x-2 pt-4">
                                        <button type="button" onclick="toggleUlasanSection('{{ $pemesanan->id }}')"
                                        class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                                        Batal
                                        </button>
                                        <button type="submit" 
                                        class="px-4 py-2 bg-primary hover:bg-primary-dark text-white rounded-lg font-semibold transition-colors">
                                        Kirim Ulasan
                                        </button>
                                    </div>
                                    </form>
                                @endif
                                </div>
                            </div>
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
                                <a href="{{ route('home') }}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors inline-flex items-center">
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
            @foreach($pemesanans as $pemesanan)
            @php
                $item = $pemesanan->items->first();
                $produk = $item->produk ?? null;
                
                // Default value
                $status = 'Menunggu Pembayaran';
                $statusClass = 'bg-gray-100 text-gray-800';
                
                // Cek verifikasi pembayaran
                if ($pemesanan->verifikasiPembayaran) {
                    switch($pemesanan->verifikasiPembayaran->status_verifikasi) {
                        case 'diterima':
                            // Hanya tampilkan status penyewaan jika pembayaran diterima
                            if ($pemesanan->status_penyewaan == 'belum_dipinjam') {
                                $status = 'Menunggu Pengambilan';
                                $statusClass = 'bg-blue-100 text-blue-800';
                            } elseif ($pemesanan->status_penyewaan == 'sedang_dipinjam') {
                                $status = 'Sedang Dipinjam';
                                $statusClass = 'bg-yellow-100 text-yellow-800';
                            } elseif ($pemesanan->status_penyewaan == 'sudah_dikembalikan') {
                                $status = 'Sudah Dikembalikan';
                                $statusClass = 'bg-green-100 text-green-800';
                            }
                            break;
                        case 'menunggu':
                            $status = 'Menunggu Verifikasi Pembayaran';
                            $statusClass = 'bg-orange-100 text-orange-800';
                            break;
                        case 'ditolak':
                            $status = 'Pembayaran Ditolak';
                            $statusClass = 'bg-red-100 text-red-800';
                            break;
                    }
                }
                
                // Metode Pembayaran
                if ($pemesanan->verifikasiPembayaran) {
                    switch($pemesanan->verifikasiPembayaran->status_verifikasi) {
                        case 'diterima':
                            $metodePembayaran = 'Transfer Bank (Diterima)';
                            break;
                        case 'menunggu':
                            $metodePembayaran = 'Transfer Bank (Menunggu Verifikasi)';
                            break;
                        case 'ditolak':
                            $metodePembayaran = 'Transfer Bank (Ditolak)';
                            break;
                        default:
                            $metodePembayaran = 'Pembayaran Langsung';
                    }
                } else {
                    $metodePembayaran = 'Pembayaran Langsung';
                }
            @endphp
            <div id="modal-content-{{ $pemesanan->id }}" class="hidden">
                <!-- Modal Header -->
                <div class="flex justify-between items-center border-b p-4">
                    <h3 class="text-lg font-bold">Detail Pemesanan #{{ $pemesanan->id }}</h3>
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
                                <img src="{{ asset($produk->path_gambar ? explode('|', $produk->path_gambar)[0] : 'images/gitar.jpg') }}" 
                                     alt="{{ $produk->nama ?? 'Alat Musik' }}" 
                                     class="w-16 h-16 object-cover rounded-lg">
                                <div>
                                    <p class="font-medium">{{ $produk->nama ?? 'Alat Musik' }}</p>
                                    <p class="text-sm text-gray-600">Rp {{ number_format($produk->harga ?? 0, 0, ',', '.') }}/hari</p>
                                    <p class="text-sm text-gray-600 mt-1">Jumlah: {{ $item->jumlah ?? 1 }} unit</p>
                                </div>
                            </div>
                        </div>
                        <!-- Info Penyewaan -->
                        <div>
                            <h4 class="font-medium text-gray-900 mb-2">Periode Sewa</h4>
                            <p class="text-sm text-gray-600">
                                {{ $pemesanan->tanggal_mulai ? \Carbon\Carbon::parse($pemesanan->tanggal_mulai)->format('d M Y') : '-' }} - 
                                {{ $pemesanan->tanggal_selesai ? \Carbon\Carbon::parse($pemesanan->tanggal_selesai)->format('d M Y') : '-' }}
                            </p>
                            <p class="text-sm text-gray-600 mt-1">
                                <span class="font-medium">Durasi:</span> 
                                @if($pemesanan->tanggal_mulai && $pemesanan->tanggal_selesai)
                                    {{ \Carbon\Carbon::parse($pemesanan->tanggal_mulai)->diffInDays(\Carbon\Carbon::parse($pemesanan->tanggal_selesai)) }} hari
                                @else
                                    -
                                @endif
                            </p>
                            <p class="text-sm text-gray-600 mt-1">Harap dikembalikan: {{ $pemesanan->tanggal_selesai ? \Carbon\Carbon::parse($pemesanan->tanggal_selesai)->format('d M Y') : '-' }}</p>
                        </div>
                    </div>
                    <!-- Info Pembayaran -->
                    <div class="mt-6 border-t pt-4">
                        <h4 class="font-medium text-gray-900 mb-2">Pembayaran</h4>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600">Konfirmasi Admin</p>
                                <p class="font-medium">{{ $metodePembayaran }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Total Harga</p>
                                <p class="font-medium">Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Status Penyewaan</p>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusClass }}">
                                    {{ $status }}
                                </span>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Tanggal Pemesanan</p>
                                <p class="font-medium">
                                    {{ $pemesanan->tanggal_pemesanan ? \Carbon\Carbon::parse($pemesanan->tanggal_pemesanan)->format('d M Y H:i') : '-' }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Informasi Pengembalian (hanya tampil jika status sudah_dikembalikan) -->
                    @if($pemesanan->status_penyewaan === 'sudah_dikembalikan' && $pemesanan->pengembalian)
                        <div class="pt-4 mt-4 border-t border-gray-200 grid grid-cols-3 gap-4">
                            <div class="text-gray-500 font-medium">Tanggal Pengembalian</div>
                            <div class="col-span-2">{{ $pemesanan->pengembalian->tanggal_pengembalian->format('d/m/Y H:i') }}</div>
                            <div class="text-gray-500 font-medium">Kondisi</div>
                            <div class="col-span-2">
                                @switch($pemesanan->pengembalian->kondisi)
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
                            <div class="col-span-2">{{ $pemesanan->pengembalian->denda ? 'Rp '.number_format($pemesanan->pengembalian->denda, 0, ',', '.') : '-' }}</div>
                            <div class="text-gray-500 font-medium">Catatan</div>
                            <div class="col-span-2 break-words">{{ $pemesanan->pengembalian->catatan ?? '-' }}</div>
                        </div>
                    @else
                        <div class="pt-4 mt-4 border-t border-gray-200">
                            <p class="text-sm text-yellow-600 bg-yellow-50 p-2 rounded-md">
                                @if($pemesanan->status_penyewaan !== 'sudah_dikembalikan')
                                    Data pengembalian akan muncul setelah proses pengembalian alat musik selesai diverifikasi
                                @else
                                    Data pengembalian tidak ditemukan
                                @endif
                            </p>
                        </div>
                    @endif
                </div>
                <!-- Modal Footer -->
                <div class="border-t p-4 flex justify-end space-x-2">
                    <button onclick="hideDetailModal()" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                        Tutup
                    </button>
                    @if($pemesanan->verifikasiPembayaran && $pemesanan->verifikasiPembayaran->status_verifikasi === 'diterima')
                    <a href="{{ route('pemesanan.invoice', $pemesanan->id) }}" 
                       class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">
                        Unduh Invoice
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<style>
    .ulasan-container {
        max-height: 400px; /* Atur tinggi maksimum sesuai kebutuhan */
        overflow-y: auto; /* Tambahkan scroll vertikal jika konten melebihi tinggi */
    }
    
    .ulasan-komentar {
        min-height: 120px; /* Pertahankan tinggi minimum */
        max-height: 200px; /* Batasi tinggi maksimum */
        overflow-y: auto; /* Tambahkan scroll jika diperlukan */
    }
</style>

<script>
    // Fungsi untuk menampilkan modal detail
    function showDetailModal(pemesananId) {
        const modal = document.getElementById('detailModal');
        
        // Sembunyikan semua konten modal terlebih dahulu
        document.querySelectorAll('[id^="modal-content-"]').forEach(el => {
            el.classList.add('hidden');
        });
        
        // Tampilkan konten modal yang dipilih
        const modalContent = document.getElementById(`modal-content-${pemesananId}`);
        if (modalContent) {
            modalContent.classList.remove('hidden');
        }
        
        // Tampilkan modal
        modal.classList.remove('hidden');
    }

    // Fungsi untuk menyembunyikan modal detail
    function hideDetailModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }

    // Tutup modal saat klik di luar konten
    document.getElementById('detailModal').addEventListener('click', function(e) {
        if (e.target === this) {
            hideDetailModal();
        }
    });

    // Fungsi untuk inisialisasi rating stars
    function initRatingStars(containerId, inputId) {
        const stars = document.querySelectorAll(`#${containerId} .star`);
        const ratingInput = document.getElementById(inputId);
        
        stars.forEach(star => {
            // Hover effect
            star.addEventListener('mouseover', () => {
                const value = parseInt(star.getAttribute('data-value'));
                highlightStars(value, containerId);
            });
            
            // Click event
            star.addEventListener('click', (e) => {
                const value = parseInt(star.getAttribute('data-value'));
                ratingInput.value = value;
                highlightStars(value, containerId);
            });
            
            // Reset to selected value when mouse leaves
            star.addEventListener('mouseout', () => {
                const currentValue = parseInt(ratingInput.value) || 0;
                highlightStars(currentValue, containerId);
            });
        });
    }
    
    // Fungsi untuk menyorot bintang
    function highlightStars(count, containerId) {
        const stars = document.querySelectorAll(`#${containerId} .star`);
        stars.forEach((star, index) => {
            const value = parseInt(star.getAttribute('data-value'));
            if (value <= count) {
                star.classList.add('fill-current');
            } else {
                star.classList.remove('fill-current');
            }
        });
    }
    
    // Inisialisasi saat dokumen siap
    document.addEventListener('DOMContentLoaded', function() {
        // Untuk setiap form ulasan yang ada
        @foreach($pemesanans as $pemesanan)
            @if($pemesanan->status_penyewaan === 'sudah_dikembalikan')
                // Form ulasan baru
                if (document.getElementById('rating-stars-{{ $pemesanan->id }}')) {
                    initRatingStars('rating-stars-{{ $pemesanan->id }}', 'rating-input-{{ $pemesanan->id }}');
                }
                
                // Form edit ulasan
                if (document.getElementById('edit-rating-stars-{{ $pemesanan->id }}')) {
                    initRatingStars('edit-rating-stars-{{ $pemesanan->id }}', 'edit-rating-input-{{ $pemesanan->id }}');
                    
                    // Set default value untuk form edit jika ada ulasan
                    @if($ulasan = $pemesanan->ulasan->firstWhere('id_pengguna', auth()->id()))
                        document.getElementById('edit-rating-input-{{ $pemesanan->id }}').value = {{ $ulasan->rating }};
                        highlightStars({{ $ulasan->rating }}, 'edit-rating-stars-{{ $pemesanan->id }}');
                    @endif
                }
            @endif
        @endforeach
    });
    
    // Fungsi untuk toggle ulasan section
    function toggleUlasanSection(pemesananId) {
        const section = document.getElementById(`ulasan-section-${pemesananId}`);
        section.classList.toggle('hidden');
        
        // Inisialisasi rating stars saat section dibuka
        if (!section.classList.contains('hidden')) {
            setTimeout(() => {
                if (document.getElementById(`rating-stars-${pemesananId}`)) {
                    initRatingStars(`rating-stars-${pemesananId}`, `rating-input-${pemesananId}`);
                }
                if (document.getElementById(`edit-rating-stars-${pemesananId}`)) {
                    initRatingStars(`edit-rating-stars-${pemesananId}`, `edit-rating-input-${pemesananId}`);
                }
            }, 100);
        }
    }
    
    // Fungsi untuk show edit form
    function showEditForm(pemesananId) {
        document.getElementById(`existing-review-${pemesananId}`).classList.add('hidden');
        document.getElementById(`edit-ulasan-form-${pemesananId}`).classList.remove('hidden');
        
        // Inisialisasi rating stars saat form edit ditampilkan
        setTimeout(() => {
            if (document.getElementById(`edit-rating-stars-${pemesananId}`)) {
                initRatingStars(`edit-rating-stars-${pemesananId}`, `edit-rating-input-${pemesananId}`);
            }
        }, 100);
    }
    
    // Fungsi untuk hide edit form
    function hideEditForm(pemesananId) {
        document.getElementById(`existing-review-${pemesananId}`).classList.remove('hidden');
        document.getElementById(`edit-ulasan-form-${pemesananId}`).classList.add('hidden');
    }
</script>
@endsection