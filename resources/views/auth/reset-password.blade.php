<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Kata Sandi - InsPhony</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: {
              DEFAULT: '#a08963',
              dark: '#8a7652',
            }
          }
        }
      }
    }
  </script>
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
    .password-strength {
      height: 4px;
      margin-top: 4px;
      transition: all 0.3s ease;
    }
    /* Hide default password toggle */
    input[type="password"]::-webkit-reveal,
    input[type="password"]::-webkit-caps-lock-indicator,
    input[type="password"]::-webkit-credentials-auto-fill-button {
      display: none !important;
    }
    .password-input-container {
      position: relative;
    }
    .toggle-password {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #a08963;
    }
  </style>
</head>
<body class="min-h-screen bg-gray-100">
  <!-- Alert Container -->
  <div id="alert-container" class="fixed top-4 right-4 w-full max-w-sm space-y-3 z-50">
    @if(session('success'))
      <div class="alert-success p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg animate-fade-in flex items-center" role="alert">
        <span>{{ session('success') }}</span>
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
        <span>{{ session('error') }}</span>
        <button onclick="this.parentElement.remove()" class="ml-auto -mx-1.5 -my-1.5 bg-red-100 text-red-500 rounded-lg p-1.5 hover:bg-red-200 inline-flex h-8 w-8">
          <span class="sr-only">Close</span>
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
          </svg>
        </button>
      </div>
    @endif

    @if(session('warning'))
      <div class="alert-warning p-4 mb-4 text-sm text-amber-700 bg-amber-100 rounded-lg animate-fade-in flex items-center" role="alert">
        <span>{{ session('warning') }}</span>
        <button onclick="this.parentElement.remove()" class="ml-auto -mx-1.5 -my-1.5 bg-amber-100 text-amber-500 rounded-lg p-1.5 hover:bg-amber-200 inline-flex h-8 w-8">
          <span class="sr-only">Close</span>
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
          </svg>
        </button>
      </div>
    @endif

    @if($errors->any())
      <div class="alert-error p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg animate-fade-in flex items-center" role="alert">
        <div>
          @foreach ($errors->all() as $error)
            <p class="font-medium">{{ $error }}</p>
          @endforeach
        </div>
        <button onclick="this.parentElement.remove()" class="ml-auto -mx-1.5 -my-1.5 bg-red-100 text-red-500 rounded-lg p-1.5 hover:bg-red-200 inline-flex h-8 w-8">
          <span class="sr-only">Close</span>
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
          </svg>
        </button>
      </div>
    @endif
  </div>

  <!-- Fullscreen Background -->
  <div class="fixed inset-0 -z-10 overflow-hidden">
    <div class="absolute inset-0 bg-[url('images/gitar.jpg')] bg-cover bg-center bg-no-repeat"></div>
    <div class="absolute inset-0 bg-gradient-overlay"></div>
  </div>

  <!-- Reset Password Content -->
  <main class="flex min-h-screen items-center justify-center p-4">
    <section class="w-full max-w-md bg-white/95 backdrop-blur-sm rounded-xl border border-primary/30 shadow-2xl p-8 animate-fade-in" aria-labelledby="resetpassword-heading" style="opacity: 0;">
      <!-- Logo -->
      <div class="flex justify-center mb-6">
        <img src="https://c.animaapp.com/knqlfAnT/img/tak-berjudul1-20250312112214-1@2x.png" alt="InsPhony Logo" class="h-14">
      </div>

      <!-- Heading -->
      <h1 id="resetpassword-heading" class="text-2xl text-center font-bold mb-6">
        <span class="font-normal text-gray-700">Atur Ulang</span> 
        <span class="font-bold text-primary">Kata Sandi</span>
      </h1>

      <!-- Form -->
      <form method="post" action="{{ route('password.update') }}" id="resetpassword-form" class="space-y-6">
        @csrf
        <input type="hidden" name="phone" value="{{ $phone }}">
        
        <!-- New Password Field -->
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi Baru</label>
          <div class="password-input-container">
            <input
              type="password"
              id="password"
              name="password"
              class="block w-full px-4 py-3 text-sm text-gray-900 bg-white rounded-lg border border-primary/50 focus:outline-none focus:ring-[#a08963] focus:border-[#a08963]"
              required
              minlength="8"
              maxlength="20"
              oninput="handlePasswordInput(this)"
              autocomplete="new-password"
            />
            <span class="toggle-password" onclick="togglePasswordVisibility('password')">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
              </svg>
            </span>
          </div>
          <div id="password-strength" class="password-strength w-full rounded-full overflow-hidden bg-gray-200 mt-1">
            <div class="h-full w-0 bg-red-500 transition-all duration-300"></div>
          </div>
          <p id="password-hint" class="mt-1 text-xs text-gray-500 hidden">Kata Sandi harus 8-20 karakter, tanpa spasi atau karakter khusus</p>
        </div>
        
        <!-- Confirm Password Field -->
        <div>
          <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Kata Sandi</label>
          <div class="password-input-container">
            <input
              type="password"
              id="password_confirmation"
              name="password_confirmation"
              class="block w-full px-4 py-3 text-sm text-gray-900 bg-white rounded-lg border border-primary/50 focus:outline-none focus:ring-[#a08963] focus:border-[#a08963]"
              required
              minlength="8"
              maxlength="20"
              oninput="handlePasswordInput(this)"
              autocomplete="new-password"
            />
            <span class="toggle-password" onclick="togglePasswordVisibility('password_confirmation')">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
              </svg>
            </span>
          </div>
          <p id="password-match" class="mt-1 text-xs text-gray-500 hidden">✓ Password cocok</p>
        </div>
        
        <!-- Submit Button -->
        <button type="submit" id="submit-btn" class="w-full py-3 px-4 bg-primary hover:bg-primary-dark text-white font-medium rounded-lg shadow-md hover:shadow-lg transition-all duration-300 focus:ring-4 focus:ring-[#a08963] focus:border-[#a08963] focus:outline-none disabled:opacity-50 disabled:cursor-not-allowed">
          <span class="flex items-center justify-center">
            <span id="btn-text">Atur Ulang Kata Sandi</span>
            <svg id="btn-spinner" class="w-4 h-4 ml-2 hidden animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
          </span>
        </button>

        <!-- Back to Login Link -->
        <div class="text-center mt-6">
          <a href="{{ route('login') }}" class="text-sm font-semibold text-primary hover:text-amber-800 hover:underline transition-all duration-300">
            Kembali ke halaman login
          </a>
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

  <script>
    // Fungsi untuk menangani input password
    function handlePasswordInput(input) {
      // Validasi khusus untuk password
      if (input.id === 'password') {
        validatePasswordStrength(input.value);
        showHint(input.value.length > 0);
      }

      // Validasi konfirmasi password
      if (input.id === 'password_confirmation') {
        validatePasswordMatch();
      }
    }

    // Fungsi untuk toggle visibility password
    function togglePasswordVisibility(fieldId) {
      const passwordField = document.getElementById(fieldId);
      const toggleIcon = passwordField.nextElementSibling.querySelector('svg');
      
      if (passwordField.type === 'password') {
        passwordField.type = 'text';
        toggleIcon.innerHTML = `
          <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
          <line x1="1" y1="1" x2="23" y2="23"></line>
        `;
      } else {
        passwordField.type = 'password';
        toggleIcon.innerHTML = `
          <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
          <circle cx="12" cy="12" r="3"></circle>
        `;
      }
    }

    // Fungsi untuk validasi kekuatan password
    function validatePasswordStrength(password) {
      const strengthBar = document.querySelector('#password-strength > div');
      let strength = 0;
      
      // Hitung kekuatan password
      if (password.length > 0) strength += 20;
      if (password.length >= 8) strength += 30;
      if (/[A-Z]/.test(password)) strength += 15;
      if (/[0-9]/.test(password)) strength += 15;
      if (password.length >= 12) strength += 20;

      // Batasi maksimal 100%
      strength = Math.min(strength, 100);

      // Update tampilan
      strengthBar.style.width = strength + '%';
      
      // Update warna berdasarkan kekuatan
      if (strength < 40) {
        strengthBar.className = 'h-full bg-red-500 transition-all duration-300';
      } else if (strength < 70) {
        strengthBar.className = 'h-full bg-yellow-500 transition-all duration-300';
      } else {
        strengthBar.className = 'h-full bg-green-500 transition-all duration-300';
      }
    }

    // Fungsi untuk validasi kecocokan password
    function validatePasswordMatch() {
      const password = document.getElementById('password').value;
      const confirmPassword = document.getElementById('password_confirmation').value;
      const matchText = document.getElementById('password-match');
      
      if (confirmPassword.length === 0) {
        matchText.classList.add('hidden');
        return;
      }
      
      if (password === confirmPassword) {
        matchText.classList.remove('hidden');
        matchText.classList.remove('text-red-500');
        matchText.classList.add('text-green-500');
        matchText.textContent = '✓ Password cocok';
      } else {
        matchText.classList.remove('hidden');
        matchText.classList.remove('text-green-500');
        matchText.classList.add('text-red-500');
        matchText.textContent = '✗ Password tidak cocok';
      }
    }

    // Tampilkan petunjuk password
    function showHint(show) {
      const hint = document.getElementById('password-hint');
      if (show) {
        hint.classList.remove('hidden');
      } else {
        hint.classList.add('hidden');
      }
    }

    // Trigger fade-in animation after page load
    window.addEventListener('load', () => {
      const loginSection = document.querySelector('section');
      loginSection.style.opacity = '1';
    });

    // Form validation before submit
    document.getElementById('resetpassword-form').addEventListener('submit', function(e) {
      const password = document.getElementById('password').value;
      const confirmPassword = document.getElementById('password_confirmation').value;
      const submitBtn = document.getElementById('submit-btn');
      const btnText = document.getElementById('btn-text');
      const btnSpinner = document.getElementById('btn-spinner');
      
      // Validasi client-side
      if (password !== confirmPassword) {
        e.preventDefault();
        showAlert('Kata Sandi dan konfirmasi Kata Sandi tidak cocok!', 'error');
        return;
      }

      if (password.length < 8) {
        e.preventDefault();
        showAlert('Kata Sandi minimal harus 8 karakter!', 'error');
        return;
      }

      if (/\s/.test(password)) {
        e.preventDefault();
        showAlert('Kata Sandi tidak boleh mengandung spasi!', 'error');
        return;
      }

      // Tampilkan loading state
      submitBtn.disabled = true;
      btnText.textContent = 'Memproses...';
      btnSpinner.classList.remove('hidden');
    });

    // Function to show custom alert
    function showAlert(message, type = 'success') {
      const alertContainer = document.getElementById('alert-container');
      const alertId = 'alert-' + Date.now();
      
      const colors = {
        success: 'green',
        error: 'red',
        warning: 'amber'
      };
      
      const alertDiv = document.createElement('div');
      alertDiv.id = alertId;
      alertDiv.className = `p-4 mb-4 text-sm text-${colors[type]}-700 bg-${colors[type]}-100 rounded-lg animate-fade-in flex items-center`;
      alertDiv.innerHTML = `
        <span class="font-medium">${message}</span>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-${colors[type]}-100 text-${colors[type]}-500 rounded-lg focus:ring-2 focus:ring-${colors[type]}-400 p-1.5 hover:bg-${colors[type]}-200 inline-flex h-8 w-8" onclick="document.getElementById('${alertId}').remove()" aria-label="Tutup notifikasi">
          <span class="sr-only">Close</span>
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
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
    document.querySelectorAll('[class*="alert-"]').forEach(alert => {
      setTimeout(() => {
        alert.remove();
      }, 5000);
    });
    document.getElementById('currentYear').textContent = new Date().getFullYear();
  </script>
</body>
</html>