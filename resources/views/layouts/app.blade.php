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

    <!-- Flowbite JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    @stack('scripts')
</body>
</html>