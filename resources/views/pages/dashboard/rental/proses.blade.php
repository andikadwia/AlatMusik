<dialog id="modal-pengembalian" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Proses Pengembalian</h3>
        <form method="POST" action="{{ route('dashboard.peminjaman.proses-pengembalian') }}">
            @csrf
            <input type="hidden" name="id_pemesanan" id="pengembalian-id">

            <div class="form-control mt-4">
                <label class="label">
                    <span class="label-text">Kondisi Alat</span>
                </label>
                <select name="kondisi" class="select select-bordered w-full" required>
                    <option value="">Pilih Kondisi</option>
                    <option value="sangat_baik">Sangat Baik</option>
                    <option value="baik">Baik</option>
                    <option value="rusak">Rusak</option>
                    <option value="hilang">Hilang</option>
                </select>
            </div>

            <div class="form-control mt-4">
                <label class="label">
                    <span class="label-text">Denda (Rp)</span>
                </label>
                <input type="number" name="denda" min="0" class="input input-bordered w-full" placeholder="0">
            </div>

            <div class="form-control mt-4">
                <label class="label">
                    <span class="label-text">Catatan</span>
                </label>
                <textarea name="catatan" class="textarea textarea-bordered" placeholder="Catatan kondisi alat"></textarea>
            </div>

            <div class="modal-action">
                <button type="button" onclick="document.getElementById('modal-pengembalian').close()" class="btn mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Batal
                </button>
                <button type="submit" class="btn bg-[#8a7555] hover:bg-[#7a6545] text-white">
                    Simpan Pengembalian
                </button>
            </div>
        </form>
    </div>
</dialog>