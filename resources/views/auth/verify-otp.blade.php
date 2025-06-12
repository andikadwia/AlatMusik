<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verifikasi OTP - InsPhony</title>
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
    <div class="absolute inset-0 bg-[url('gitar.jpg')] bg-cover bg-center bg-no-repeat"></div>
    <div class="absolute inset-0 bg-black bg-opacity-30"></div>
  </div>

  <!-- Main Content -->
  <main class="flex min-h-screen items-center justify-center p-4">
    <section class="w-full max-w-md bg-white bg-opacity-90 rounded-xl border border-amber-700 shadow-lg p-6">
      <!-- Logo -->
      <div class="flex items-start mb-3">
        <img src="{{ asset('logo_insphony.png') }}" alt="InsPhony Logo" class="h-12">
      </div>
      
      <!-- Heading -->
      <h1 class="text-xl text-center font-medium mb-6">
        Verifikasi OTP
      </h1>
      
      @if (session('status'))
        <div class="mb-4 px-4 py-3 text-green-700 bg-green-100 rounded-md">
          {{ session('status') }}
        </div>
      @endif
      
      @if (session('error'))
        <div class="mb-4 px-4 py-3 text-red-700 bg-red-100 rounded-md">
          {{ session('error') }}
        </div>
      @endif

      <!-- Form -->
      <form id="lupasandi-form" method="POST" action="{{ route('otp.verify.submit') }}" class="space-y-4">
        @csrf
        <input type="hidden" name="telepon" value="{{ $phone }}">
        
        <div class="text-center mb-4">
          <p class="text-gray-700">Kode verifikasi telah dikirim ke</p>
          <p class="font-medium">{{ $masked_phone }}</p>
        </div>
        
        <!-- OTP Input -->
        <div>
          <label for="kodeotp" class="block text-base font-medium mb-1 text-gray-800">
            Kode OTP (6 digit)
          </label>
          <input
            type="text"
            id="kodeotp"
            name="kodeotp"
            class="w-full px-3 py-3 text-center text-lg border border-amber-700 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500"
            placeholder="------"
            maxlength="6"
            required
            autofocus
            inputmode="numeric"
            pattern="\d{6}"
          />
        </div>
        
        <!-- Submit Button -->
        <button type="submit" class="w-full py-3 px-4 bg-amber-100 hover:bg-amber-700 text-amber-900 hover:text-white text-base font-medium rounded-lg border border-amber-700 transition duration-300 focus:ring-2 focus:ring-amber-500 focus:outline-none mt-6">
          Verifikasi
        </button>
        
        <!-- Resend OTP -->
        <div class="text-center pt-2 text-sm text-gray-600">
          <p>Tidak menerima kode? 
            <form method="POST" action="{{ route('otp.resend') }}" class="inline">
              @csrf
              <input type="hidden" name="telepon" value="{{ $phone }}">
              <button type="submit" class="text-amber-700 hover:text-amber-900 font-medium">
                Kirim ulang OTP
              </button>
            </form>
          </p>
          <p class="mt-1">Kode berlaku selama 10 menit</p>
        </div>
      </form>
    </section>
  </main>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>