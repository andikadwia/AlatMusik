@extends('layouts.main')
@section('title', 'Inshony - Data Pemesanan')

@section('content')
<h1 class="text-2xl font-bold text-[#5a4d3a] mb-6 text-center">Data Pemesanan</h1>
<div class="container mx-auto px-4 py-6">
  <div class="bg-white shadow rounded-lg overflow-hidden border border-[#d4c8a8]">
    <table class="min-w-full divide-y divide-[#d4c8a8]">
      <thead class="bg-[#a08963]">
        <tr>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">ID</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">Nama Pemesan</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">Telepon</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">Total Harga</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">Tanggal</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">Status</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">Aksi</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-[#d4c8a8]">
        @forelse ($pemesanan as $p)
        <tr class="hover:bg-[#f5f1e9] transition-colors">
          <td class="px-6 py-4 whitespace-nowrap text-sm text-[#5a4d3a] font-medium">#{{ $p->id }}</td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-[#5a4d3a]">{{ $p->nama_pelanggan }}</td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-[#5a4d3a]">{{ $p->telepon }}</td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-[#5a4d3a]">Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-[#5a4d3a]">{{ \Carbon\Carbon::parse($p->tanggal_pemesanan)->format('d-m-Y H:i') }}</td>
          <td class="px-6 py-4 whitespace-nowrap">
            @if($p->verifikasiPembayaran)
              @switch($p->verifikasiPembayaran->status_verifikasi)
                @case('menunggu')
                  <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-[#f5e8c9] text-[#8a7555] items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Menunggu
                  </span>
                  @break
                @case('diterima')
                  <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-[#e3f2e9] text-[#4a7c5f] items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Disetujui
                  </span>
                  @break
                @case('ditolak')
                  <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-[#fae8e8] text-[#9c4a4a] items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Ditolak
                  </span>
                  @break
              @endswitch
            @else
              <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                Belum Verifikasi
              </span>
            @endif
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex gap-2">
              <button onclick="document.getElementById('modal-{{ $p->id }}').showModal()" 
                      class="bg-[#d4c8a8] hover:bg-[#c5b797] text-[#5a4d3a] px-3 py-1 rounded-lg transition-colors text-xs flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Detail
              </button>
              <button onclick="document.getElementById('modal-pembayaran-{{ $p->id }}').showModal()" 
                  class="bg-[#9c6644] hover:bg-[#8a5a3a] text-white px-3 py-1 rounded-lg transition-colors text-xs flex items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  Pembayaran
              </button>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="7" class="px-6 py-4 text-center text-[#5a4d3a]">
            <div class="flex flex-col items-center justify-center py-8">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[#a08963]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              <p class="mt-2 text-sm">Tidak ada data pemesanan</p>
            </div>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

@foreach ($pemesanan as $p)
<dialog id="modal-{{ $p->id }}" class="modal">
  <div class="modal-box max-w-3xl bg-white">
    <div class="flex justify-between items-center mb-6">
      <div>
        <h3 class="text-lg font-bold text-[#5a4d3a]">Detail Pemesanan #{{ $p->id }}</h3>
        <p class="text-sm text-[#8a7555]">{{ \Carbon\Carbon::parse($p->tanggal_pemesanan)->format('d-m-Y H:i') }}</p>
      </div>
      <form method="dialog">
        <button class="btn btn-sm btn-circle text-[#5a4d3a] hover:bg-[#f5f1e9]">✕</button>
      </form>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
      <div class="bg-[#f5f1e9] p-4 rounded-lg border border-[#d4c8a8]">
        <h4 class="font-semibold mb-2 text-[#5a4d3a]">Informasi Pelanggan</h4>
        <p class="text-sm"><span class="text-[#8a7555]">Nama:</span> {{ $p->nama_pelanggan }}</p>
        <p class="text-sm"><span class="text-[#8a7555]">Telepon:</span> {{ $p->telepon }}</p>
        <p class="text-sm">
          <span class="text-[#8a7555]">Status:</span> 
          @if($p->verifikasiPembayaran)
            @switch($p->verifikasiPembayaran->status_verifikasi)
              @case('menunggu')
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-[#f5e8c9] text-[#8a7555]">
                  Menunggu
                </span>
                @break
              @case('diterima')
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-[#e3f2e9] text-[#4a7c5f]">
                  Disetujui
                </span>
                @break
              @case('ditolak')
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-[#fae8e8] text-[#9c4a4a]">
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
      <div class="bg-[#f5f1e9] p-4 rounded-lg border border-[#d4c8a8]">
        <h4 class="font-semibold mb-2 text-[#5a4d3a]">Informasi Lainnya</h4>
        <p class="text-sm"><span class="text-[#8a7555]">Total Harga:</span> Rp {{ number_format($p->total_harga, 0, ',', '.') }}</p>
        <p class="text-sm"><span class="text-[#8a7555]">Periode:</span>                        
          {{ \Carbon\Carbon::parse($p->tanggal_mulai)->format('d M') }} - 
          {{ \Carbon\Carbon::parse($p->tanggal_selesai)->format('d M Y') }}
        </p>
      </div>
    </div>
    
    <div class="divider my-4"></div>
    
    <div class="mb-6">
      <h4 class="font-bold text-lg mb-3 text-[#5a4d3a]">Detail Alat Musik</h4>
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-[#d4c8a8]">
          <thead class="bg-[#f5f1e9]">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-[#5a4d3a] uppercase tracking-wider">Gambar</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-[#5a4d3a] uppercase tracking-wider">Nama Alat</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-[#5a4d3a] uppercase tracking-wider">Lama Sewa</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-[#5a4d3a] uppercase tracking-wider">Jumlah</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-[#5a4d3a] uppercase tracking-wider">Harga/Hari</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-[#5a4d3a] uppercase tracking-wider">Subtotal</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-[#d4c8a8]">
            @foreach ($p->detail as $item)
            <tr>
              <td class="px-6 py-4">
                @if ($item->path_gambar)
                  @php
                    $gambarPertama = explode('|', $item->path_gambar)[0];
                  @endphp
                  <img src="{{ asset($gambarPertama) }}" class="w-16 h-16 object-contain border border-[#d4c8a8] rounded">
                @else
                  <div class="w-16 h-16 bg-[#f5f1e9] flex items-center justify-center rounded border border-[#d4c8a8]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#a08963]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                  </div>
                @endif
              </td>
              <td class="px-6 py-4 text-sm text-[#5a4d3a]">{{ $item->nama_produk }}</td>
              <td class="px-6 py-4 text-sm text-[#5a4d3a]">{{ $item->hari_sewa }} Hari</td>
              <td class="px-6 py-4 text-sm text-[#5a4d3a]">{{ $item->jumlah }}</td>
              <td class="px-6 py-4 text-sm text-[#5a4d3a]">Rp {{ number_format($item->harga_per_hari, 0, ',', '.') }}</td>
              <td class="px-6 py-4 text-sm text-[#5a4d3a]">Rp {{ number_format($item->harga_per_hari * $item->hari_sewa * $item->jumlah, 0, ',', '.') }}</td>
            </tr>
            @endforeach
          </tbody>
          <tfoot class="bg-[#f5f1e9]">
            <tr>
              <td colspan="5" class="px-6 py-4 text-right font-medium text-[#5a4d3a]">Total:</td>
              <td class="px-6 py-4 font-medium text-[#5a4d3a]">Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
    
    <div class="modal-action">
        @if($p->verifikasiPembayaran)
            @if($p->verifikasiPembayaran->status_verifikasi !== 'ditolak')
                <form action="{{ route('orders.update-status', $p->id) }}" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="status_verifikasi" value="ditolak">
                    <button type="submit" class="bg-[#9c4a4a] hover:bg-[#8a3a3a] text-white px-4 py-2 rounded-md mr-2 transition-colors">
                        Tolak
                    </button>
                </form>
            @endif

            @if($p->verifikasiPembayaran->status_verifikasi === 'menunggu')
                <form action="{{ route('orders.update-status', $p->id) }}" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="status_verifikasi" value="diterima">
                    <button type="submit" class="bg-[#4a7c5f] hover:bg-[#3a6b4f] text-white px-4 py-2 rounded-md mr-2 transition-colors">
                        Setujui
                    </button>
                </form>
            @endif
        @endif
        
        <form method="dialog">
            <button class="bg-[#8a7555] hover:bg-[#7a6545] text-white px-4 py-2 rounded-md transition-colors">
                Tutup
            </button>
        </form>
    </div>
  </div>
  <form method="dialog" class="modal-backdrop">
    <button>close</button>
  </form>
</dialog>

<dialog id="modal-pembayaran-{{ $p->id }}" class="modal">
  <div class="modal-box max-w-2xl bg-white">
    <div class="flex justify-between items-center mb-6">
      <div>
        <h3 class="text-lg font-bold text-[#5a4d3a]">Detail Pembayaran #{{ $p->id }}</h3>
        <p class="text-sm text-[#8a7555]">{{ \Carbon\Carbon::parse($p->tanggal_pemesanan)->format('d-m-Y H:i') }}</p>
      </div>
      <form method="dialog">
        <button class="btn btn-sm btn-circle text-[#5a4d3a] hover:bg-[#f5f1e9]">✕</button>
      </form>
    </div>
    
    <div class="space-y-4">
      @if($p->verifikasiPembayaran)
        <div class="bg-[#f5f1e9] p-4 rounded-lg border border-[#d4c8a8]">
          <h4 class="font-semibold mb-2 text-[#5a4d3a]">Status Pembayaran</h4>
          <p>
            @switch($p->verifikasiPembayaran->status_verifikasi)
              @case('menunggu')
                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-[#f5e8c9] text-[#8a7555] items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  Menunggu Verifikasi
                </span>
                @break
              @case('diterima')
                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-[#e3f2e9] text-[#4a7c5f] items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                  </svg>
                  Pembayaran Diterima
                </span>
                @break
              @case('ditolak')
                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-[#fae8e8] text-[#9c4a4a] items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                  </svg>
                  Pembayaran Ditolak
                </span>
                @break
            @endswitch
          </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div class="bg-[#f5f1e9] p-4 rounded-lg border border-[#d4c8a8]">
            <h4 class="font-semibold mb-2 text-[#5a4d3a]">Bukti Pembayaran</h4>
            @if($p->verifikasiPembayaran->bukti_pembayaran)
              <img src="{{ asset($p->verifikasiPembayaran->bukti_pembayaran) }}" 
                   class="w-full h-auto rounded-lg border border-[#d4c8a8] mb-2">
              <a href="{{ asset($p->verifikasiPembayaran->bukti_pembayaran) }}" 
                 target="_blank" 
                 class="text-[#a08963] hover:text-[#8a7555] text-sm transition-colors">
                Lihat Ukuran Penuh
              </a>
            @else
              <p class="text-[#8a7555]">Tidak ada bukti pembayaran</p>
            @endif
          </div>
          
          <div class="bg-[#f5f1e9] p-4 rounded-lg border border-[#d4c8a8]">
            <h4 class="font-semibold mb-2 text-[#5a4d3a]">Bukti Jaminan</h4>
            @if($p->verifikasiPembayaran->bukti_jaminan)
              <img src="{{ asset($p->verifikasiPembayaran->bukti_jaminan) }}" 
                   class="w-full h-auto rounded-lg border border-[#d4c8a8] mb-2">
              <a href="{{ asset($p->verifikasiPembayaran->bukti_jaminan) }}" 
                 target="_blank" 
                 class="text-[#a08963] hover:text-[#8a7555] text-sm transition-colors">
                Lihat Ukuran Penuh
              </a>
            @else
              <p class="text-[#8a7555]">Tidak ada bukti jaminan</p>
            @endif
          </div>
        </div>
        
        <div class="bg-[#f5f1e9] p-4 rounded-lg border border-[#d4c8a8]">
          <h4 class="font-semibold mb-2 text-[#5a4d3a]">Informasi Tambahan</h4>
          <p class="text-sm"><span class="text-[#8a7555]">Tanggal Pembayaran:</span> 
            {{ \Carbon\Carbon::parse($p->verifikasiPembayaran->tanggal_pembayaran)->format('d-m-Y H:i') }}
          </p>
        </div>
      @else
        <div class="bg-[#f5f1e9] p-4 rounded-lg border border-[#d4c8a8] text-center">
          <p class="text-[#8a7555]">Belum ada data pembayaran untuk pesanan ini</p>
        </div>
      @endif
    </div>
    
    <div class="modal-action">
      <form method="dialog">
        <button class="bg-[#8a7555] hover:bg-[#7a6545] text-white px-4 py-2 rounded-md transition-colors">
          Tutup
        </button>
      </form>
    </div>
  </div>
  <form method="dialog" class="modal-backdrop">
    <button>close</button>
  </form>
</dialog>
@endforeach
@endsection