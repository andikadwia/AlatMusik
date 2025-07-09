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

    $produkIds = Ulasan::select('id_produk')->distinct()->pluck('id_produk');

    foreach ($produkIds as $id_produk) {
        $rata = Ulasan::where('id_produk', $id_produk)->avg('rating');
        $jumlah = Ulasan::where('id_produk', $id_produk)->count();

        \App\Models\Product::where('id', $id_produk)->update([
            'rating_rata' => $rata,
            'total_ulasan' => $jumlah
        ]);
    }
        
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
        'title' => 'Persyaratan Reservasi',
        'description' => "● Usia minimal penyewa adalah 18 tahun.\n● Penyewa wajib mengisi data lengkap:\n- Nama lengkap\n- Alamat\n- Nomor HP/WhatsApp\n- Email\n- Tanggal dan durasi sewa\n- Jenis alat musik yang disewa",
        'icon' => 'https://c.animaapp.com/knqlfAnT/img/vector-2@2x.png'
    ],
    [
        'id' => 2,
        'title' => 'Pembayaran & Jaminan',
        'description' => "● Pembayaran harus dilakukan lunas saat pemesanan.\n● Wajib mengunggah dokumen berikut:\n- Bukti transfer\n- Foto jaminan (KTP/STNK/BPKB)\n● Jaminan asli diserahkan saat pengambilan alat.",
        'icon' => 'https://c.animaapp.com/knqlfAnT/img/vector-1@2x.png'
    ],
    [
        'id' => 3,
        'title' => 'Kebijakan',
        'description' => "● Invoice diterbitkan setelah verifikasi.\n● Prosedur pengambilan:\n- Tunjukkan invoice\n- Serahkan jaminan asli\n- Pengecekan alat bersama\n● Pengembalian tepat waktu dan dalam kondisi normal.",
        'icon' => 'https://c.animaapp.com/knqlfAnT/img/vector-4@2x.png'
    ],
    [
        'id' => 4,
        'title' => 'Denda & Sanksi',
        'description' => "● Keterlambatan: Denda Rp50.000 per hari\n● Kerusakan: Biaya perbaikan ditanggung penyewa\n● Kehilangan: Ganti rugi sesuai harga pasar\n● Dokumen palsu: Pemesanan dibatalkan dan dikenakan denda\n● Pembatalan:\n- Sebelum verifikasi: Refund 100%\n- Setelah verifikasi: Dipotong biaya admin\n- H-1 sebelum pengambilan: Tidak ada refund",
        'icon' => 'https://c.animaapp.com/knqlfAnT/img/vector-6@2x.png'
    ]
];


        // Data ulasan dummy
      // Di controller
$reviews = Ulasan::with(['user', 'produk'])
    ->where('rating', 5)
    ->orderBy('dibuat_pada', 'desc')
    ->take(4)
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