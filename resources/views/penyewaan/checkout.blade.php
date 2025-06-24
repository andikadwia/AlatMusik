@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-sm">
    <h2 class="text-lg font-semibold mb-6">Form Penyewaan</h2>

    @if(!isset($product) || !isset($start_date) || !isset($end_date) || !isset($quantity))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong>Error!</strong> Data tidak lengkap. Silakan kembali ke halaman produk.
            <a href="{{ url()->previous() }}" class="text-blue-500 underline">Kembali</a>
        </div>
    @else
    <form action="{{ route('penyewaan.proses') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <!-- Product Information -->
        <div class="mb-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
    <div class="flex items-start gap-4">
        @php
            $images = explode('|', $product->path_gambar);
            $firstImage = $images[0];
        @endphp
        <div class="relative w-20 h-20 overflow-hidden rounded-lg">
            <img 
                src="{{ asset($firstImage) }}" 
                alt="{{ $product->nama }}" 
                class="absolute inset-0 h-full w-full object-cover object-center transition-transform duration-500 ease-out group-hover:scale-110"/>
        </div>
        <div>
            <h3 class="font-medium">{{ $product->nama }}</h3>
            <p class="text-sm text-gray-600">{{ $product->kategori }}</p>
            <p class="text-sm font-medium mt-1">Rp {{ number_format($product->harga, 0, ',', '.') }} / hari</p>
        </div>
    </div>
</div>
        
        <!-- Hidden fields -->
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <input type="hidden" name="start_date" value="{{ $start_date }}">
        <input type="hidden" name="end_date" value="{{ $end_date }}">
        <input type="hidden" name="quantity" value="{{ $quantity }}">

        <!-- Customer Information -->
        <div class="mb-6">
            <h3 class="text-lg font-medium mb-4">Informasi Pemesan</h3>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900">Nama Pemesan</label>
                    <div class="p-2 bg-gray-50 rounded border border-gray-200">
                        {{ auth()->user()->name }}
                    </div>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900">Nomor Telepon</label>
                    <div class="p-2 bg-gray-50 rounded border border-gray-200">
                        {{ auth()->user()->telepon }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Date Information -->
        <div class="grid md:grid-cols-2 md:gap-6 mb-5">
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900">Tanggal Mulai</label>
                <div class="p-2 bg-gray-50 rounded border border-gray-200">
                    {{ \Carbon\Carbon::parse($start_date)->format('d/m/Y') }}
                </div>
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900">Tanggal Selesai</label>
                <div class="p-2 bg-gray-50 rounded border border-gray-200">
                    {{ \Carbon\Carbon::parse($end_date)->format('d/m/Y') }}
                </div>
            </div>
        </div>

        <!-- Rental Summary -->
        <div class="mb-5 p-4 bg-gray-50 rounded-lg border border-gray-200">
            <div class="flex justify-between py-2">
                <span>Jumlah</span>
                <span>{{ $quantity }} Unit</span>
            </div>
            <div class="flex justify-between py-2">
                <span>Durasi Sewa</span>
                <span>{{ $duration }} Hari</span>
            </div>
            <div class="flex justify-between py-2 font-medium">
                <span>Total Biaya Sewa</span>
                <span>Rp {{ number_format($total_price, 0, ',', '.') }}</span>
            </div>
        </div>
        
        <!-- Guarantee Section -->
        <div class="mb-5">
            <label for="jaminan" class="block mb-2 text-sm font-medium text-gray-900">Jenis Jaminan</label>
            <select id="jaminan" name="jenis_jaminan" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                <option value="" selected disabled>Pilih Jaminan</option>
                <option value="ktp">KTP</option>
                <option value="sim">SIM</option>
                <option value="kartu_pelajar">Kartu Pelajar</option>
                <option value="lainnya">Lainnya</option>
            </select>
        </div>
        
        <!-- Guarantee Proof Upload -->
        <div class="mb-5">
            <label for="foto_jaminan" class="block mb-2 text-sm font-medium text-gray-900">Unggah Foto Jaminan</label>
            <div class="flex items-center justify-center w-full">
                <label for="foto_jaminan" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                        </svg>
                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk mengunggah</span></p>
                        <p class="text-xs text-gray-500">Format: JPG, PNG (Maks. 2MB)</p>
                    </div>
                    <input id="foto_jaminan" name="foto_jaminan" type="file" class="hidden" accept="image/*" required />
                </label>
            </div>
            <div id="file-preview-jaminan" class="mt-2 hidden">
                <img id="preview-image-jaminan" class="h-32 rounded-md">
            </div>
        </div>
        
        <!-- Payment Information Section -->
        <div class="mb-8">
            <h3 class="text-lg font-medium mb-4">Informasi Pembayaran</h3>
            
            <!-- Bank Selection -->
            <div class="mb-5">
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200 mb-4">
                    <table class="w-full text-sm text-left text-gray-700">
                        <tbody>
                            <tr>
                                <td class="py-2 font-medium">Nomor Rekening</td>
                                <td class="py-2">8801-2228-6721</td>
                            </tr>
                            <tr>
                                <td class="py-2 font-medium">Nama Rekening</td>
                                <td class="py-2">farel</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Payment Proof Upload -->
            <div class="mb-5">
                <label for="bukti_pembayaran" class="block mb-2 text-sm font-medium text-gray-900">Unggah Bukti Pembayaran</label>
                <div class="flex items-center justify-center w-full">
                    <label for="bukti_pembayaran" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk mengunggah</span></p>
                            <p class="text-xs text-gray-500">Format: JPG, PNG (Maks. 2MB)</p>
                        </div>
                        <input id="bukti_pembayaran" name="bukti_pembayaran" type="file" class="hidden" accept="image/*" required />
                    </label>
                </div>
                <div id="file-preview-bukti" class="mt-2 hidden">
                    <img id="preview-image-bukti" class="h-32 rounded-md">
                </div>
            </div>
        </div>
        
        <!-- Action Buttons -->
        <div class="flex justify-end gap-2">
            <button type="button" onclick="window.history.back()" class="text-white bg-red-300 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2">
                Kembali
            </button>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                Konfirmasi Pembayaran
            </button>
        </div>
    </form>
    @endif
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Preview bukti pembayaran
    const buktiInput = document.getElementById('bukti_pembayaran');
    const filePreviewBukti = document.getElementById('file-preview-bukti');
    const previewImageBukti = document.getElementById('preview-image-bukti');
    
    buktiInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file terlalu besar. Maksimal 2MB.');
                this.value = '';
                return;
            }
            
            const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!validTypes.includes(file.type)) {
                alert('Format file tidak valid. Hanya JPG, JPEG, atau PNG yang diperbolehkan.');
                this.value = '';
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(event) {
                filePreviewBukti.classList.remove('hidden');
                previewImageBukti.src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
    
    // Preview foto jaminan
    const jaminanInput = document.getElementById('foto_jaminan');
    const filePreviewJaminan = document.getElementById('file-preview-jaminan');
    const previewImageJaminan = document.getElementById('preview-image-jaminan');
    
    jaminanInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file terlalu besar. Maksimal 2MB.');
                this.value = '';
                return;
            }
            
            const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!validTypes.includes(file.type)) {
                alert('Format file tidak valid. Hanya JPG, JPEG, atau PNG yang diperbolehkan.');
                this.value = '';
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(event) {
                filePreviewJaminan.classList.remove('hidden');
                previewImageJaminan.src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
    
    // Form submission handling
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            const submitButton = form.querySelector('button[type="submit"]');
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.innerHTML = `
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Memproses...
                `;
            }
        });
    }
});
</script>
@endpush