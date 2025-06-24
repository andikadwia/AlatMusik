<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice #{{ $pemesanan->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .invoice-header { text-align: center; margin-bottom: 30px; }
        .grid { display: grid; gap: 1rem; }
        .grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .bg-gray-50 { background-color: #f9fafb; }
        .p-4 { padding: 1rem; }
        .rounded-lg { border-radius: 0.5rem; }
        .font-semibold { font-weight: 600; }
        .mb-2 { margin-bottom: 0.5rem; }
        .text-gray-600 { color: #4b5563; }
        .text-gray-500 { color: #6b7280; }
        .text-gray-800 { color: #1f2937; }
        .text-gray-400 { color: #9ca3af; }
        .text-yellow-800 { color: #92400e; }
        .text-green-800 { color: #065f46; }
        .text-red-800 { color: #991b1b; }
        .bg-yellow-100 { background-color: #fef3c7; }
        .bg-green-100 { background-color: #d1fae5; }
        .bg-red-100 { background-color: #fee2e2; }
        .bg-gray-100 { background-color: #f3f4f6; }
        .px-2 { padding-left: 0.5rem; padding-right: 0.5rem; }
        .inline-flex { display: inline-flex; }
        .text-xs { font-size: 0.75rem; }
        .leading-5 { line-height: 1.25rem; }
        .font-semibold { font-weight: 600; }
        .rounded-full { border-radius: 9999px; }
        .divider { height: 1px; background-color: #e5e7eb; margin: 1rem 0; }
        .min-w-full { min-width: 100%; }
        .divide-y > :not([hidden]) ~ :not([hidden]) { border-top-width: 1px; }
        .divide-gray-200 > :not([hidden]) ~ :not([hidden]) { border-color: #e5e7eb; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { padding: 0.75rem; text-align: left; border-bottom: 1px solid #e5e7eb; }
        .table thead th { font-weight: 500; text-transform: uppercase; font-size: 0.75rem; color: #6b7280; }
        .w-16 { width: 4rem; }
        .h-16 { height: 4rem; }
        .object-contain { object-fit: contain; }
        .flex { display: flex; }
        .items-center { align-items: center; }
        .justify-center { justify-content: center; }
        .text-right { text-align: right; }
        .font-medium { font-weight: 500; }
        .font-bold { font-weight: 700; }
        .text-lg { font-size: 1.125rem; }
        .mb-3 { margin-bottom: 0.75rem; }
        .overflow-x-auto { overflow-x: auto; }
        .mt-4 { margin-top: 1rem; }
    </style>
</head>
<body>
    <div class="invoice-header">
        <h1 class="font-bold text-lg">INVOICE</h1>
        <p>No: #{{ $pemesanan->id }}</p>
    </div>

    <div class="grid grid-cols-2 gap-4 mb-6">
      <div class="bg-gray-50 p-4 rounded-lg">
        <h4 class="font-semibold mb-2">Informasi Pelanggan</h4>
        <p><span class="text-gray-600">Nama:</span> {{ $pemesanan->user->name }}</p>
        <p><span class="text-gray-600">Telepon:</span> {{ $pemesanan->telepon ?? '-' }}</p>
        <p>
          <span class="text-gray-600">Status:</span> 
          @if($pemesanan->verifikasiPembayaran)
            @switch($pemesanan->verifikasiPembayaran->status_verifikasi)
              @case('menunggu')
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                  Menunggu
                </span>
                @break
              @case('diterima')
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                  Disetujui
                </span>
                @break
              @case('ditolak')
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                  Ditolak
                </span>
                @break
            @endswitch
          @else
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
              Belum Verifikasi
            </span>
          @endif
        </p>
      </div>
      <div class="bg-gray-50 p-4 rounded-lg">
        <h4 class="font-semibold mb-2">Informasi Pemesanan</h4>
        <p><span class="text-gray-600">Tanggal:</span> 
            {{ $pemesanan->tanggal_pemesanan ? \Carbon\Carbon::parse($pemesanan->tanggal_pemesanan)->format('d-m-Y H:i') : '-' }}
        </p>
        <p><span class="text-gray-600">Total Harga:</span> Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</p>
      </div>
    </div>
    
    <div class="divider my-4"></div>
    
    <div class="mb-6">
      <h4 class="font-bold text-lg mb-3">Detail Alat Musik</h4>
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Alat</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lama Sewa</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga/Hari</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($pemesanan->items as $item)
            <tr>
              <td class="px-6 py-4">
                @if ($item->produk->path_gambar)
                  <img src="{{ asset($item->produk->path_gambar) }}" class="w-16 h-16 object-contain">
                @else
                  <div class="w-16 h-16 bg-gray-200 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                  </div>
                @endif
              </td>
              <td class="px-6 py-4">{{ $item->produk->nama }}</td>
              <td class="px-6 py-4">{{ \Carbon\Carbon::parse($pemesanan->tanggal_mulai)->diffInDays($pemesanan->tanggal_selesai) }} Hari</td>
              <td class="px-6 py-4">Rp {{ number_format($item->produk->harga_sewa, 0, ',', '.') }}</td>
              <td class="px-6 py-4">Rp {{ number_format($item->produk->harga_sewa * \Carbon\Carbon::parse($pemesanan->tanggal_mulai)->diffInDays($pemesanan->tanggal_selesai), 0, ',', '.') }}</td>
            </tr>
            @endforeach
          </tbody>
          <tfoot class="bg-gray-50">
            <tr>
              <td colspan="4" class="px-6 py-4 text-right font-medium">Total:</td>
              <td class="px-6 py-4 font-medium">Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>

    <div class="mt-4">
        <p>Terima kasih telah menggunakan layanan kami.</p>
    </div>
</body>
</html>