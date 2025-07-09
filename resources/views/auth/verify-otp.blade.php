<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verifikasi OTP - InsPhony</title>
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
  <!-- Alert Container -->
  <div id="alert-container" class="fixed top-4 right-4 w-full max-w-sm space-y-3 z-50">
    @if(session('status'))
      <div class="alert-success p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg animate-fade-in flex items-center" role="alert">
        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
        </svg>
        <span>{{ session('status') }}</span>
        <button onclick="this.parentElement.remove()" class="ml-auto -mx-1.5 -my-1.5 bg-green-100 text-green-500 rounded-lg p-1.5 hover:bg-green-200 inline-flex h-8 w-8">
          <span class="sr-only">Close</span>
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
          </svg>
        </button>
      </div>
    @endif

    @if(session('error'))
      <div class="alert-error p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg animate-fade-in flex items-center" role="alert">
        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
        </svg>
        <span>{{ session('error') }}</span>
        <button onclick="this.parentElement.remove()" class="ml-auto -mx-1.5 -my-1.5 bg-red-100 text-red-500 rounded-lg p-1.5 hover:bg-red-200 inline-flex h-8 w-8">
          <span class="sr-only">Close</span>
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
          </svg>
        </button>
      </div>
    @endif
  </div>

  <!-- Fullscreen Background with Parallax Effect -->
  <div class="fixed inset-0 -z-10 overflow-hidden">
    <div class="absolute inset-0 bg-[url('images/gitar.jpg')] bg-cover bg-center bg-no-repeat transform scale-105 md:scale-100 transition-transform duration-1000 ease-out" id="parallax-bg"></div>
    <div class="absolute inset-0 bg-gradient-overlay"></div>
  </div>

  <!-- OTP Content -->
  <main class="flex min-h-screen items-center justify-center p-4">
    <section class="w-full max-w-md bg-white/95 backdrop-blur-sm rounded-xl border border-primary/30 shadow-2xl p-8 animate-fade-in" aria-labelledby="otp-heading" style="opacity: 0;">
      <!-- Logo with Animation -->
      <div class="flex items-start mb-4 transform hover:scale-105 transition-transform duration-300">
        <img src="https://c.animaapp.com/knqlfAnT/img/tak-berjudul1-20250312112214-1@2x.png" alt="InsPhony Logo" class="h-14 drop-shadow-md">
      </div>

      <!-- Heading -->
      <h1 id="otp-heading" class="text-2xl text-center font-bold mb-6">
        <span class="font-bold text-primary">Verifikasi OTP</span>
      </h1>

      @if (session('status'))
        <div class="mb-6 px-4 py-3 text-green-700 bg-green-100 rounded-lg flex items-center">
          <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
          </svg>
          {{ session('status') }}
        </div>
      @endif
      
      @if (session('error'))
        <div class="mb-6 px-4 py-3 text-red-700 bg-red-100 rounded-lg flex items-center">
          <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
          </svg>
          {{ session('error') }}
        </div>
      @endif

      <!-- Form -->
      <form id="otp-form" method="POST" action="{{ route('otp.verify.submit') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="telepon" value="{{ $phone }}">
        
        <div class="text-center mb-6">
          <p class="text-gray-700">Kode verifikasi telah dikirim ke</p>
          <p class="font-medium text-primary">{{ $masked_phone }}</p>
        </div>
        
        <!-- OTP Input -->
        <div class="relative z-0">
          <input
            type="text"
            id="kodeotp"
            name="kodeotp"
            class="block w-full px-4 py-3 text-center text-lg text-gray-900 bg-transparent rounded-lg border border-primary/50 appearance-none focus:outline-none focus:ring-[#a08963] focus:border-[#a08963] peer"
            placeholder=" "
            maxlength="6"
            required
            autofocus
            inputmode="numeric"
            pattern="\d{6}"
          />
          <label for="kodeotp" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-primary peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1/2 -translate-x-1/2">Kode OTP (6 digit)</label>
        </div>
        
        <!-- Submit Button -->
        <button type="submit" class="w-full py-3 px-4 bg-primary hover:bg-amber-700 text-white font-medium rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5 focus:ring-4 focus:ring-[#a08963] focus:border-[#a08963] focus:outline-none">
          <span class="flex items-center justify-center">
            <span>Verifikasi</span>
            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
            </svg>
          </span>
        </button>
        
        <!-- Resend OTP -->
        <div class="text-center pt-2 text-sm text-gray-600">
          <p>Tidak menerima kode? 
            <form method="POST" action="{{ route('otp.resend') }}" class="inline">
              @csrf
              <input type="hidden" name="telepon" value="{{ $phone }}">
              <button type="submit" class="text-primary hover:text-amber-800 font-medium hover:underline transition-all duration-300">
                Kirim ulang OTP
              </button>
            </form>
          </p>
          <p class="mt-1">Kode berlaku selama 10 menit</p>
        </div>
      </form>
    </section>
  </main>

  <!-- Footer -->
  <footer class="fixed bottom-0 w-full py-3 bg-black/30 backdrop-blur-sm">
    <div class="container mx-auto px-4 text-center text-white text-sm">
      <p>© <span id="currentYear"></span> Insphony. Hak Cipta Dilindungi.</p>
    </div>
  </footer>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

  <script>
    // Parallax effect for background
    document.addEventListener('mousemove', (e) => {
      const x = e.clientX / window.innerWidth;
      const y = e.clientY / window.innerHeight;
      const bg = document.getElementById('parallax-bg');
      bg.style.transform = `scale(1.05) translate(${x * 10}px, ${y * 10}px)`;
    });

    // Trigger fade-in animation after page load
    window.addEventListener('load', () => {
      const otpSection = document.querySelector('section');
      otpSection.style.opacity = '1';
      
      // Auto focus OTP input
      document.getElementById('kodeotp').focus();
    });

    // Auto move between OTP digits
    document.getElementById('kodeotp').addEventListener('input', function(e) {
      if (this.value.length === 6) {
        document.getElementById('otp-form').submit();
      }
    });

    // Function to show custom alert
    function showAlert(message, type = 'success') {
      const alertContainer = document.getElementById('alert-container');
      const alertId = 'alert-' + Date.now();
      
      const icons = {
        success: `<svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
        </svg>`,
        error: `<svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
        </svg>`
      };
      
      const alertDiv = document.createElement('div');
      alertDiv.id = alertId;
      alertDiv.className = `p-4 mb-4 text-sm text-${type === 'success' ? 'green' : 'red'}-700 bg-${type === 'success' ? 'green' : 'red'}-100 rounded-lg animate-fade-in flex items-center`;
      alertDiv.innerHTML = `
        ${icons[type]}
        <span class="font-medium">${message}</span>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-${type === 'success' ? 'green' : 'red'}-100 text-${type === 'success' ? 'green' : 'red'}-500 rounded-lg focus:ring-2 focus:ring-${type === 'success' ? 'green' : 'red'}-400 p-1.5 hover:bg-${type === 'success' ? 'green' : 'red'}-200 inline-flex h-8 w-8" onclick="document.getElementById('${alertId}').remove()">
          <span class="sr-only">Close</span>
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
          </svg>
        </button>
      `;
      
      alertContainer.prepend(alertDiv);
      
      // Remove alert after 5 seconds
      setTimeout(() => {
        const alert = document.getElementById(alertId);
        if (alert) {
          alert.remove();
        }
      }, 5000);
    }

    // Auto close alerts after 5 seconds
    document.querySelectorAll('.alert-success, .alert-error').forEach(alert => {
      setTimeout(() => {
        alert.remove();
      }, 5000);
    });
    document.getElementById('currentYear').textContent = new Date().getFullYear();
  </script>
</body>
</html>