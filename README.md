# Aplikasi Penyewaan Alat Musik

Aplikasi ini merupakan sistem manajemen reservasi dan penyewaan alat musik berbasis web. Dibangun dengan Laravel dan menggunakan Tailwind CSS untuk tampilan antarmuka.

## Fitur Utama
- Manajemen data produk alat musik
- Proses penyewaan dan pengembalian alat musik
- Role pengguna: Admin & User
- Dashboard responsif dengan Tailwind CSS
- Autentikasi login menggunakan tabel `pengguna`
- Pengiriman OTP ke WhatsApp menggunakan API Fonnte

## Persyaratan Minimum
- **Laravel:** versi 10 atau lebih baru
- **XAMPP:** versi 8.2.4 atau lebih baru
- **PHP:** versi 8.1 atau lebih baru
- **Node.js & NPM:** diperlukan untuk menjalankan Tailwind CSS

## Langkah-langkah Instalasi

### 1. Clone Repository
```bash
git clone https://github.com/andikadwia/AlatMusik.git
cd AlatMusik  # Ganti dengan nama folder project Anda
```

### 2. Install Dependency Laravel
```bash
composer install
npm install && npm run dev  # Opsional (hanya jika ada frontend)
cp .env.example .env
php artisan key:generate
```

### 3. Konfigurasi Database
- File database `alatmusik,insphony.sql` tersedia di folder `public/`
- Import file `alatmusik,insphony.sql` tersebut ke dalam MySQL melalui phpMyAdmin atau tool lain
- Ubah konfigurasi `.env` agar sesuai dengan koneksi database Anda, contoh:
```bash
DB_DATABASE=alatmusik,insphony  # Ganti dengan nama db yang anda ubah (jika anda mengubah nama db nya)
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Konfigurasi OTP WhatsApp via API Fonnte
Aplikasi ini menggunakan API Fonnte untuk mengirimkan kode OTP ke WhatsApp.
Cara Konfigurasi Token:
- Daftar dan dapatkan token API di https://fonnte.com
- Buka file: `app/Http/Controllers/OTPController.php`
- Ubah bagian: `protected $deviceToken = "TOKEN_ANDA_DI_SINI";`

### 5. Jalankan Migrasi dan Seeder (Opsional)
Jika ingin mengatur ulang database dari awal, jalankan perintah:
```bash
php artisan migrate --seed
```

## Langkah-langkah Penggunaan

### 1. Jalankan Server Lokal
```bash
php artisan serve
```

Akses aplikasi melalui browser di `http://localhost:8000`

### 2. Akun Login

#### Akun User
- **Username:** `user`
- **Password:** `user123456`
bisa buat akun user baru melalui fitur registrasi

#### Akun Admin
- **Username:** `zidan`
- **Password:** `zidan123`

---

### 3. Otp lupa kata-sandi
Jika pengguna lupa kata sandi, mereka dapat menggunakan fitur “Lupa Kata sandi” pada halaman login.
Aplikasi akan:
- Meminta pengguna memasukkan nomor WhatsApp yang terdaftar
- Mengirimkan kode OTP ke WhatsApp menggunakan API Fonnte
- Memverifikasi OTP dan mengizinkan pengguna mengatur ulang kata sandi


Proyek ini dikembangkan untuk tujuan pembelajaran dan pengembangan aplikasi manajemen reservasi dan pemesanan alat musik.
Hak cipta © 2025 Insphony. Hak Cipta Dilindungi.
Anda bebas memodifikasi dan menggunakan proyek ini, selama menyertakan atribusi kepada pembuat asli.


Link Video Presentasi: https://youtu.be/FNDD6sKr0AA

Link Video Detail Tutorial Penggunaan Aplikasi: https://youtu.be/4cnygGjLFD8