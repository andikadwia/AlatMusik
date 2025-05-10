@extends('layouts.main')
@section('title', 'Inshony - Data Pemesanan')

@section('content')
<h1 class="text-2xl font-bold text-center">Data Pemesanan</h1>
<div class="container mx-auto px-4 py-6">
  <div class="card bg-white shadow-sm rounded-lg mb-8">
    <div class="card-body p-6">
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pemesan</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telepon</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Harga</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($pemesanan as $p)
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">#{{ $p->id }}</td>
              <td class="px-6 py-4 whitespace-nowrap">{{ $p->nama_pelanggan }}</td>
              <td class="px-6 py-4 whitespace-nowrap">{{ $p->telepon }}</td>
              <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
              <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($p->tanggal_pemesanan)->format('d-m-Y H:i') }}</td>
              <td class="px-6 py-4 whitespace-nowrap">
                @switch($p->status)
                  @case('menunggu')
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                      Menunggu
                    </span>
                    @break
                  @case('disetujui')
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
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <button onclick="document.getElementById('modal-{{ $p->id }}').showModal()" 
                        class="text-xs bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md">
                  Detail
                </button>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                Tidak ada data pemesanan
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@foreach ($pemesanan as $p)
<dialog id="modal-{{ $p->id }}" class="modal">
  <div class="modal-box max-w-3xl">
    <div class="flex justify-between items-center mb-6">
      <div>
        <h3 class="text-lg font-bold">Detail Pemesanan #{{ $p->id }}</h3>
        <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($p->tanggal_pemesanan)->format('d-m-Y H:i') }}</p>
      </div>
      <form method="dialog">
        <button class="btn btn-sm btn-circle">✕</button>
      </form>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
      <div class="bg-gray-50 p-4 rounded-lg">
        <h4 class="font-semibold mb-2">Informasi Pelanggan</h4>
        <p><span class="text-gray-600">Nama:</span> {{ $p->nama_pelanggan }}</p>
        <p><span class="text-gray-600">Telepon:</span> {{ $p->telepon }}</p>
        <p>
          <span class="text-gray-600">Status:</span> 
          @switch($p->status)
            @case('menunggu')
              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                Menunggu
              </span>
              @break
            @case('disetujui')
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
        </p>
      </div>
      <div class="bg-gray-50 p-4 rounded-lg">
        <h4 class="font-semibold mb-2">Informasi Pembayaran</h4>
        <p><span class="text-gray-600">Total Harga:</span> Rp {{ number_format($p->total_harga, 0, ',', '.') }}</p>
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
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga/Hari</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($p->detail as $item)
            <tr>
              <td class="px-6 py-4">
                @if ($item->path_gambar)
                  <img src="{{ asset($item->path_gambar) }}" class="w-16 h-16 object-contain">
                @else
                  <div class="w-16 h-16 bg-gray-200 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                  </div>
                @endif
              </td>
              <td class="px-6 py-4">{{ $item->nama_produk }}</td>
              <td class="px-6 py-4">{{ $item->hari_sewa }} Hari</td>
              <td class="px-6 py-4">{{ $item->jumlah }}</td>
              <td class="px-6 py-4">Rp {{ number_format($item->harga_per_hari, 0, ',', '.') }}</td>
              <td class="px-6 py-4">Rp {{ number_format($item->harga_per_hari * $item->hari_sewa * $item->jumlah, 0, ',', '.') }}</td>
            </tr>
            @endforeach
          </tbody>
          <tfoot class="bg-gray-50">
            <tr>
              <td colspan="5" class="px-6 py-4 text-right font-medium">Total:</td>
              <td class="px-6 py-4 font-medium">Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
    
    <div class="modal-action">
      @if($p->status === 'menunggu')
        <form action="{{ route('dashboard.peminjaman.update-status', $p->id) }}" method="POST" class="inline">
          @csrf
          @method('PUT')
          <input type="hidden" name="status" value="disetujui">
          <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md mr-2">
            Setujui
          </button>
        </form>
        
        <form action="{{ route('dashboard.peminjaman.update-status', $p->id) }}" method="POST" class="inline">
          @csrf
          @method('PUT')
          <input type="hidden" name="status" value="ditolak">
          <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md mr-2">
            Tolak
          </button>
        </form>
      @endif
      
      <form method="dialog">
        <button class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">
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