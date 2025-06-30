<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Ulasan;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('category');
        
        // Query produk dengan filter
        $productsQuery = Product::query()
            ->select([
                'id',
                'nama as name',
                'deskripsi as description',
                'kategori as category',
                'harga as price',
                'stok as stock',
                'rating_rata as rating',
                'total_ulasan as review_count',
                'path_gambar as image'
            ]);
            
        if ($search) {
            $productsQuery->where('nama', 'like', '%'.$search.'%');
        }
        
        if ($category && $category !== 'Semua Kategori') {
            $productsQuery->where('kategori', $category);
        }
        
        $products = $productsQuery->orderBy('id', 'asc')
            ->take(6)
            ->get();

        // Data syarat reservasi
        $requirements = [
            [
                'id' => 1,
                'title' => 'Identitas',
                'description' => "KTP/SIM/PASPOR\nKartu Pelajar/Mahasiswa\nUsia Minimal 18 tahun",
                'icon' => 'https://c.animaapp.com/knqlfAnT/img/vector-2@2x.png'
            ],
            [
                'id' => 2,
                'title' => 'Deposit',
                'description' => "Dikembalikan setelah pengembalian\nPembayaran via cash",
                'icon' => 'https://c.animaapp.com/knqlfAnT/img/vector-1@2x.png'
            ],
            [
                'id' => 3,
                'title' => 'Dokumen',
                'description' => "Surat perjanjian sewa\nBukti pembayaran\nForm pemeriksaan alat",
                'icon' => 'https://c.animaapp.com/knqlfAnT/img/vector-4@2x.png'
            ],
            [
                'id' => 4,
                'title' => 'Jaminan',
                'description' => "STNK/BPKB Kendaraan\nKTP\nAtau deposit tunai",
                'icon' => 'https://c.animaapp.com/knqlfAnT/img/vector-6@2x.png'
            ]
        ];

        // Data ulasan dummy
      // Di controller
$reviews = Ulasan::with(['user', 'produk'])
    ->where('rating', 5)
    ->orderBy('dibuat_pada', 'desc')
    ->take(3)
    ->get();

// Jika kurang dari 3, tambahkan ulasan rating tertinggi
if ($reviews->count() < 3) {
    $additionalReviews = Ulasan::with(['user', 'produk'])
        ->where('rating', '>=', 4)
        ->whereNotIn('id', $reviews->pluck('id'))
        ->orderBy('rating', 'desc')
        ->orderBy('dibuat_pada', 'desc')
        ->take(3 - $reviews->count())
        ->get();
    
    $reviews = $reviews->merge($additionalReviews);
}

$reviews = $reviews->map(function ($ulasan) {
    return [
        'id' => $ulasan->id,
        'name' => $ulasan->user->name,
        'rating' => $ulasan->rating,
        'content' => $ulasan->komentar,
        'image' => $ulasan->user->foto_profil ?? 'https://via.placeholder.com/150',
        'product_image' => $ulasan->produk->path_gambar ?? 'https://via.placeholder.com/150',
        'product_name' => $ulasan->produk->nama ?? 'Unknown Product',
        'is_top_rated' => $ulasan->rating == 5 
    ];
});

return view('pages.home', compact('products', 'requirements', 'reviews', 'search', 'category'));
    }

    public function loadMore(Request $request)
    {
        $offset = $request->input('offset', 6);
        $limit = 6;
        $search = $request->input('search');
        $category = $request->input('category');

        $productsQuery = Product::query()
            ->select([
                'id',
                'nama as name',
                'deskripsi as description',
                'kategori as category',
                'harga as price',
                'stok as stock',
                'rating_rata as rating',
                'total_ulasan as review_count',
                'path_gambar as image'
            ]);
            
        if ($search) {
            $productsQuery->where('nama', 'like', '%'.$search.'%');
        }
        
        if ($category && $category !== 'Semua Kategori') {
            $productsQuery->where('kategori', $category);
        }
            
        $products = $productsQuery->orderBy('id', 'asc')
            ->skip($offset)
            ->take($limit)
            ->get();

        $html = '';
        foreach ($products as $product) {
            $html .= view('components.product-card', ['product' => $product])->render();
        }

        return response()->json([
            'html' => $html,
            'count' => $products->count()
        ]);
    }
}