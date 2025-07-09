<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modal Kebijakan Privasi</title>
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

    <!-- Modal Kebijakan Privasi -->
    <div id="privacyModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 transition-opacity" aria-hidden="true" onclick="closeModal('privacyModal')">
                <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
            </div>

            <!-- Modal panel -->
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                <div class="bg-white px-6 pt-6 pb-4 sm:p-6 sm:pb-4">
                    <!-- Header -->
                    <div class="flex items-start justify-between border-b border-earth-200 pb-4">
                        <div>
                            <h3 class="text-2xl font-bold text-earth-800">Kebijakan Privasi</h3>
                            <p class="text-earth-500 font-medium">Perlindungan Data Pengguna</p>
                        </div>
                        <button type="button" onclick="closeModal('privacyModal')" class="text-earth-400 hover:text-earth-600 bg-transparent rounded-lg text-sm p-1.5 ml-auto inline-flex items-center transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Content -->
                    <div class="mt-6 space-y-4 max-h-[60vh] overflow-y-auto pr-2 text-earth-700">
                        <p>Kami berkomitmen untuk menjaga privasi dan keamanan data pengguna. Informasi pribadi yang kami kumpulkan meliputi:</p>
                        
                        <ul class="ml-6 space-y-2">
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
                                <span>Email</span>
                            </li>
                            <li class="flex items-start">
                                <span class="flex-shrink-0 bg-earth-100 text-earth-800 rounded-full w-5 h-5 flex items-center justify-center mr-2 mt-0.5">•</span>
                                <span>Nomor HP/WhatsApp</span>
                            </li>
                            <li class="flex items-start">
                                <span class="flex-shrink-0 bg-earth-100 text-earth-800 rounded-full w-5 h-5 flex items-center justify-center mr-2 mt-0.5">•</span>
                                <span>Foto dokumen jaminan (KTP/STNK/BPKB)</span>
                            </li>
                        </ul>

                        <p>Data ini digunakan untuk:</p>
                        
                        <ul class="ml-6 space-y-2">
                            <li class="flex items-start">
                                <span class="flex-shrink-0 bg-earth-100 text-earth-800 rounded-full w-5 h-5 flex items-center justify-center mr-2 mt-0.5">•</span>
                                <span>Proses reservasi dan verifikasi</span>
                            </li>
                            <li class="flex items-start">
                                <span class="flex-shrink-0 bg-earth-100 text-earth-800 rounded-full w-5 h-5 flex items-center justify-center mr-2 mt-0.5">•</span>
                                <span>Komunikasi selama masa sewa</span>
                            </li>
                            <li class="flex items-start">
                                <span class="flex-shrink-0 bg-earth-100 text-earth-800 rounded-full w-5 h-5 flex items-center justify-center mr-2 mt-0.5">•</span>
                                <span>Menjaga keamanan transaksi</span>
                            </li>
                        </ul>

                        <p class="pt-2">Kami tidak akan membagikan data pengguna kepada pihak ketiga tanpa persetujuan tertulis dari penyewa.</p>
                    </div>
                </div>
                
                <!-- Footer -->
                <div class="bg-earth-50 px-6 py-4 sm:flex sm:flex-row-reverse">
                    <button type="button" onclick="closeModal('privacyModal')" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-earth-500 text-base font-medium text-white hover:bg-earth-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                        Mengerti
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