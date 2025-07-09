<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enhanced Footer - Insphony</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'earth': {
                            50: '#faf9f7',
                            100: '#f5f2ee',
                            200: '#ebe5dd',
                            300: '#ddd4c7',
                            400: '#cbbfa9',
                            500: '#a08963',
                            600: '#8a7552',
                            700: '#6d5d42',
                            800: '#594d36',
                            900: '#473e2c'
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col justify-end">
    <!-- Demo content to show footer positioning -->
    <div class="flex-1 p-8">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-4">Insphony Website</h1>
        <p class="text-center text-gray-600">Nikmati layanan sewa alat musik yang praktis, aman, dan terpercaya bersama Insphony.</p>
    </div>

    <!-- Simplified but still luxurious footer -->
    <footer class="bg-earth-600 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-start gap-8">
                <!-- Logo and Description -->
                <div class="md:w-1/3">
                    <div class="flex items-center mb-6">
                         <div class="bg-gradient-to-br from-earth-100 to-white rounded-lg p-2 shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                            <img src="/logo-insphony.png" class="h-12 w-auto" alt="Insphony Logo" />
                        </div>
                        <div class="ml-4">
                            <h2 class="text-2xl font-bold text-earth-100">Insphony</h2>
                        </div>
                    </div>
                    <p class="text-earth-200 text-base max-w-sm leading-relaxed">
                        Solusi penyewaan alat musik modern untuk berbagai kebutuhan Anda
                    </p>
                </div>
                
                <!-- Links and Social -->
                <div class="md:w-2/3 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Quick Links -->
                    <div>
                        <h3 class="text-lg font-semibold uppercase mb-4 text-earth-100 border-b border-earth-500 pb-2">Tautan Cepat</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-earth-200 hover:text-white transition-colors">Beranda</a></li>
                            <li><a href="#produk" class="text-earth-200 hover:text-white transition-colors">Produk</a></li>
                            <li><a href="#syarat" class="text-earth-200 hover:text-white transition-colors">Syarat</a></li>
                            <li><a href="#kontak" class="text-earth-200 hover:text-white transition-colors">Kontak</a></li>
                        </ul>
                    </div>
                    
                    <!-- Help -->
                    <div>
                        <h3 class="text-lg font-semibold uppercase mb-4 text-earth-100 border-b border-earth-500 pb-2">Bantuan</h3>
                        <ul class="space-y-2">
                            <li><button onclick="openModal('faqModal')" class="text-earth-200 hover:text-white transition-colors cursor-pointer text-left w-full">FAQ</button></li>
                            <li><button onclick="openModal('termsModal')" class="text-earth-200 hover:text-white transition-colors cursor-pointer text-left w-full">Syarat & Ketentuan</button></li>
                            <li><button onclick="openModal('privacyModal')" class="text-earth-200 hover:text-white transition-colors cursor-pointer text-left w-full">Kebijakan Privasi</button></li>
                            <li><button onclick="openModal('paymentModal')" class="text-earth-200 hover:text-white transition-colors cursor-pointer text-left w-full">Cara Pembayaran</button></li>
                        </ul>
                    </div>
                    
                    <!-- Social Media -->
                   <div>
    <h3 class="text-lg font-semibold uppercase mb-4 text-earth-100 border-b border-earth-500 pb-2">Ikuti Kami</h3>
    <div class="flex flex-wrap gap-3">
        <!-- Facebook -->
        <a href="#" class="w-10 h-10 flex items-center justify-center bg-white/10 rounded-full transition-all hover:bg-[#1877F2] group">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
            </svg>
        </a>
        
        <!-- Instagram -->
        <a href="#" class="w-10 h-10 flex items-center justify-center bg-white/10 rounded-full transition-all hover:bg-gradient-to-br hover:from-[#405de6] hover:via-[#5851db] hover:to-[#833ab4] group">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
            </svg>
        </a>
        
        <!-- TikTok -->
        <a href="https://www.tiktok.com/@masadekaa" class="w-10 h-10 flex items-center justify-center bg-white/10 rounded-full transition-all hover:bg-black group">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
            </svg>
        </a>
        
        <!-- YouTube -->
        <a href="#" class="w-10 h-10 flex items-center justify-center bg-white/10 rounded-full transition-all hover:bg-[#FF0000] group">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
            </svg>
        </a>
    </div>
</div>
                </div>
            </div>
            
            <!-- Copyright -->
            <div class="border-t border-earth-600 mt-10 pt-8 text-center">
                <p class="text-earth-300">© <span id="currentYear"></span> Insphony. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>

    <!-- Include Modals -->
@include('components.modals.faq')
@include('components.modals.terms')
@include('components.modals.privacy')
@include('components.modals.payment')

    <script>
    // Fungsi modal
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Tutup modal saat klik di luar
    window.addEventListener('click', (e) => {
        if (e.target.classList.contains('fixed')) {
            document.querySelectorAll('.fixed').forEach(modal => {
                if (!modal.classList.contains('hidden')) {
                    closeModal(modal.id);
                }
            });
        }
    });
    document.getElementById('currentYear').textContent = new Date().getFullYear();
    </script>
</body>
</html>