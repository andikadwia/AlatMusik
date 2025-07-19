<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Invoice</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white p-10 text-gray-800 font-sans">

    <div class="max-w-3xl mx-auto border rounded-xl p-8 shadow">
    <!-- Header -->
    <h1 class="text-2xl font-semibold mb-4">Invoice Sewa Alat Musik Insphony</h1>
    <hr class="mb-6 border-gray-300" />

    <!-- Info Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
    <!-- Informasi Pesanan -->
    <div>
        <h2 class="text-md font-semibold mb-2">Informasi pesanan</h2>
        <p>Nomor pesanan: <span class="font-medium">#{{ $pemesanan->id }}</span></p>
        <p>Tanggal Pemesanan: <span class="font-medium">{{ \Carbon\Carbon::parse($pemesanan->tanggal_pemesanan)->format('d M Y') }}</span></p>
        <p>Status: <span class="font-medium text-green-600">@if($pemesanan->verifikasiPembayaran)
                        {{ ucfirst($pemesanan->verifikasiPembayaran->status_verifikasi) }}
                    @else
                        Belum Verifikasi
                    @endif
        </span></p>
    </div>
    <!-- Informasi Pelanggan -->
    <div>
        <h2 class="text-md font-semibold mb-2">Informasi Pelanggan</h2>
        <p>Nama: <span class="font-medium">{{ $pemesanan->user->name }}</span></p>
        <p>Telepon: <span class="font-medium">{{ $pemesanan->user->telepon }}</span></p>
        <p>Alamat: <span class="font-medium">{{ $pemesanan->user->alamat }}</span></p>
</div>
    </div>

    <!-- Tabel Item -->
    <div class="mb-10">
        <h2 class="text-md font-semibold mb-3">Alat Musik yang Disewa</h2>
    <div class="overflow-hidden rounded-lg shadow-sm">
        <table class="border-collapse border border-gray-400">
        <thead>
        <tr>
            <th class="border border-gray-300">Nama Alat Musik</th>
            <th class="border border-gray-300">Durasi Sewa</th>
            <th class="border border-gray-300">Harga / Hari</th>
        </tr>
    </thead>
        <tbody>
            @foreach($pemesanan->items as $index => $item)
            <tr class="border-t border-gray-100">
                <td class="px-6 py-3">{{ $item->produk->nama }}</td>
                <td class="px-6 py-3">{{ $item->hari_sewa }} hari</td>
                <td class="px-6 py-3">Rp {{ number_format($item->harga_per_hari, 0, ',', '.') }}</td>
            </tr>
            </tbody>
        </table>
        </div>
    </div>

    <!-- Informasi Pembayaran -->
    <div>
        <h2 class="text-md font-semibold mb-3">Informasi Pembayaran</h2>
    <div class="bg-gray-50 rounded-lg p-6 space-y-2">
        <div class="flex justify-between">
            <span>Periode Penyewaan: </span>
            <span class="font-medium">{{ \Carbon\Carbon::parse($pemesanan->tanggal_mulai)->format('d M Y') }} - 
                    {{ \Carbon\Carbon::parse($pemesanan->tanggal_selesai)->format('d M Y') }}
        </span>
        </div>
        <div class="flex justify-between font-bold text-lg pt-2 border-t">
            <span>Total: </span>
            <span class="text-indigo-700">Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</span>
        </div>
        @endforeach
        </div>
    </div>
    </div>
</body>
</html>
