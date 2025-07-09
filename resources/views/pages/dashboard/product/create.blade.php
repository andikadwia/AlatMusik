<dialog id="modal-tambah" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Tambah Produk Baru</h3>
        <form action="{{ route('dashboard.produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text">Nama Produk</span>
                </label>
                <input type="text" name="nama" class="input input-bordered" required>
            </div>
            
            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text">Deskripsi</span>
                </label>
                <textarea name="deskripsi" class="textarea textarea-bordered"></textarea>
            </div>
            
            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text">Kategori</span>
                </label>
                <select name="kategori" class="select select-bordered" required>
                    <option value="Kordofon">Kordofon</option>
                    <option value="Aerofon">Aerofon</option>
                    <option value="Elektrofon">Elektrofon</option>
                    <option value="Membranofon">Membranofon</option>
                    <option value="Idiofon">Idiofon</option>
                </select>
            </div>
            
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Stok</span>
                    </label>
                    <input type="number" name="stok" class="input input-bordered" required min="0">
                </div>
                
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Harga</span>
                    </label>
                    <input type="number" name="harga" class="input input-bordered" required min="0">
                </div>
            </div>
            
            <div class="form-control mb-6">
                <label class="label">
                    <span class="label-text">Gambar Produk (Maksimal 4)</span>
                </label>
                <input 
                    type="file" 
                    name="gambar[]" 
                    class="file-input file-input-bordered w-full" 
                    multiple 
                    accept="image/*"
                    required
                >
                <div class="text-sm text-gray-500 mt-1">Format: JPEG, PNG, JPG (Max 2MB per gambar)</div>
            </div>
                        
            <div class="modal-action">
                <button type="button" class="btn" onclick="document.getElementById('modal-tambah').close()">Batal</button>
                <button type="submit" class="btn bg-[#a08963] hover:bg-[#8a7555] text-white">Simpan</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>