@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-sm">
    <h2 class="text-lg font-semibold mb-6">Form Pembayaran</h2>

    <form action="" method="POST">
        @csrf
        
        <div class="grid md:grid-cols-2 md:gap-6">
            <!-- Nama Lengkap -->
            <div class="mb-5">
                <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" 
                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Masukkan nama lengkap" required>
            </div>
            
            <!-- Email -->
            <div class="mb-5">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                <input type="email" id="email" name="email" 
                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Masukkan email" required>
            </div>
        </div>

        <div class="grid md:grid-cols-2 md:gap-6">
            <!-- No. Telepon -->
            <div class="mb-5">
                <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">No. Telepon</label>
                <input type="tel" id="phone" name="phone" 
                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Masukkan No. Telepon" required>
            </div>
            
            <!-- No. KTP -->
            <div class="mb-5">
                <label for="ktp" class="block mb-2 text-sm font-medium text-gray-900">No. KTP</label>
                <input type="text" id="ktp" name="ktp" 
                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Masukkan No. KTP" required>
            </div>
        </div>
        
        <div class="grid md:grid-cols-2 md:gap-6">
            <!-- Tanggal Mulai -->
            <div class="mb-5">
                <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900">Tanggal Mulai</label>
                <div class="relative">
                    <div class="absolute inset-y-0 end-0 flex items-center pe-3.5 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                    </div>
                    <input datepicker datepicker-format="dd/MM/yyyy" type="text" id="start_date" name="start_date"
                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="dd/MM/yyyy" required>
                </div>
            </div>
            
            <!-- Tanggal Selesai -->
            <div class="mb-5">
                <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900">Tanggal Selesai</label>
                <div class="relative">
                    <div class="absolute inset-y-0 end-0 flex items-center pe-3.5 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                    </div>
                    <input datepicker datepicker-format="dd/MM/yyyy" type="text" id="end_date" name="end_date"
                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="dd/MM/yyyy" required>
                </div>
            </div>
        </div>
        
        <!-- Alamat Lengkap -->
        <div class="mb-5">
            <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900">Alamat Lengkap</label>
            <textarea id="alamat" name="alamat" rows="3"
                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Masukkan alamat lengkap" required></textarea>
        </div>
        
        <!-- Jenis Jaminan -->
        <div class="mb-5">
            <label for="jaminan" class="block mb-2 text-sm font-medium text-gray-900">Jenis Jaminan</label>
            <select id="jaminan" name="jaminan" 
                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option selected>Pilih Jaminan</option>
                <option value="ktp">KTP</option>
                <option value="sim">SIM</option>
                <option value="kartu_pelajar">Kartu Pelajar</option>
                <option value="lainnya">Lainnya</option>
            </select>
        </div>
        
        <!-- Tambahan Catatan -->
        <div class="mb-5">
            <label for="catatan" class="block mb-2 text-sm font-medium text-gray-900">Tambahan Catatan</label>
            <textarea id="catatan" name="catatan" rows="2"
                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Masukkan catatan jika ada"></textarea>
        </div>
        
       <div class="mb-8">
    <h3 class="text-lg font-medium mb-4">Informasi Pembayaran</h3>
    
    <!-- Metode Pembayaran -->
    <div class="mb-5">
        <label class="block mb-2 text-sm font-medium text-gray-900">Metode pembayaran</label>
        
        <div class="flex items-center mb-4">
            <input id="full_payment" type="radio" value="full" name="payment_type" 
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500" checked>
            <label for="full_payment" class="ms-2 text-sm font-medium text-gray-900">
                Bayar penuh
                <p class="text-xs text-gray-500">Pembayaran lunas sekaligus</p>
            </label>
        </div>
        
        <div class="flex items-center mb-4">
            <input id="dp_payment" type="radio" value="dp" name="payment_type" 
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
            <label for="dp_payment" class="ms-2 text-sm font-medium text-gray-900">
                Bayar DP
                <p class="text-xs text-gray-500">Pembayaran uang muka (DP)</p>
            </label>
        </div>
    </div>
    
    <!-- Pilih Bank -->
    <div class="mb-5">
        <label class="block mb-2 text-sm font-medium text-gray-900">Pilih Bank untuk transfer</label>
        <div class="p-4 bg-gray-50 rounded-lg border border-gray-200 mb-4">
            <table class="w-full text-sm text-left text-gray-700">
                <tbody>
                    <tr>
                        <td class="py-2 font-medium">Nomor Rekening</td>
                        <td class="py-2">8801-2228-6721</td>
                    </tr>
                    <tr>
                        <td class="py-2 font-medium">Nama Rekening</td>
                        <td class="py-2">FAIRER LINK</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Rincian Pembayaran -->
    <div class="mb-5">
        <div class="font-medium mb-2">Rincian Pembayaran</div>
        <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
            <div class="flex justify-between py-2">
                <span>Total Biaya Sewa</span>
                <span class="font-medium">Rp 200.000</span>
            </div>
            <div class="flex justify-between py-2">
                <span>Kode Pelunasan</span>
                <span>23x237</span>
            </div>
        </div>
    </div>
    
    <!-- Unggah Bukti Pembayaran -->
    <div class="mb-5">
        <label class="block mb-2 text-sm font-medium text-gray-900">Unggah Bukti Pembayaran</label>
        <div class="flex items-center justify-center w-full">
            <label for="payment_proof" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                    </svg>
                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk mengunggah</span></p>
                    <p class="text-xs text-gray-500">Format: JPG, PNG, PDF (Maks. 2MB)</p>
                </div>
                <input id="payment_proof" name="payment_proof" type="file" class="hidden" accept="image/*,.pdf" />
            </label>
        </div>
    </div>
    
    <!-- Status Pembayaran -->
    <div class="bg-amber-50 border border-amber-200 rounded-lg p-3 mb-4">
        <div class="font-medium">Status: Menunggu pembayaran</div>
        <div class="text-sm text-gray-700">Harap segera lakukan pembayaran sebelum batas waktu</div>
    </div>
