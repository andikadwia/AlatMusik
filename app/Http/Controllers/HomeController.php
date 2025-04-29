<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = [
            [
                'name' => 'Fender Stratocaster',
                'category' => 'Gitar Elektrik',
                'rating' => 5,
                'price' => 'Rp 100.000/hari',
                'availability' => true,
                'image' => 'https://c.animaapp.com/knqlfAnT/img/image-4-1@2x.png'
            ],
            [
                'name' => 'Roland Fantom-8',
                'category' => 'Keyboard',
                'rating' => 4,
                'price' => 'Rp 300.000/hari',
                'availability' => true,
                'image' => 'https://c.animaapp.com/knqlfAnT/img/image-5-1@2x.png'
            ],
            [
                'name' => 'Roland TD-50KV2',
                'category' => 'Drum Elektrik',
                'rating' => 4.5,
                'price' => 'Rp 400.000/hari',
                'availability' => false,
                'image' => 'https://c.animaapp.com/knqlfAnT/img/image-6-1@2x.png'
            ],
            [
                'name' => 'skididaw',
                'category' => 'Drum Elektrik',
                'rating' => 4.5,
                'price' => 'Rp 400.000/hari',
                'availability' => false,
                'image' => 'https://www.bhinneka.com/blog/wp-content/uploads/2022/12/Jenis-Alat-Musik-Gitar-Elektrik.webp'
            ],
            [
                'name' => 'dika',
                'category' => 'Drum Elektrik',
                'rating' => 4.5,
                'price' => 'Rp 400.000/hari',
                'availability' => false,
                'image' => 'https://www.bhinneka.com/blog/wp-content/uploads/2022/12/Jenis-Alat-Musik-Gitar-Elektrik.webp'
            ]
        ];

        $requirements = [
            [
                'title' => 'Identitas',
                'description' => "KTP/SIM/PASPOR\nKartu Pelajar/Mahasiswa\nUsia Minimal 18 tahun",
                'icon' => 'https://c.animaapp.com/knqlfAnT/img/vector-2@2x.png'
            ],
            [
                'title' => 'Deposit',
                'description' => "Dikembalikan setelah pengembalian\nPembayaran via cash",
                'icon' => 'https://c.animaapp.com/knqlfAnT/img/vector-1@2x.png'
            ],
            [
                'title' => 'Dokumen',
                'description' => "Surat perjanjian sewa\nBukti pembayaran\nForm pemeriksaan alat",
                'icon' => 'https://c.animaapp.com/knqlfAnT/img/vector-4@2x.png'
            ],
            [
                'title' => 'Jaminan',
                'description' => "STNK/BPKB Kendaraan\nKTP\nAtau deposit tunai",
                'icon' => 'https://c.animaapp.com/knqlfAnT/img/vector-6@2x.png'
            ]
        ];

        $reviews = [
            [
                'name' => 'Farrel',
                'rating' => 5,
                'content' => "KECEWA!\nKecewa dulu pernah pake vendor lain, haha...\ntau gitu dari dulu aja pake jasa Insphony\nok banget, sound ga perlu ditanya lah,\ndan yang paling penting buat saya sih,\nkomunikasi mereka sangat baik.",
                'image' => 'https://scontent.fbth9-1.fna.fbcdn.net/v/t39.30808-6/488837569_1381621146344471_888652050991545596_n.jpg?_nc_cat=111&ccb=1-7&_nc_sid=6ee11a&_nc_eui2=AeEJFuZO1Ckw-r9UWL-cAFt1ZHe0voJJQfxkd7S-gklB_KSfML9pNXPyd0c1hXoznhFwr86DaapoWT9osZ9JbQRR&_nc_ohc=9fMoF-jHubIQ7kNvwGgMPyL&_nc_oc=AdnhvldQyekAJjzP7JZQRaslaNQvKZwKVfv8myA96a7DA0kj2hs51lTD1nBBWJwGDgg&_nc_zt=23&_nc_ht=scontent.fbth9-1.fna&_nc_gid=bmv1U4oNUJDzAbSVkzIk2g&oh=00_AfG4z2ZLDgWMYPkV7L90ZmYcxi8UFVn1eA4VeAG0QgunAg&oe=6816349F'
            ],
            [
                'name' => 'Dika',
                'rating' => 5,
                'content' => "KECEWA!\nKecewa dulu pernah pake vendor lain, haha...\ntau gitu dari dulu aja pake jasa Insphony\nok banget, sound ga perlu ditanya lah,\ndan yang paling penting buat saya sih,\nkomunikasi mereka sangat baik.",
                'image' => 'https://c.animaapp.com/knqlfAnT/img/image-7@2x.png'
            ],
            [
                'name' => 'Sigma Skibidi',
                'rating' => 5,
                'content' => "KECEWA!/nKecewa dulu pernah pake vendor lain, haha...\ntau gitu dari dulu aja pake jasa Insphony\nok banget, sound ga perlu ditanya lah,\ndan yang paling penting buat saya sih,\nkomunikasi mereka sangat baik.",
                'image' => 'https://c.animaapp.com/knqlfAnT/img/screenshot-2025-01-06-185534@2x.png'
            ]
        ];

        return view('pages.home', compact('products', 'requirements', 'reviews'));
    }
}