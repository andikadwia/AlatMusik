<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - InsPhony</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
      animation: fadeIn 0.6s ease-out forwards;
    }
    .bg-gradient-overlay {
      background: linear-gradient(135deg, rgba(160, 137, 99, 0.3) 0%, rgba(0, 0, 0, 0.7) 100%);
    }
    .text-primary {
      color: #a08963;
    }
    .bg-primary {
      background-color: #a08963;
    }
    .border-primary {
      border-color: #a08963;
    }
    .hover\:bg-primary:hover {
      background-color: #8a7652;
    }
  </style>
</head>
<body class="min-h-screen bg-gray-100">
  <!-- Fullscreen Background with Parallax Effect -->
  <div class="fixed inset-0 -z-10 overflow-hidden">
    <div class="absolute inset-0 bg-[url('images/gitar.jpg')] bg-cover bg-center bg-no-repeat transform scale-105 md:scale-100 transition-transform duration-1000 ease-out" id="parallax-bg"></div>
    <div class="absolute inset-0 bg-gradient-overlay"></div>
  </div>

  <!-- Login Content -->
  <main class="flex min-h-screen items-center justify-center p-4">
    <section class="w-full max-w-md bg-white/95 backdrop-blur-sm rounded-xl border border-primary/30 shadow-2xl p-8 animate-fade-in" aria-labelledby="login-heading" style="opacity: 0;">
      <!-- Logo with Animation -->
      <div class="flex items-start mb-4 transform hover:scale-105 transition-transform duration-300">
        <img src="https://c.animaapp.com/knqlfAnT/img/tak-berjudul1-20250312112214-1@2x.png" alt="InsPhony Logo" class="h-14 drop-shadow-md">
      </div>

      <!-- Welcome Text - Perbaikan di sini -->
      <h1 id="login-heading" class="text-2xl text-center font-bold mb-8">
        <span class="font-normal text-gray-700">Selamat datang di</span> 
        <span class="font-bold text-primary">InsPhony</span>
      </h1>

      <!-- Login Form -->
      <form id="login-form" method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Username Field with Floating Label -->
        <div class="relative z-0">
          <input
            type="text"
            id="username"
            name="username"
            class="block w-full px-4 py-3 text-sm text-gray-900 bg-transparent rounded-lg border border-primary/50 appearance-none focus:outline-none focus:ring-2 focus:ring-primary/70 focus:border-primary peer"
            placeholder=" "
            required
          />
          <label for="username" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-primary peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-3">Username</label>
          <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-primary">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
          </div>
        </div>

        <!-- Password Field with Floating Label -->
        <div class="relative z-0">
          <input
            type="password"
            id="password"
            name="password"
            class="block w-full px-4 py-3 text-sm text-gray-900 bg-transparent rounded-lg border border-primary/50 appearance-none focus:outline-none focus:ring-2 focus:ring-primary/70 focus:border-primary peer @error('password') border-red-500 @enderror"
            placeholder=" "
            required
          />
          <label for="password" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-primary peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-3">Password</label>
          <div class="absolute inset-y-0 right-0 flex items-center pr-3">
            <button type="button" id="togglePassword" class="text-primary hover:text-amber-700 transition-colors duration-200">
              <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
              </svg>
            </button>
          </div>
          @error('password')
            <p class="mt-1 text-sm text-red-600 animate-pulse">{{ $message }}</p>
          @enderror
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <input id="remember" name="remember" type="checkbox" class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary">
            <label for="remember" class="ml-2 text-sm font-medium text-gray-700 hover:text-gray-900 cursor-pointer transition-colors duration-200">Ingat saya</label>
          </div>
          <a href="{{ route('password.request') }}" class="text-sm font-medium text-primary hover:text-amber-800 hover:underline transition-all duration-300">
            Lupa Kata Sandi?
          </a>
        </div>

        <!-- Login Button with Hover Effect -->
        <button type="submit" class="w-full py-3 px-4 bg-primary hover:bg-amber-700 text-white font-medium rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5 focus:ring-4 focus:ring-primary/50 focus:outline-none">
          <span class="flex items-center justify-center">
            <span>Login</span>
            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
            </svg>
          </span>
        </button>

        <!-- Register Section -->
        <div class="text-center mt-6">
          <p class="text-sm text-gray-600 inline">Belum punya akun?</p>
          <a href="{{ route('register') }}" class="ml-1 text-sm font-semibold text-primary hover:text-amber-800 hover:underline transition-all duration-300 group">
            Daftar sekarang!
            <span class="inline-block transform group-hover:translate-x-1 transition-transform duration-200">→</span>
          </a>
        </div>
      </form>
    </section>
  </main>

  <!-- Footer -->
  <footer class="fixed bottom-0 w-full py-3 bg-black/30 backdrop-blur-sm">
    <div class="container mx-auto px-4 text-center text-white text-sm">
      <p>© 2023 InsPhony. All rights reserved.</p>
    </div>
  </footer>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

  <script>
    // Toggle password visibility with animation
    document.getElementById('togglePassword').addEventListener('click', function() {
      const passwordInput = document.getElementById('password');
      const icon = this.querySelector('svg');
      
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.innerHTML = `
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
        `;
        this.classList.add('text-amber-700');
      } else {
        passwordInput.type = 'password';
        icon.innerHTML = `
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
        `;
        this.classList.remove('text-amber-700');
      }
      
      // Add animation
      icon.classList.add('animate-pulse');
      setTimeout(() => {
        icon.classList.remove('animate-pulse');
      }, 300);
    });

    // Parallax effect for background
    document.addEventListener('mousemove', (e) => {
      const x = e.clientX / window.innerWidth;
      const y = e.clientY / window.innerHeight;
      const bg = document.getElementById('parallax-bg');
      bg.style.transform = `scale(1.05) translate(${x * 10}px, ${y * 10}px)`;
    });

    // Trigger fade-in animation after page load
    window.addEventListener('load', () => {
      const loginSection = document.querySelector('section');
      loginSection.style.opacity = '1';
    });
  </script>
</body>
</html>