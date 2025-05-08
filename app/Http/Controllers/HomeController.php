<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = [
            [
                'id' => 1, // Pastikan semua produk memiliki ID
                'name' => 'Fender Stratocaster',
                'category' => 'Gitar Elektrik',
                'rating' => 5,
                'price' => 'Rp 100.000/hari',
                'availability' => true,
                'image' => 'https://c.animaapp.com/knqlfAnT/img/image-4-1@2x.png'
            ],
            [
                'id' => 2, // Tambahkan ID
                'name' => 'Roland Fantom-8',
                'category' => 'Keyboard',
                'rating' => 4,
                'price' => 'Rp 300.000/hari',
                'availability' => true,
                'image' => 'https://c.animaapp.com/knqlfAnT/img/image-5-1@2x.png'
            ],
            [
                'id' => 3, // Tambahkan ID
                'name' => 'Roland TD-50KV2',
                'category' => 'Drum Elektrik',
                'rating' => 4.5,
                'price' => 'Rp 400.000/hari',
                'availability' => false,
                'image' => 'https://c.animaapp.com/knqlfAnT/img/image-6-1@2x.png'
            ],
            [
                'id' => 4, // Tambahkan ID
                'name' => 'Yamha Pacifica',
                'category' => 'Gitar Elektrik',
                'rating' => 4,
                'price' => 'Rp 150.000/hari',
                'availability' => false,
                'image' => 'https://www.bhinneka.com/blog/wp-content/uploads/2022/12/Jenis-Alat-Musik-Gitar-Elektrik.webp'
            ],
            [
                'id' => 5, // Tambahkan ID
                'name' => 'Gibson Les Paul',
                'category' => 'Gitar Elektrik',
                'rating' => 5,
                'price' => 'Rp 250.000/hari',
                'availability' => true,
                'image' => 'https://cdn.pixabay.com/photo/2016/10/12/23/22/electric-guitar-1736291_1280.jpg'
            ]
        ];

        $requirements = [
            [
                'id' => 1, // Tambahkan ID untuk konsistensi
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

        $reviews = [
            [
                'id' => 1, // Tambahkan ID
                'name' => 'Farrel',
                'rating' => 5,
                'content' => "KECEWA!\nKecewa dulu pernah pake vendor lain, haha...\ntau gitu dari dulu aja pake jasa Insphony\nok banget, sound ga perlu ditanya lah,\ndan yang paling penting buat saya sih,\nkomunikasi mereka sangat baik.",
                'image' => 'https://scontent-sin6-1.xx.fbcdn.net/v/t39.30808-6/488837569_1381621146344471_888652050991545596_n.jpg?_nc_cat=111&ccb=1-7&_nc_sid=6ee11a&_nc_eui2=AeEJFuZO1Ckw-r9UWL-cAFt1ZHe0voJJQfxkd7S-gklB_KSfML9pNXPyd0c1hXoznhFwr86DaapoWT9osZ9JbQRR&_nc_ohc=GdrEsvu6qLsQ7kNvwG2IBnU&_nc_oc=AdnA-AJKxd95DUReh8vz2XCnCmkkAmHhS3cnAFEApWx6Kr-npFYCJVRtzeP7tWvCTPI&_nc_zt=23&_nc_ht=scontent-sin6-1.xx&_nc_gid=XytYK2-DaYpIeSW3358Hiw&oh=00_AfIVIlEm3pndLwK64raOxkInC5oB-QoCBO5b0HYCWLmwdw&oe=6820885F'
            ],
            [
                'id' => 2,
                'name' => 'Dika',
                'rating' => 5,
                'content' => "KECEWA!\n
Kecewa dulu pernah pake vendor lain, haha...
tau gitu dari dulu aja pake jasa Insphony ok banget, sound ga perlu ditanya lah, dan yang paling penting buat saya sih, komunikasi mereka sangat baik.",
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
}