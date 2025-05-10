<dialog id="editModal-{{ $produk->id }}" class="modal">
                    <div class="modal-box">
                        <form method="POST" action="{{ route('dashboard.produk.update', $produk->id) }}" enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <h3 class="font-bold text-lg">Ubah Produk</h3>
                            
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Nama Produk</span>
                                </label>
                                <input type="text" name="nama" value="{{ $produk->nama }}" class="input input-bordered w-full" required>
                            </div>
                            
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Harga per Hari</span>
                                </label>
                                <input type="number" name="harga" value="{{ $produk->harga }}" class="input input-bordered w-full" required>
                            </div>
                            
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Stok</span>
                                </label>
                                <input type="number" name="stok" value="{{ $produk->stok }}" class="input input-bordered w-full" required>
                            </div>
                            
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Kategori</span>
                                </label>
                                <select name="kategori" class="select select-bordered w-full" required>
                                    <option value="Kordofon" {{ $produk->kategori == 'Kordofon' ? 'selected' : '' }}>Kordofon</option>
                                    <option value="Aerofon" {{ $produk->kategori == 'Aerofon' ? 'selected' : '' }}>Aerofon</option>
                                    <option value="Elektrofon" {{ $produk->kategori == 'Elektrofon' ? 'selected' : '' }}>Elektrofon</option>
                                    <option value="Membranofon" {{ $produk->kategori == 'Membranofon' ? 'selected' : '' }}>Membranofon</option>
                                    <option value="Idiofon" {{ $produk->kategori == 'Idiofon' ? 'selected' : '' }}>Idiofon</option>
                                </select>
                            </div>
                            
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Gambar Produk</span>
                                </label>
                                <input type="file" name="gambar" class="file-input file-input-bordered w-full">
                                <label class="label">
                                    <span class="label-text-alt">Kosongkan jika tidak ingin mengubah gambar</span>
                                </label>
                            </div>
                            
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Deskripsi</span>
                                </label>
                                <textarea name="deskripsi" class="textarea textarea-bordered h-24">{{ $produk->deskripsi }}</textarea>
                            </div>
                            
                            <div class="modal-action">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                <button type="button" onclick="document.getElementById('editModal-{{ $produk->id }}').close()" class="btn">Batal</button>
                            </div>
                        </form>
                    </div>
                </dialog>