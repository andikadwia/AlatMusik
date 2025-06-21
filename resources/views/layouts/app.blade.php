<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Insphony - Sewa Alat Musik Modern')</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,600,500,400,700|Roboto:700,400" rel="stylesheet" />
    <!-- Flowbite CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <style>
        /* Untuk semua browser modern */
        html {
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* IE/Edge */
        }
        
        /* Untuk Webkit (Chrome, Safari) */
        html::-webkit-scrollbar {
            display: none;
        }
        
        body {
            overflow-y: scroll; /* Pastikan scroll selalu ada (untuk layout stabil) */
            -webkit-overflow-scrolling: touch; /* Smooth scrolling di iOS */
        }

        /* Notification animations */
        .animate-fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }
        .animate-fade-out {
            animation: fadeOut 0.3s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeOut {
            from { opacity: 1; transform: translateY(0); }
            to { opacity: 0; transform: translateY(-20px); }
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#a08963",
                        secondary: "#d9d9d9",
                        accent: "#fffcf9",
                        neutral: "#f5f5f5",
                        "base-100": "#ffffff",
                        "base-content": "#000000",
                        error: "#e03939",
                    },
                    fontFamily: {
                        sans: ["Poppins", "sans-serif"],
                        roboto: ["Roboto", "sans-serif"],
                    },
                },
            },
        };
    </script>
    @stack('styles')
</head>
<body class="bg-neutral font-sans text-base-content leading-relaxed">
    @include('components.header')

    <main class="pt-24">
        @yield('content')
    </main>

    @include('components.footer')

    <!-- Notification System -->
    @if(session('success'))
    <div class="fixed top-4 right-4 z-50">
        <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center animate-fade-in">
            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            {{ session('success') }}
            <button onclick="this.parentElement.classList.add('animate-fade-out'); setTimeout(() => this.parentElement.remove(), 300)" class="ml-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="fixed top-4 right-4 z-50">
        <div class="bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center animate-fade-in">
            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
            {{ session('error') }}
            <button onclick="this.parentElement.classList.add('animate-fade-out'); setTimeout(() => this.parentElement.remove(), 300)" class="ml-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>
    @endif

    <script>
        // Auto-hide notifications after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const notifications = document.querySelectorAll('[class*="fixed top-4 right-4"]');
            notifications.forEach(notification => {
                setTimeout(() => {
                    notification.querySelector('div').classList.add('animate-fade-out');
                    setTimeout(() => notification.remove(), 300);
                }, 5000);
            });
        });
    </script>

    <!-- Flowbite JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    @stack('scripts')
</body>
</html>