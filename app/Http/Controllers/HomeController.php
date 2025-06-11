<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 6 produk pertama dari database
        $products = Product::query()
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
            ])
            ->orderBy('id', 'asc')
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
        $reviews = [
            [
                'id' => 1,
                'name' => 'Farrel',
                'rating' => 5,
                'content' => "KECEWA!\nKecewa dulu pernah pake vendor lain, haha...\ntau gitu dari dulu aja pake jasa Insphony\nok banget, sound ga perlu ditanya lah,\ndan yang paling penting buat saya sih,\nkomunikasi mereka sangat baik.",
                'image' => 'https://scontent-sin6-1.xx.fbcdn.net/v/t39.30808-6/488837569_1381621146344471_888652050991545596_n.jpg'
            ],
            [
                'id' => 2,
                'name' => 'Dika',
                'rating' => 5,
                'content' => "KECEWA!\nKecewa dulu pernah pake vendor lain, haha...\ntau gitu dari dulu aja pake jasa Insphony\nok banget, sound ga perlu ditanya lah,\ndan yang paling penting buat saya sih, komunikasi mereka sangat baik.",
                'image' => 'https://c.animaapp.com/knqlfAnT/img/image-7@2x.png'
            ],
            [
                'id' => 3,
                'name' => 'Zidan',
                'rating' => 5,
                'content' => "Nyari bass?\nDi sini lengkap. Nyari jodoh? Nah, itu sih beda aplikasi ya 😜",
                'image' => 'https://c.animaapp.com/knqlfAnT/img/screenshot-2025-01-06-185534@2x.png'
            ]
        ];

        return view('pages.home', compact('products', 'requirements', 'reviews'));
    }

    public function loadMore(Request $request)
    {
        $offset = $request->input('offset', 6);
        $limit = 6;

        $products = Product::query()
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
            ])
            ->orderBy('id', 'asc')
            ->skip($offset)
            ->take($limit)
            ->get();

        $html = '';
        foreach ($products as $product) {
            // Pastikan kamu membuat komponen blade untuk menampilkan 1 produk (misal 'components.product-card')
            $html .= view('components.product-card', ['product' => $product])->render();
        }

        return response()->json([
            'html' => $html,
            'count' => $products->count()
        ]);
    }
}