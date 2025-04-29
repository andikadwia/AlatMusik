<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Jika menggunakan model

class ProductController extends Controller
{
    /**
     * Menampilkan daftar produk
     */
    public function index()
    {
        // Jika menggunakan array statis
        $products = [
            [
                'name' => 'Gitar Akustik Yamaha',
                'category' => 'Gitar',
                'rating' => 4.5,
                'price' => 'Rp 150.000/hari',
                'availability' => true,
                'image' => 'images/gitar.jpg'
            ],
            [
                'name' => 'Piano Digital Roland',
                'category' => 'Piano',
                'rating' => 5,
                'price' => 'Rp 300.000/hari',
                'availability' => true,
                'image' => 'images/piano.jpg'
            ],
            // Tambahkan produk lain sesuai kebutuhan
        ];

        // Jika menggunakan database:
        // $products = Product::all();

        return view('products.index', compact('products'));
    }

    /**
     * Menampilkan form tambah produk
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Menyimpan produk baru
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'rating' => 'required|numeric|min:0|max:5',
            'price' => 'required|string',
            'availability' => 'required|boolean',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Upload gambar
        if($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
            $validated['image'] = $imagePath;
        }

        // Jika menggunakan array (simpan ke session)
        // $products = session('products', []);
        // $products[] = $validated;
        // session(['products' => $products]);

        // Jika menggunakan database:
        // Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }
}