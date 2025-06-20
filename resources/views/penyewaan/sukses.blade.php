@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <div class="bg-white rounded-lg shadow-md p-6 text-center">
        <div class="mb-6">
            <svg class="w-16 h-16 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Pemesanan Berhasil!</h1>
        <p class="text-gray-600 mb-6">Terima kasih telah melakukan pemesanan di Insphony Musik. Berikut detail pemesanan Anda:</p>
        
        <div class="bg-gray-50 rounded-lg p-6 mb-6 text-left">
            <div class="grid md:grid-cols-2 gap-4 mb-4">
                <div>
                    <h3 class="font-medium text-gray-700">Nomor Pemesanan</h3>
                    <p class="text-gray-900">{{ $pemesanan->id }}</p>
                </div>
                <div>
                    <h3 class="font-medium text-gray-700">Tanggal Pemesanan</h3>
                    <p class="text-gray-900">{{ $pemesanan->tanggal_pemesanan->format('d/m/Y H:i') }}</p>
                </div>
            </div>
            
            <div class="mb-4">
                <h3 class="font-medium text-gray-700">Produk yang Disewa</h3>
                @foreach($pemesanan->products as $product)
                <div class="flex items-center gap-4 mt-2">
                    <img src="{{ asset($product->path_gambar) }}" alt="{{ $product->nama }}" class="w-12 h-12 object-cover rounded">
                    <div>
                        <p class="font-medium">{{ $product->nama }}</p>
                        <p class="text-sm text-gray-600">{{ $product->kategori }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <h3 class="font-medium text-gray-700">Durasi Sewa</h3>
                    <p class="text-gray-900">
                        {{ $pemesanan->tanggal_mulai->format('d/m/Y') }} - 
                        {{ $pemesanan->tanggal_selesai->format('d/m/Y') }}
                        ({{ $pemesanan->products->first()->pivot->hari_sewa }} hari)
                    </p>
                </div>
                <div>
                    <h3 class="font-medium text-gray-700">Total Pembayaran</h3>
                    <p class="text-gray-900 font-bold">Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
            <h3 class="font-medium text-blue-800 mb-2">Status Pemesanan</h3>
            <p class="text-blue-700">
                @if($pemesanan->verifikasiPembayaran && $pemesanan->verifikasiPembayaran->status_verifikasi === 'diterima')
                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded">Pembayaran Diterima</span>
                @elseif($pemesanan->verifikasiPembayaran && $pemesanan->verifikasiPembayaran->status_verifikasi === 'ditolak')
                    <span class="bg-red-100 text-red-800 px-2 py-1 rounded">Pembayaran Ditolak</span>
                @else
                    <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded">Menunggu Verifikasi Pembayaran</span>
                @endif
            </p>
        </div>
        
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('home') }}" class="px-6 py-2 bg-[#a08963] hover:bg-[#8b7556] text-white rounded-lg transition-colors">
                Kembali ke Beranda
            </a>
            <a href="{{ route('user.orders') }}" class="px-6 py-2 bg-white border border-[#a08963] text-[#a08963] hover:bg-gray-50 rounded-lg transition-colors">
                Lihat Pesanan Saya
            </a>
        </div>
    </div>
</div>
@endsection