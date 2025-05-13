<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - InsPhony</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>
<body class="min-h-screen">
  <!-- Fullscreen Background -->
  <div class="fixed inset-0 -z-10">
    <div 
        class="absolute inset-0 bg-[url('/images/gitar.jpg')] bg-contain bg-center bg-no-repeat"
        style="background-size: 100% 100%;"
    ></div>
    <div class="absolute inset-0 bg-black bg-opacity-30"></div>
</div>

  <!-- Register Content -->
  <main class="flex min-h-screen items-center justify-center p-4">
    <section class="w-full max-w-md bg-white bg-opacity-90 rounded-xl border border-amber-700 shadow-lg p-6" aria-labelledby="register-heading">
      <!-- Logo in top-left corner -->
      <div class="flex items-start mb-2">
        <img src="https://c.animaapp.com/knqlfAnT/img/tak-berjudul1-20250312112214-1@2x.png" alt="InsPhony Logo" class="h-12">
      </div>
      
      <!-- Welcome Text -->
      <h1 id="login-heading" class="text-xl text-center font-medium mb-6">
        <span class="font-normal">Daftar</span>
      </h1>
      
      <!-- Registration Form -->
<form id="registration-form" method="POST" action="{{ route('register') }}" class="space-y-4">
    @csrf
    @if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <!-- Email Field -->
    <div>
        <label for="email" class="block text-base font-normal mb-1 text-gray-800">Email</label>
        <div class="relative">
            <input
                type="email"
                id="email"
                name="email"
                class="w-full pl-10 pr-3 py-2 text-base font-light border border-amber-700 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror"
                placeholder="Masukkan email"
                value="{{ old('email') }}"
                required
            />
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
            </div>
        </div>
    </div>


        <!-- Phone Number Field -->
        <div>
          <label for="telepon" class="block text-base font-normal mb-1 text-gray-800">Nomor Handphone</label>
          <div class="relative">
            <input
              type="tel"
              id="telepon"
              name="telepon"
              class="w-full pl-10 pr-3 py-2 text-base font-light border border-amber-700 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              placeholder="Masukkan nomor handphone"
              required
            />
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
              <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
              </svg>
            </div>
          </div>
        </div>
        
        <!-- Username Field -->
        <div>
          <label for="username" class="block text-base font-normal mb-1 text-gray-800">Username</label>
          <div class="relative">
            <input
              type="text"
              id="username"
              name="username"
              class="w-full pl-10 pr-3 py-2 text-base font-light border border-amber-700 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              placeholder="Masukkan username"
              required
            />
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
              <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
              </svg>
            </div>
          </div>
        </div>

        <!-- Password Field -->
        <div>
        <label for="password" class="block text-base font-normal mb-1 text-gray-800">Password</label>
        <div class="relative">
            <input
                type="password"
                id="password"
                name="password"
                class="w-full pl-10 pr-10 py-2 text-base font-light border border-amber-700 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-500 @enderror"
                placeholder="Masukkan Password"
                required
            />
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
            <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700">
                <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
            </button>
        </div>
    </div>


        <!-- Address Field -->
        <div>
          <label for="alamat" class="block text-base font-normal mb-1 text-gray-800">Alamat</label>
          <div class="relative">
            <textarea
              id="alamat"
              name="alamat"
              rows="3"
              class="w-full pl-10 pr-3 py-2 text-base font-light border border-amber-700 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              placeholder="Masukkan alamat anda"
              required
            ></textarea>
            <div class="absolute top-3 left-0 flex items-center pl-3 pointer-events-none">
              <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
              </svg>
            </div>
          </div>
        </div>
        
        <!-- Register Button -->
        <button type="submit" class="w-full py-2 px-4 bg-amber-100 hover:bg-amber-700 text-amber-900 hover:text-white text-base font-medium rounded-md border border-amber-700 transition duration-300 focus:ring-2 focus:ring-blue-500 focus:outline-none mt-4">
          Daftar
        </button>
        
        <!-- Login Link -->
        <div class="flex flex-col md:flex-row items-center justify-center gap-1 mt-6 text-sm">
          <span class="text-gray-700">Sudah punya akun?</span>
          <a href="{{ route('login') }}" class="font-medium text-amber-700 hover:text-amber-800 hover:underline transition duration-300">
            Login disini!
          </a>
        </div>
      </form>
    </section>
  </main>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
  <script>
    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
    const passwordInput = document.getElementById('password');
    const icon = this.querySelector('svg');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
        `;
    } else {
        passwordInput.type = 'password';
        icon.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
        `;
    }
});
  </script>
</body>
</html>