<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modal Syarat & Ketentuan</title>
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
                        },
                        'teal': {
                            100: '#ccfbf1',
                            500: '#0d9488',
                            700: '#0f766e'
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-earth-50">

    <!-- Modal Syarat & Ketentuan -->
    <div id="termsModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 transition-opacity" aria-hidden="true" onclick="closeModal('termsModal')">
                <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
            </div>

            <!-- Modal panel -->
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                <div class="bg-white px-6 pt-6 pb-4 sm:p-6 sm:pb-4">
                    <!-- Header -->
                    <div class="flex items-start justify-between border-b border-earth-200 pb-4">
                        <div>
                            <h3 class="text-2xl font-bold text-earth-800">Syarat & Ketentuan</h3>
                            <p class="text-earth-500 font-medium">Persyaratan Penyewaan</p>
                        </div>
                        <button type="button" onclick="closeModal('termsModal')" class="text-earth-400 hover:text-earth-600 bg-transparent rounded-lg text-sm p-1.5 ml-auto inline-flex items-center transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Content -->
                    <div class="mt-6 space-y-4 max-h-[60vh] overflow-y-auto pr-2 text-earth-700">
                        <ol class="list-decimal list-inside space-y-4 ml-2">
                            <!-- Item 1 -->
                            <li class="pl-2">
                                Usia minimal penyewa adalah <strong class="text-earth-800">18 tahun</strong>.
                            </li>
                            
                            <!-- Item 2 -->
                            <li class="pl-2">
                                Penyewa wajib mengisi data lengkap sebagai berikut:
                                <ul class="list-disc list-inside space-y-2 mt-2 ml-6">
                                    <li class="flex items-start">
                                        <span class="flex-shrink-0 bg-earth-100 text-earth-800 rounded-full w-5 h-5 flex items-center justify-center mr-2 mt-0.5">•</span>
                                        <span>Nama lengkap</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="flex-shrink-0 bg-earth-100 text-earth-800 rounded-full w-5 h-5 flex items-center justify-center mr-2 mt-0.5">•</span>
                                        <span>Alamat</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="flex-shrink-0 bg-earth-100 text-earth-800 rounded-full w-5 h-5 flex items-center justify-center mr-2 mt-0.5">•</span>
                                        <span>Nomor HP / WhatsApp</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="flex-shrink-0 bg-earth-100 text-earth-800 rounded-full w-5 h-5 flex items-center justify-center mr-2 mt-0.5">•</span>
                                        <span>Email</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="flex-shrink-0 bg-earth-100 text-earth-800 rounded-full w-5 h-5 flex items-center justify-center mr-2 mt-0.5">•</span>
                                        <span>Tanggal & durasi sewa</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="flex-shrink-0 bg-earth-100 text-earth-800 rounded-full w-5 h-5 flex items-center justify-center mr-2 mt-0.5">•</span>
                                        <span>Jenis alat musik yang disewa</span>
                                    </li>
                                </ul>
                            </li>
                            
                            <!-- Item 3 -->
                            <li class="pl-2">
                                Penyewa wajib menyerahkan <strong class="text-earth-800">jaminan asli</strong> saat pengambilan alat.
                            </li>
                            
                            <!-- Item 4 -->
                            <li class="pl-2">
                                Alat musik harus dikembalikan <strong class="text-earth-800">tepat waktu</strong> dan dalam kondisi <strong class="text-earth-800">normal</strong>.
                            </li>
                            
                            <!-- Item 5 -->
                            <li class="pl-2">
                                Penggunaan <strong class="text-earth-800">dokumen palsu</strong> akan membatalkan pemesanan dan dikenakan sanksi.
                            </li>
                        </ol>
                    </div>
                </div>
                
                <!-- Footer -->
                <div class="bg-earth-50 px-6 py-4 sm:flex sm:flex-row-reverse">
                    <button type="button" onclick="closeModal('termsModal')" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-earth-500 text-base font-medium text-white hover:bg-earth-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                        Setuju
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    </script>
</body>
</html>