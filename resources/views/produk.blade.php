<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahasiswa Reservation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.css"
        rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <style>
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        box-sizing: border-box;
        background-color: #E8ECD7;
    }

    body::-webkit-scrollbar {
        width: 0px;
        /* Untuk scroll bar vertikal */
        height: 0px;
        /* Untuk scroll bar horizontal */
    }

    .navbar {
            background-color: #00a651;
            height: 10%;
        }

        .navbar-brand img {
            height: 40px;
        }

        .navbar li {
            margin-right: 2rem;
            padding: 0;
        }

        .navbar li a:hover {
            background-color: #00773a;
        }

        .navbar-nav .nav-link {
    color: white !important;
    font-size: 16px;
    padding: 12px 15px;
    border-radius: 5px;
    transition: background-color 0.3s ease, transform 0.3s ease;
}
        .navbar-nav .nav-link:hover {
            background-color: #00773a;
             transform: scale(1.05); /* Slight zoom effect */
        }
        .nav-link.active {
            background-color: #00773a; /* Warna hijau saat aktif */
            color: white !important;
            border-radius: 5px; /* Membulatkan sudut */
            transition: background-color 0.3s ease;
            transform: scale(1.05); 
}

            form .form-control {
                    margin-right: 20px;
                    margin-bottom: 7px;
                }

                form .btn {
                    display: none;
    }
        #profile-icon {
            color: black;
            font-size: 30px;
            cursor: pointer;
            margin-right: 14px;
            margin-left: 15px;
            margin-top: 10px;
}

        .profile-popup h3 {
            margin: 0;
            font-size: 18px;
        }

        .profile-popup a {
            color: blue;
            text-decoration: none;
        }

        .profile-popup {
            display: none; /* Sembunyikan secara default */
            position: absolute;
            top: 60px; /* Sesuaikan posisi */
            right: 10px;
            background-color: white;
            padding: 15px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            z-index: 1000;
            width: 200px;
        }

    .lapangan-title {
        text-align: center;
        margin: 40px 0;
    }


    main {
        flex: 1;
        display: flex;
        flex-direction: column;
        padding: 20px;
    }
    .form-select {
        width: 23%;
    }


    .grid {
        flex: 1;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 20px;
    }

    .card {
        margin: 10px;
        padding: 20px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.06);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        text-align: center;
        
    }
    .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2), 0 4px 6px rgba(0, 0, 0, 0.1);
        }

    .card img {
        height: 30vh;
    }

    .card button {
        margin-top: 10px;
        padding: 5px 10px;
        background-color: #00a651;
        color: white;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }
        .card button:focus, .card button:active {
        outline: none;
        box-shadow: none;
        background-color: #00a651; 
    }

    .card button:hover {
        background-color: #00a651;
        color: white; 
        border: none; 
    }

    .content {
    flex: 1; /* Membuat konten utama fleksibel */
}

        footer {
            background-color: #00a651;
            color: white;
            font-size: 14px;
            padding: 20px 0;
            margin-top: auto; /* Pastikan footer selalu berada di bawah */
        }

footer .bi {
    font-size: 20px;
    margin-right: 7px;
    vertical-align: middle;
}

footer a {
    color: white; /* Warna default teks */
    text-decoration: none; /* Menghapus garis bawah */
    transition: color 0.3s ease, transform 0.3s ease; /* Transisi warna dan transformasi */
}


.copyright {
    background-color: rgb(1, 133, 64);
    font-size: 14px;
}
    
    </style>
</head>
<body class="bg-gray-100">

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container-fluid">
            <div class="flex items-center">
            <img src="{{ asset('images/mahasigma-reservation-high-resolution-logo.png') }}" class="logo" alt="Logo" height="70" width="100%">
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto me-4">
                    <li class="nav-item">
                        <a class="nav-link" href="beranda.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="menu_lapangan.php">Lapangan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pesanan.php">Pesanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kontak.php">Kontak</a>
                    </li>
                </ul>
            </div>
            <form action="" method="post">
                <input class="form-control me-2 mt-2" type="text" name="search" placeholder="Cari..."
                    value="" size="5">
                <button class="btn btn-outline-success" type="submit" name="keyword">Cari</button>
            </form>
            <div class="icon">
                <a href="#" class="bi bi-person-circle" id="profile-icon"></a>
            </div>
            <div id="profile-popup" class="profile-popup">
                <p>..........</p>
                <a href="ganti_sandi.php">Ubah Kata Sandi</a>
                <br>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </nav>
    
    <!-- Content -->
    <div id="home" class="container-fluid mt-5">
        <div class="row g-0">
            <div class="container">
                <h2 class="lapangan-title">Daftar Lapangan</h2>
                <form method="POST" action="">
                    <div class="col-md-7 mb-2">
                        <select name="kategori" class="form-select">
                            <option value="">Semua Kategori</option>
                        </select>
                    </div>
                </form>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('images/lap1.jpg') }}" class="card-img-top" alt="Lapangan 1">
                <div class="card-body text-center">
                    <h5 class="card-title">Lapangan 1</h5>
                    <p class="card-text">Harga: Rp. 100.000 / Jam</p>
                    <a href="produk.blade.php"></a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('images/lap2.jpg') }}" class="card-img-top" alt="Lapangan 2">
                <div class="card-body text-center">
                    <h5 class="card-title">Lapangan 2</h5>
                    <p class="card-text">Harga: Rp. 100.000 / Jam</p>
                    <a href="produk.blade.php"></a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('images/lap3.png') }}" class="card-img-top" alt="Lapangan 3">
                <div class="card-body text-center">
                    <h5 class="card-title">Lapangan 3</h5>
                    <p class="card-text">Harga: Rp. 100.000 / Jam</p>
                </div>
            </div>
        </div>
    </div>
</div>
            </div>
        </div>
    </div>

<!-- footer -->
<footer class="text-white text-center py-3">
        <div class="container">
            <h5 class="mb-3">MAHASIGMA RESERVATION</h5>
            <p class="mb-3">Menyediakan layanan reservasi atau pemesanan lapangan futsal dengan mudah dan cepat.</p>
            <div>
                <a href="https://www.instagram.com" class="text-white mx-2">
                    <i class="bi bi-instagram"></i> @Mahasigma_Reservation
                </a>
                <a href="https://www.tiktok.com" class="text-white mx-2">
                    <i class="bi bi-tiktok"></i> MAHASIGMA
                </a>
                <a href="https://www.facebook.com" class="text-white mx-2">
                    <i class="bi bi-facebook"></i> MAHASIGMA RESERVATION
                </a>
            </div></br>
            <a href="https://maps.app.goo.gl/EnTkQjMoTAhNVsYT9">Jl. Ahmad Yani Batam Kota Kota Batam, Kepulauan Riau Indonesia</a>
        </div>
    </footer>
    <div class="copyright text-center text-white py-2">
        <p class="mb-0">&copy; 2024 MAHASIGMA RESERVATION. All rights reserved.</p>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>