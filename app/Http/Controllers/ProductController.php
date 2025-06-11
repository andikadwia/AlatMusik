<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::findOrFail($id);
        
        // Format product data sama seperti di HomeController
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
            'image' => $product->path_gambar
        ];
        
        return view('components.show', ['product' => $formattedProduct]);
    }
}