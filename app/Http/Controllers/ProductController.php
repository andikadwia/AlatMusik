<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Menampilkan daftar produk
    public function index()
    {
        $products = [
            [
                'id' => 1,
                'name' => 'Fender Stratocaster',
                'category' => 'Gitar Elektrik',
                'rating' => 5,
                'price' => 'Rp 100.000/hari',
                'availability' => true,
                'image' => 'https://c.animaapp.com/knqlfAnT/img/image-4-1@2x.png'
            ],
            // ... tambahkan data produk lainnya sesuai kebutuhan
        ];

        return view('products.index', compact('products'));
    }

    // Menampilkan form tambah produk
    public function create()
    {
        return view('products.create');
    }

    // Menyimpan produk baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|string',
            'rating' => 'required|numeric|min:0|max:5',
            'availability' => 'required|boolean',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable|string'
        ]);

        // Upload gambar
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
            $validated['image'] = $imagePath;
        }

        // Di sini Anda bisa menyimpan ke database
        // Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    // Menampilkan detail produk
    public function show($id)
{
    $products = [
        1 => [
            'id' => 1,
            'name' => 'Fender Stratocaster',
            'category' => 'Gitar Elektrik',
            'rating' => 5,
            'price' => '100000', // Changed to numeric value for calculation
            'availability' => true,
            'image' => 'https://c.animaapp.com/knqlfAnT/img/image-4-1@2x.png',
            'description' => 'Gitar elektrik legendaris dengan suara yang khas. Dibuat dengan kayu alder body dan maple neck untuk sustain yang optimal.',
            'specs' => [
                'body' => 'Alder',
                'neck' => 'Maple',
                'fretboard' => 'Rosewood',
                'pickups' => '3x Single Coil',
                'bridge' => '2-Point Synchronized Tremolo'
            ],
            'condition' => 'Excellent'
        ],
        2 => [
            'id' => 2,
            'name' => 'Roland Fantom-8',
            'category' => 'Keyboard',
            'rating' => 4,
            'price' => '300000',
            'availability' => true,
            'image' => 'https://c.animaapp.com/knqlfAnT/img/image-5-1@2x.png',
            'description' => 'Workstation keyboard profesional dengan fitur lengkap untuk produksi musik.',
            'specs' => [
                'body' => 'Metal/Plastic',
                'keys' => '88 weighted keys',
                'sounds' => '3000+ preset sounds',
                'connectivity' => 'USB, MIDI, Audio Interface'
            ],
            'condition' => 'Like New'
        ],
        3 => [
            'id' => 3,
            'name' => 'Roland TD-50KV2',
            'category' => 'Drum Elektrik',
            'rating' => 4.5,
            'price' => '400000',
            'availability' => false,
            'image' => 'https://c.animaapp.com/knqlfAnT/img/image-6-1@2x.png',
            'description' => 'Drum elektronik profesional dengan sensasi bermain seperti akustik.',
            'specs' => [
                'pads' => 'Mesh Head',
                'module' => 'TD-50X',
                'kits' => '100+ preset kits',
                'connectivity' => 'USB, MIDI, Audio Output'
            ],
            'condition' => 'Excellent'
        ],
        4 => [
            'id' => 4,
            'name' => 'Yamaha Pacifica',
            'category' => 'Gitar Elektrik',
            'rating' => 4,
            'price' => '150000',
            'availability' => false,
            'image' => 'https://www.bhinneka.com/blog/wp-content/uploads/2022/12/Jenis-Alat-Musik-Gitar-Elektrik.webp',
            'description' => 'Gitar elektrik serbaguna dengan kualitas tinggi untuk berbagai genre musik.',
            'specs' => [
                'body' => 'Alder',
                'neck' => 'Maple',
                'fretboard' => 'Rosewood',
                'pickups' => 'HSS Configuration',
                'bridge' => 'Fixed Bridge'
            ],
            'condition' => 'Good'
        ],
        5 => [
            'id' => 5,
            'name' => 'Gibson Les Paul',
            'category' => 'Gitar Elektrik',
            'rating' => 5,
            'price' => '250000',
            'availability' => true,
            'image' => 'https://cdn.pixabay.com/photo/2016/10/12/23/22/electric-guitar-1736291_1280.jpg',
            'description' => 'Gitar ikonik dengan suara yang tebal dan sustain panjang.',
            'specs' => [
                'body' => 'Mahogany with Maple Top',
                'neck' => 'Mahogany',
                'fretboard' => 'Rosewood',
                'pickups' => '2x Humbucker',
                'bridge' => 'Tune-O-Matic'
            ],
            'condition' => 'Excellent'
        ]
    ];

    if (!isset($products[$id])) {
        abort(404);
    }

    // Format the price for display
    $product = $products[$id];
    $product['formatted_price'] = 'Rp ' . number_format($product['price'], 0, ',', '.') . '/hari';

    return view('components.show', ['product' => $product]);
}

    // Menampilkan form edit produk
    public function edit($id)
    {
        $product = [
            'id' => $id,
            'name' => 'Contoh Produk',
        ];

        return view('products.edit', compact('product'));
    }

    // Mengupdate produk
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|string',
            'rating' => 'required|numeric|min:0|max:5',
            'availability' => 'required|boolean',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable|string'
        ]);

        // Upload gambar baru jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika perlu
            // Storage::delete('public/'.$oldImagePath);
            
            $imagePath = $request->file('image')->store('product_images', 'public');
            $validated['image'] = $imagePath;
        }

        // Di sini Anda bisa update ke database
        // Product::find($id)->update($validated);

        return redirect()->route('products.show', $id)->with('success', 'Produk berhasil diperbarui!');
    }

    // Menghapus produk
    public function destroy($id)
    {
        // Hapus gambar terkait jika perlu
        // Storage::delete('public/'.$product->image);
        
        // Di sini Anda bisa hapus dari database
        // Product::destroy($id);

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }
}