<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductdashController extends Controller
{
    public function index()
    {
        $produks = Product::all();
        return view('pages.dashboard.product.index', compact('produks'));
    }

    public function create()
    {
        return view('pages.dashboard.product.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'kategori' => 'required|in:Kordofon,Aerofon,Elektrofon,Membranofon,Idiofon',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('gambar')) {
            // Simpan file ke public/uploads
            $file = $request->file('gambar');
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $path = 'uploads/'.$fileName;
            
            // Pastikan folder uploads ada dan writable
            if (!file_exists(public_path('uploads'))) {
                mkdir(public_path('uploads'), 0755, true);
            }
        }

        Produk::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'kategori' => $request->kategori,
            'path_gambar' => $path,
            'rating_rata' => 0.00,
            'total_ulasan' => 0
        ]);

        return redirect()->route('dashboard.produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $produk = Product::findOrFail($id);
        return view('pages.dashboard.produk.index', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $produk = Product::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'kategori' => 'required|in:Kordofon,Aerofon,Elektrofon,Membranofon,Idiofon',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'kategori' => $request->kategori,
        ];

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($produk->path_gambar && file_exists(public_path($produk->path_gambar))) {
                unlink(public_path($produk->path_gambar));
            }
    
            // Upload gambar baru
            $file = $request->file('gambar');
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $data['path_gambar'] = 'uploads/'.$fileName;

            if (!file_exists(public_path('uploads'))) {
                mkdir(public_path('uploads'), 0755, true);
            }
        }

        $produk->update($data);

        return redirect()->route('dashboard.produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $produk = Product::findOrFail($id);
        
        // Hapus gambar terkait
        if ($produk->path_gambar) {
            Storage::disk('public')->delete($produk->path_gambar);
        }
        
        $produk->delete();

        return redirect()->route('dashboard.produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}