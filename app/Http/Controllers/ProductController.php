<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Ulasan;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id, Request $request)
    {
        // Get the product with fail check
        $product = Product::findOrFail($id);
        
        // Process product images
        $allImages = $product->path_gambar ? explode('|', $product->path_gambar) : [];
        $images = array_slice($allImages, 0, 4); // Take max 4 images
        $validImages = array_filter($images, function($path) {
            return file_exists(public_path($path));
        });

        // Get reviews with user relationship and sorting
        $sortOption = $request->get('sort', 'terbaru');
        $reviews = Ulasan::with('user')
            ->where('id_produk', $id);
            
        // Apply sorting based on user selection
        switch ($sortOption) {
            case 'terlama':
                $reviews = $reviews->orderBy('dibuat_pada', 'asc');
                break;
            case 'rating_tinggi':
                $reviews = $reviews->orderBy('rating', 'desc');
                break;
            case 'rating_rendah':
                $reviews = $reviews->orderBy('rating', 'asc');
                break;
            default: // 'terbaru'
                $reviews = $reviews->orderBy('dibuat_pada', 'desc');
                break;
        }
        
        $reviews = $reviews->paginate(10);
        
        // Calculate ratings
        $averageRating = $reviews->avg('rating');
        $ratingBreakdown = [
            5 => $reviews->where('rating', 5)->count(),
            4 => $reviews->where('rating', 4)->count(),
            3 => $reviews->where('rating', 3)->count(),
            2 => $reviews->where('rating', 2)->count(),
            1 => $reviews->where('rating', 1)->count(),
        ];
        
        // Format product data
        $formattedProduct = [
            'id' => $product->id,
            'name' => $product->nama,
            'description' => $product->deskripsi,
            'category' => $product->kategori,
            'price' => 'Rp ' . number_format($product->harga, 0, ',', '.') . '/hari',
            'stock' => $product->stok,
            'availability' => $product->stok > 0,
            'rating' => number_format((float)$averageRating, 1),
            'review_count' => $reviews->count(),
            'image' => $validImages[0] ?? 'default-product-image.jpg',
            'images' => $validImages
        ];
        
        return view('components.show', [
            'product' => $formattedProduct,
            'reviews' => $reviews,
            'rating_breakdown' => $ratingBreakdown,
            'average_rating' => $averageRating,
            'review_count' => $reviews->count(),
            'current_sort' => $sortOption // Pass current sort option to view
        ]);
    }
}