@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-sm">
    <div class="text-center mb-8">
        <svg class="mx-auto h-16 w-16 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Pemesanan Berhasil!</h2>
        <p class="text-gray-600">Terima kasih telah melakukan pemesanan di Insphony Musik.</p>
    </div>

    <div class="bg-gray-50 rounded-lg p-6 mb-6">
        <h3 class="text-lg font-semibold mb-4">Detail Pemesanan</h3>
        
        <div class="grid md:grid-cols-2 gap-4 mb-4">
            <div>
                <p class="text-sm text-gray-500">Nomor Pemesanan</p>
                <p class="font-medium">#{{ str_pad($pemesanan->id, 6, '0', STR_PAD_LEFT) }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Tanggal Pemesanan</p>
                <p class="font-medium">{{ $pemesanan->tanggal_pemesanan->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        <div class="border-t border-gray-200 pt-4 mb-4">
            <h4 class="font-medium mb-2">Produk Disewa</h4>
            @foreach($pemesanan->items as $item)
            <div class="flex items-start gap-4 mb-3">
                <img src="{{ asset($item->path_gambar) }}" alt="{{ $item->produk->nama }}" class="w-16 h-16 object-cover rounded-lg">
                <div>
                    <p class="font-medium">{{ $item->produk->nama }}</p>
                    <p class="text-sm text-gray-600">{{ $item->hari_sewa }} hari ({{ $pemesanan->tanggal_mulai->format('d/m/Y') }} - {{ $pemesanan->tanggal_selesai->format('d/m/Y') }})</p>
                    <p class="text-sm">Rp {{ number_format($item->harga_per_hari, 0, ',', '.') }} / hari</p>
                </div>
            </div>
            @endforeach
        </div>

        <div class="border-t border-gray-200 pt-4">
            <div class="flex justify-between py-2">
                <span>Total Biaya Sewa</span>
                <span class="font-medium">Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between py-2">
                <span>Metode Pembayaran</span>
                <span class="font-medium">{{ ucfirst($pemesanan->metode_pembayaran) }}</span>
            </div>
            <div class="flex justify-between py-2">
                <span>Status</span>
                <span class="font-medium text-{{ $pemesanan->status === 'disetujui' ? 'green' : 'yellow' }}-600">
                    {{ ucfirst($pemesanan->status) }}
                </span>
            </div>
        </div>
    </div>

    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
        <h3 class="text-lg font-semibold mb-2">Instruksi Selanjutnya</h3>
        <p class="text-sm text-gray-700 mb-2">1. Admin akan memverifikasi pembayaran Anda dalam 1x24 jam.</p>
        <p class="text-sm text-gray-700 mb-2">2. Anda akan menerima notifikasi ketika pemesanan telah disetujui.</p>
        <p class="text-sm text-gray-700">3. Silakan ambil alat musik di toko kami pada tanggal yang telah ditentukan.</p>
    </div>

    <div class="flex justify-center gap-4">
        <a href="{{ route('penyewaan.history') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
            Lihat Riwayat Penyewaan
        </a>
        <a href="{{ route('produk.index') }}" class="text-gray-900 bg-white border border-gray-300 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
            Kembali ke Daftar Produk
        </a>
    </div>
</div>
@endsection