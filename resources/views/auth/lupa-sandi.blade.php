<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lupa Sandi - InsPhony</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
    input[type="tel"] {
      letter-spacing: 1px;
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
    <section class="w-full max-w-md bg-white bg-opacity-90 rounded-xl border border-amber-700 shadow-lg p-6" aria-labelledby="lupasandi-heading">
      <!-- Logo -->
      <div class="flex items-start mb-3">
        <img src="{{ asset('logo_insphony.png') }}" alt="InsPhony Logo" class="h-12">
      </div>
      
      <!-- Heading -->
      <h1 id="lupasandi-heading" class="text-xl text-center font-medium mb-6">
        Lupa Kata Sandi
      </h1>
      
      @if (session('status'))
        <div class="mb-4 px-4 py-3 text-green-700 bg-green-100 rounded-md">
          {{ session('status') }}
        </div>
      @endif

      <!-- Form -->
      <form id="lupasandi-form" method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf
        
        <!-- Phone Number Input -->
        <div>
          <label for="nomorhandphone" class="block text-base font-medium mb-1 text-gray-800">
            Nomor WhatsApp
            <span class="text-sm font-normal text-gray-500">(contoh: 081234567890)</span>
          </label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
              <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
              </svg>
            </div>
            <input
              type="tel"
              id="nomorhandphone"
              name="nomorhandphone"
              class="w-full pl-10 pr-3 py-3 text-base border border-amber-700 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 @error('nomorhandphone') border-red-500 @enderror"
              placeholder="08xxxxxxxxxx"
              value="{{ old('nomorhandphone') }}"
              pattern="08[0-9]{8,11}"
              maxlength="13"
              required
              oninput="formatPhoneNumber(this)"
            />
          </div>
          @error('nomorhandphone')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>
        
        <!-- Submit Button -->
        <button type="submit" class="w-full py-3 px-4 bg-amber-100 hover:bg-amber-700 text-amber-900 hover:text-white text-base font-medium rounded-lg border border-amber-700 transition duration-300 focus:ring-2 focus:ring-amber-500 focus:outline-none mt-6">
          Kirim Kode OTP
        </button>
        
        <!-- Footer Note -->
        <div class="text-center pt-2 text-sm text-gray-600">
          <p>Kode verifikasi akan dikirim melalui WhatsApp</p>
          <p class="mt-1">Pastikan nomor WhatsApp aktif</p>
        </div>
      </form>
    </section>
  </main>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
  <script>
    // Format phone number input
    function formatPhoneNumber(input) {
      // Remove all non-digit characters
      let value = input.value.replace(/\D/g, '');
      
      // Ensure it starts with 08
      if (!value.startsWith('08') && value.length > 0) {
        value = '08' + value.replace(/^08?/, '');
      }
      
      // Limit to 13 characters (08xxxxxxxxxx)
      if (value.length > 13) {
        value = value.substring(0, 13);
      }
      
      // Update input value
      input.value = value;
    }

    // Initialize form validation
    document.getElementById('lupasandi-form').addEventListener('submit', function(e) {
      const phoneInput = document.getElementById('nomorhandphone');
      const phoneRegex = /^08[0-9]{8,11}$/;
      
      if (!phoneRegex.test(phoneInput.value)) {
        e.preventDefault();
        alert('Format nomor WhatsApp tidak valid. Harus diawali dengan 08 dan panjang 10-13 digit.');
        phoneInput.focus();
      }
    });
  </script>
</body>
</html>