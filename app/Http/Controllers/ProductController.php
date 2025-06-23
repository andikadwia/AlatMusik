<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::findOrFail($id);
        
        // Pisahkan path gambar dan pastikan maksimal 4 gambar
        $allImages = $product->path_gambar ? explode('|', $product->path_gambar) : [];
        $images = array_slice($allImages, 0, 4); // Ambil maksimal 4 gambar pertama
        
        // Validasi setiap path gambar
        $validImages = array_filter($images, function($path) {
            return file_exists(public_path($path));
        });

        // Format product data
        $formattedProduct = [
            'id' => $product->id,
            'name' => $product->nama,
            'description' => $product->deskripsi,
            'category' => $product->kategori,
            'price' => 'Rp ' . number_format($product->harga, 0, ',', '.') . '/hari',
            'stock' => $product->stok,
            'availability' => $product->stok > 0,
            'rating' => number_format((float)$product->rating_rata, 1),
            'review_count' => $product->total_ulasan,
            'image' => $validImages[0] ?? 'default-product-image.jpg', // Fallback image
            'images' => $validImages
        ];
        
        return view('components.show', ['product' => $formattedProduct]);
    }
}