</div>
        <!-- Tombol Aksi -->
        <div class="flex justify-end gap-2">
            <button type="button" formaction="" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                Simpan draft
            </button>
            <button type="button" onclick="window.history.back()" class="text-white bg-red-300 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2">
                Kembali
            </button>
            <button type="submit" class="text-black bg-primary hover:bg-primary focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5">
                Selesaikan
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/datepicker.min.js"></script>
<script>
    // Date picker initialization and price calculation
    document.addEventListener('DOMContentLoaded', function() {
        // Initial values
        const pricePerDay = 200000;
        const totalElement = document.querySelector('.flex.justify-between.py-2:nth-child(4) div:last-child');
        
        // Make sure the price is properly formatted on page load
        totalElement.textContent = `Rp ${pricePerDay.toLocaleString('id-ID')}`;
        
        // Update calculation when dates change
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');
        
        function calculatePrice() {
            if(startDateInput.value && endDateInput.value) {
                try {
                    // Parse date values from DD/MM/YYYY format
                    const startParts = startDateInput.value.split('/');
                    const endParts = endDateInput.value. split('/');
                    
                    if(startParts.length === 3 && endParts.length === 3) {
                        const startDate = new Date(`${startParts[2]}-${startParts[1]}-${startParts[0]}`);
                        const endDate = new Date(`${endParts[2]}-${endParts[1]}-${endParts[0]}`);
                        
                        // Calculate days difference
                        const diffTime = Math.abs(endDate - startDate);
                        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) || 1;
                        
                        const totalPrice = diffDays * pricePerDay;
                        
                        // Update the UI
                        totalElement.textContent = `Rp ${totalPrice.toLocaleString('id-ID')}`;
                    }
                } catch (error) {
                    console.error("Error calculating price:", error);
                }
            }
        }
        
        // Add event listeners
        startDateInput.addEventListener('changeDate', calculatePrice);
        endDateInput.addEventListener('changeDate', calculatePrice);
        startDateInput.addEventListener('change', calculatePrice);
        endDateInput.addEventListener('change', calculatePrice);
    });
</script>
@endpush