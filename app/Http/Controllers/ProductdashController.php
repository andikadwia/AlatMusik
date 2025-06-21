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

    // Method khusus untuk pencarian
    public function search(Request $request)
    {
        $search = $request->input('search');
        
        $produks = Product::when($search, function($query) use ($search) {
                        return $query->where('nama', 'like', '%'.$search.'%');
                    })
                    ->where('stok', '>', 0)
                    ->orderBy('nama')
                    ->get();
                    
        return view('pages.dashboard.product.index', [
            'produks' => $produks,
            'search' => $search
        ]);
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
            'gambar' => 'nullable|array|max:4', // Diubah jadi nullable
            'gambar.*' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Pastikan folder uploads ada
        if (!file_exists(public_path('uploads'))) {
            mkdir(public_path('uploads'), 0755, true);
        }

        $imagePaths = [];
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $image) {
                if (count($imagePaths) >= 4) break;
                
                $fileName = time().'_'.$image->getClientOriginalName();
                $image->move(public_path('uploads'), $fileName);
                $imagePaths[] = 'uploads/'.$fileName;
            }
        }

        Product::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'kategori' => $request->kategori,
            'path_gambar' => implode('|', $imagePaths), // Simpan dengan pemisah pipe
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
            'gambar' => 'nullable|array',
            'gambar.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'deleted_images' => 'nullable|array',
        ]);
        
        // Proses gambar yang dihapus
        $currentImages = $produk->path_gambar ? explode('|', $produk->path_gambar) : [];
        $deletedImages = $request->deleted_images ?? [];
        
        // Hapus gambar yang dipilih
        foreach ($deletedImages as $image) {
            if (($key = array_search($image, $currentImages)) !== false) {
                if (file_exists(public_path($image))) {
                    unlink(public_path($image));
                }
                unset($currentImages[$key]);
            }
        }
        
        // Upload gambar baru
        $newImages = [];
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $image) {
                $fileName = time().'_'.$image->getClientOriginalName();
                $image->move(public_path('uploads'), $fileName);
                $newImages[] = 'uploads/'.$fileName;
            }
        }
        
        // Gabungkan gambar yang tersisa dengan yang baru
        $allImages = array_merge($currentImages, $newImages);
        
        $produk->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'kategori' => $request->kategori,
            'path_gambar' => !empty($allImages) ? implode('|', $allImages) : null
        ]);
        
        return redirect()->route('dashboard.produk.index')
            ->with('success', 'Produk berhasil diperbarui');
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