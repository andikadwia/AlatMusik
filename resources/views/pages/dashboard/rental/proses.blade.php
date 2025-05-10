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
                <button type="button" onclick="document.getElementById('modal-pengembalian').close()" class="btn btn-ghost">
                    Batal
                </button>
                <button type="submit" class="btn btn-primary">
                    Simpan Pengembalian
                </button>
            </div>
        </form>
    </div>
</dialog>