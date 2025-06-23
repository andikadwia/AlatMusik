<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice #{{ $pemesanan->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .invoice-header { text-align: center; margin-bottom: 30px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; }
        .text-right { text-align: right; }
        .mt-4 { margin-top: 16px; }
    </style>
</head>
<body>
    <div class="invoice-header">
        <h1>INVOICE</h1>
        <p>No: #{{ $pemesanan->id }}</p>
    </div>

    <div>
        <p><strong>Tanggal:</strong> 
            {{ $pemesanan->tanggal_pemesanan ? \Carbon\Carbon::parse($pemesanan->tanggal_pemesanan)->format('d F Y') : '-' }}
        </p>
        <p><strong>Nama:</strong> {{ $pemesanan->user->name }}</p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Durasi</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pemesanan->items as $item)
            <tr>
                <td>{{ $item->produk->nama }}</td>
                <td>Rp {{ number_format($item->produk->harga_sewa, 0, ',', '.') }}/hari</td>
                <td>{{ \Carbon\Carbon::parse($pemesanan->tanggal_mulai)->diffInDays($pemesanan->tanggal_selesai) }} hari</td>
                <td>Rp {{ number_format($item->produk->harga_sewa * \Carbon\Carbon::parse($pemesanan->tanggal_mulai)->diffInDays($pemesanan->tanggal_selesai), 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-right"><strong>Total:</strong></td>
                <td><strong>Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</strong></td>
            </tr>
        </tfoot>
    </table>

    <div class="mt-4">
        <p>Terima kasih telah menggunakan layanan kami.</p>
    </div>
</body>
</html>