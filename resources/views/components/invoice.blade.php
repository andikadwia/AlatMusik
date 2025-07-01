<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice #{{ $pemesanan->id }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-6">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-sm">
        <!-- Header - Centered -->
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">INVOICE</h1>
            <p class="text-gray-500">#{{ $pemesanan->id }}</p>
            <div class="mt-2">
                <p class="text-gray-600 font-medium">Inshony Rental Musik</p>
                <p class="text-sm text-gray-500">Jl. Contoh No. 123, Batam</p>
                <p class="text-sm text-gray-500">0812-3456-7890</p>
            </div>
        </div>

        <!-- Customer and Order Info - Side by Side -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="border border-gray-200 rounded-lg p-4">
                <h3 class="text-lg font-semibold text-gray-700 mb-3">Pelanggan</h3>
                <div class="space-y-2">
                    <p><span class="text-gray-600 inline-block w-24">Nama:</span> {{ $pemesanan->user->name }}</p>
                    <p><span class="text-gray-600 inline-block w-24">Telepon:</span> {{ $pemesanan->user->telepon }}</p>
                    <p><span class="text-gray-600 inline-block w-24">Alamat:</span> {{ $pemesanan->user->alamat }}</p>
                </div>
            </div>

            <div class="border border-gray-200 rounded-lg p-4">
                <h3 class="text-lg font-semibold text-gray-700 mb-3">Pemesanan</h3>
                <div class="space-y-2">
                    <p><span class="text-gray-600 inline-block w-24">Tanggal:</span> {{ \Carbon\Carbon::parse($pemesanan->tanggal_pemesanan)->format('d F Y H:i') }}</p>
                    <p><span class="text-gray-600 inline-block w-24">Periode:</span> 
                        {{ \Carbon\Carbon::parse($pemesanan->tanggal_mulai)->format('d M') }} - 
                        {{ \Carbon\Carbon::parse($pemesanan->tanggal_selesai)->format('d M Y') }}
                    </p>
                    <p><span class="text-gray-600 inline-block w-24">Status:</span> 
                        @if($pemesanan->verifikasiPembayaran)
                            @switch($pemesanan->verifikasiPembayaran->status_verifikasi)
                                @case('menunggu')
                                    <span class="px-2 py-1 inline-flex text-xs leading-none rounded-full bg-yellow-100 text-yellow-800">
                                        Menunggu
                                    </span>
                                    @break
                                @case('diterima')
                                    <span class="px-2 py-1 inline-flex text-xs leading-none rounded-full bg-green-100 text-green-800">
                                        Diterima
                                    </span>
                                    @break
                                @case('ditolak')
                                    <span class="px-2 py-1 inline-flex text-xs leading-none rounded-full bg-red-100 text-red-800">
                                        Ditolak
                                    </span>
                                    @break
                            @endswitch
                        @else
                            <span class="px-2 py-1 inline-flex text-xs leading-none rounded-full bg-gray-100 text-gray-800">
                                Belum Verifikasi
                            </span>
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="mb-8 border border-gray-200 rounded-lg overflow-hidden">
            <h3 class="text-lg font-semibold text-gray-700 bg-gray-50 p-4 border-b border-gray-200">Detail Penyewaan</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alat Musik</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Hari</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Harga/Hari</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($pemesanan->items as $index => $item)
                        <tr>
                            <td class="px-4 py-3 whitespace-nowrap text-sm">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">
                                <div class="font-medium text-gray-900">{{ $item->produk->nama }}</div>
                                <div class="text-gray-500 text-xs">{{ $item->produk->kategori }}</div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-right">{{ $item->hari_sewa }}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-right">Rp {{ number_format($item->harga_per_hari, 0, ',', '.') }}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-right">Rp {{ number_format($item->harga_per_hari * $item->hari_sewa, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-50">
                        <tr>
                            <td colspan="4" class="px-4 py-3 text-right text-sm font-medium">Total</td>
                            <td class="px-4 py-3 text-right text-sm font-medium">Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Payment and Return Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            @if($pemesanan->verifikasiPembayaran)
            <div class="border border-gray-200 rounded-lg p-4">
                <h3 class="text-lg font-semibold text-gray-700 mb-3">Pembayaran</h3>
                <div class="space-y-2">
                    <p><span class="text-gray-600 inline-block w-24">Status:</span> 
                        @switch($pemesanan->verifikasiPembayaran->status_verifikasi)
                            @case('menunggu')
                                <span class="px-2 py-1 inline-flex text-xs leading-none rounded-full bg-yellow-100 text-yellow-800">
                                    Menunggu
                                </span>
                                @break
                            @case('diterima')
                                <span class="px-2 py-1 inline-flex text-xs leading-none rounded-full bg-green-100 text-green-800">
                                    Diterima
                                </span>
                                @break
                            @case('ditolak')
                                <span class="px-2 py-1 inline-flex text-xs leading-none rounded-full bg-red-100 text-red-800">
                                    Ditolak
                                </span>
                                @break
                        @endswitch
                    </p>
                    <p><span class="text-gray-600 inline-block w-24">Tanggal:</span> 
                        {{ \Carbon\Carbon::parse($pemesanan->verifikasiPembayaran->tanggal_pembayaran)->format('d F Y H:i') }}
                    </p>
                </div>
            </div>
            @endif

            @if($pemesanan->pengembalian)
            <div class="border border-gray-200 rounded-lg p-4">
                <h3 class="text-lg font-semibold text-gray-700 mb-3">Pengembalian</h3>
                <div class="space-y-2">
                    <p><span class="text-gray-600 inline-block w-24">Tanggal:</span> 
                        {{ \Carbon\Carbon::parse($pemesanan->pengembalian->tanggal_pengembalian)->format('d F Y H:i') }}
                    </p>
                    <p><span class="text-gray-600 inline-block w-24">Kondisi:</span> 
                        <span class="capitalize">{{ str_replace('_', ' ', $pemesanan->pengembalian->kondisi) }}</span>
                    </p>
                    <p><span class="text-gray-600 inline-block w-24">Denda:</span> 
                        Rp {{ number_format($pemesanan->pengembalian->denda, 0, ',', '.') }}
                    </p>
                    @if($pemesanan->pengembalian->catatan)
                    <p><span class="text-gray-600 inline-block w-24">Catatan:</span> 
                        {{ $pemesanan->pengembalian->catatan }}
                    </p>
                    @endif
                </div>
            </div>
            @endif
        </div>

        <!-- Footer -->
        <div class="border-t border-gray-200 pt-6 text-center text-sm text-gray-500">
            <p>Terima kasih telah menggunakan layanan Inshony</p>
            <p class="mt-1">Silahkan hubungi kami jika ada pertanyaan</p>
        </div>
    </div>
</body>
</html>