@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Form Penyewaan</h2>

    @if(!isset($product) || !isset($start_date) || !isset($end_date) || !isset($quantity))
        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">Data tidak lengkap</h3>
                    <div class="mt-2 text-sm text-red-700">
                        <p>Silakan kembali ke halaman produk untuk memilih rental period dan quantity.</p>
                    </div>
                    <div class="mt-4">
                        <a href="{{ url()->previous() }}" class="inline-flex items-center text-sm font-medium text-[#a08963] hover:text-[#8a7554]">
                            <svg class="mr-1.5 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                            </svg>
                            Kembali ke halaman produk
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
    <form action="{{ route('penyewaan.proses') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <!-- Product Information -->
        <div class="bg-gray-50 rounded-lg border border-gray-200 p-4">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Produk Disewa</h3>
            <div class="flex items-start gap-4">
                @php
                    $images = explode('|', $product->path_gambar);
                    $firstImage = $images[0];
                @endphp
                <div class="flex-shrink-0">
                    <img 
                        src="{{ asset($firstImage) }}" 
                        alt="{{ $product->nama }}" 
                        class="h-20 w-20 rounded-lg object-cover object-center"
                    />
                </div>
                <div>
                    <h3 class="font-medium text-gray-900">{{ $product->nama }}</h3>
                    <p class="text-sm text-gray-500">{{ $product->kategori }}</p>
                    <p class="text-sm font-medium text-[#a08963] mt-1">Rp {{ number_format($product->harga, 0, ',', '.') }} / hari</p>
                </div>
            </div>
        </div>
        
        <!-- Hidden fields -->
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <input type="hidden" name="start_date" value="{{ $start_date }}">
        <input type="hidden" name="end_date" value="{{ $end_date }}">
        <input type="hidden" name="quantity" value="{{ $quantity }}">

        <!-- Customer Information -->
        <div class="bg-white rounded-lg border border-gray-200 p-4">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Pemesan</h3>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pemesan</label>
                    <div class="relative mt-1 rounded-md shadow-sm">
                        <div class="block w-full rounded-md border-gray-300 pl-3 pr-12 py-2 bg-gray-50 border border-gray-200">
                            {{ auth()->user()->name }}
                        </div>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                    <div class="relative mt-1 rounded-md shadow-sm">
                        <div class="block w-full rounded-md border-gray-300 pl-3 pr-12 py-2 bg-gray-50 border border-gray-200">
                            {{ auth()->user()->telepon }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rental Period -->
        <div class="bg-white rounded-lg border border-gray-200 p-4">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Periode Penyewaan</h3>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                    <div class="relative mt-1 rounded-md shadow-sm">
                        <div class="block w-full rounded-md border-gray-300 pl-3 pr-12 py-2 bg-gray-50 border border-gray-200">
                            {{ \Carbon\Carbon::parse($start_date)->translatedFormat('d F Y') }}
                        </div>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai</label>
                    <div class="relative mt-1 rounded-md shadow-sm">
                        <div class="block w-full rounded-md border-gray-300 pl-3 pr-12 py-2 bg-gray-50 border border-gray-200">
                            {{ \Carbon\Carbon::parse($end_date)->translatedFormat('d F Y') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rental Summary -->
        <div class="bg-white rounded-lg border border-gray-200 p-4">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Ringkasan Penyewaan</h3>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-sm text-gray-600">Jumlah Unit</span>
                    <span class="text-sm font-medium">{{ $quantity }} Unit</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-sm text-gray-600">Durasi Sewa</span>
                    <span class="text-sm font-medium">{{ $duration }} Hari</span>
                </div>
                <div class="border-t border-gray-200 pt-3 flex justify-between">
                    <span class="text-base font-medium text-gray-900">Total Biaya Sewa</span>
                    <span class="text-base font-bold text-[#a08963]">Rp {{ number_format($total_price, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
        
        <!-- Guarantee Section -->
        <div class="bg-white rounded-lg border border-gray-200 p-4">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Jaminan</h3>
            
            <div class="mb-4">
                <label for="jaminan" class="block text-sm font-medium text-gray-700 mb-1">Jenis Jaminan</label>
                <select id="jaminan" name="jenis_jaminan" class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-[#a08963] focus:outline-none focus:ring-[#a08963] sm:text-sm" required>
                    <option value="" selected disabled>Pilih Jaminan</option>
                    <option value="ktp">KTP</option>
                    <option value="sim">SIM</option>
                    <option value="kartu_pelajar">Kartu Pelajar</option>
                    <option value="lainnya">Lainnya</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Unggah Foto Jaminan</label>
                <div class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="foto_jaminan" class="relative cursor-pointer rounded-md bg-white font-medium text-[#a08963] hover:text-[#8a7554] focus-within:outline-none focus-within:ring-2 focus-within:ring-[#a08963] focus-within:ring-offset-2">
                                <span>Upload a file</span>
                                <input id="foto_jaminan" name="foto_jaminan" type="file" class="sr-only" accept="image/*" required>
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG up to 2MB</p>
                    </div>
                </div>
                <div id="file-preview-jaminan" class="mt-2 hidden">
                    <img id="preview-image-jaminan" class="h-32 rounded-md object-cover">
                </div>
            </div>
        </div>
        
        <!-- Payment Information Section -->
        <div class="bg-white rounded-lg border border-gray-200 p-4">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Pembayaran</h3>
            
            <div class="mb-4 rounded-lg bg-gray-50 p-4">
                <h4 class="text-sm font-medium text-gray-700 mb-2">Transfer ke rekening berikut:</h4>
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-md">
                    <table class="min-w-full divide-y divide-gray-300">
                        <tbody class="divide-y divide-gray-200 bg-white">
                            <tr>
                                <td class="whitespace-nowrap py-3 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">Bank</td>
                                <td class="whitespace-nowrap px-3 py-3 text-sm text-gray-500">BCA</td>
                            </tr>
                            <tr>
                                <td class="whitespace-nowrap py-3 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">Nomor Rekening</td>
                                <td class="whitespace-nowrap px-3 py-3 text-sm text-gray-500">8801-2228-6721</td>
                            </tr>
                            <tr>
                                <td class="whitespace-nowrap py-3 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">Nama Rekening</td>
                                <td class="whitespace-nowrap px-3 py-3 text-sm text-gray-500">Farel Rental</td>
                            </tr>
                            <tr>
                                <td class="whitespace-nowrap py-3 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">Jumlah Transfer</td>
                                <td class="whitespace-nowrap px-3 py-3 text-sm font-bold text-[#a08963]">Rp {{ number_format($total_price, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Unggah Bukti Pembayaran</label>
                <div class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="bukti_pembayaran" class="relative cursor-pointer rounded-md bg-white font-medium text-[#a08963] hover:text-[#8a7554] focus-within:outline-none focus-within:ring-2 focus-within:ring-[#a08963] focus-within:ring-offset-2">
                                <span>Upload a file</span>
                                <input id="bukti_pembayaran" name="bukti_pembayaran" type="file" class="sr-only" accept="image/*" required>
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG up to 2MB</p>
                    </div>
                </div>
                <div id="file-preview-bukti" class="mt-2 hidden">
                    <img id="preview-image-bukti" class="h-32 rounded-md object-cover">
                </div>
            </div>
        </div>
        
        <!-- Action Buttons -->
        <div class="flex justify-end gap-3 pt-4">
            <button type="button" onclick="window.history.back()" class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#a08963] focus:ring-offset-2">
                Kembali
            </button>
            <button type="submit" class="inline-flex items-center rounded-md border border-transparent bg-[#a08963] px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-[#8a7554] focus:outline-none focus:ring-2 focus:ring-[#a08963] focus:ring-offset-2">
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
                    <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
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