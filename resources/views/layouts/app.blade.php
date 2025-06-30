<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Insphony - Sewa Alat Musik Modern')</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:400,700" rel="stylesheet" />
    <!-- Flowbite CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <style>
        /* Scrollbar styling */
        html {
            scrollbar-width: thin;
            scrollbar-color: #a08963 #f5f5f5;
        }
        
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f5f5f5;
        }
        
        ::-webkit-scrollbar-thumb {
            background-color: #a08963;
            border-radius: 4px;
        }
        body {
        overflow-x: hidden;
    }
        

        /* Header fixed positioning adjustment */
        main {
            padding-top: 80px; /* Sesuaikan dengan tinggi header */
        }

        /* Notification animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes fadeOut {
            from { opacity: 1; transform: translateY(0); }
            to { opacity: 0; transform: translateY(-20px); }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.3s ease-in-out forwards;
        }
        
        .animate-fade-out {
            animation: fadeOut 0.3s ease-in-out forwards;
        }

        /* Ensure header consistency */
        .main-header {
            height: 80px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
    AOS.init();
    </script>
    <script>
        tailwind.config = {
            important: true, /* Ensure Tailwind overrides other styles */
            theme: {
                extend: {
                    colors: {
                        primary: "#a08963",
                        'primary-dark': "#8a7552",
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
                    spacing: {
                        'header': '80px', /* Consistent header height */
                    }
                },
            },
            corePlugins: {
                preflight: false, /* Disable default Tailwind reset */
            }
        };
    </script>
    @stack('styles')
</head>
<body class="bg-neutral font-sans text-base-content leading-relaxed">
    <!-- Header Section -->
    @include('components.header')

    <!-- Main Content -->
    <main class="pt-[80px] min-h-[calc(100vh-160px)]">
        @yield('content')
    </main>

    <!-- Footer Section -->
    @include('components.footer')

    <!-- Notification System -->
    @if(session('success'))
    <div class="fixed top-4 right-4 z-[60]">
        <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center animate-fade-in">
            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            {{ session('success') }}
            <button onclick="dismissNotification(this)" class="ml-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="fixed top-4 right-4 z-[60]">
        <div class="bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center animate-fade-in">
            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
            {{ session('error') }}
            <button onclick="dismissNotification(this)" class="ml-4">
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
                    dismissNotification(notification.querySelector('button'));
                }, 5000);
            });
            
            // Make header sticky and consistent
            const header = document.querySelector('header');
            if(header) {
                header.classList.add('fixed', 'top-0', 'left-0', 'w-full', 'z-50');
            }
        });

        function dismissNotification(button) {
            const notification = button.closest('[class*="fixed top-4 right-4"]');
            if(notification) {
                notification.querySelector('div').classList.add('animate-fade-out');
                setTimeout(() => notification.remove(), 300);
            }
        }

        // Ensure header doesn't affect layout on resize
        function adjustMainPadding() {
            const header = document.querySelector('header');
            const main = document.querySelector('main');
            if(header && main) {
                const headerHeight = header.offsetHeight;
                main.style.paddingTop = `${headerHeight}px`;
            }
        }

        window.addEventListener('resize', adjustMainPadding);
        adjustMainPadding();
    </script>

    <!-- Flowbite JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    @stack('scripts')
</body>
</html>