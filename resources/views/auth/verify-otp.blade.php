<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KodeOTP - InsPhony</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
  </style>
</head>
<body class="min-h-screen">
  <!-- Fullscreen Background -->
  <div class="fixed inset-0 -z-10">
    <div class="absolute inset-0" style="background: url('{{ asset('gitar.jpg') }}') center/cover no-repeat"></div>
    <div class="absolute inset-0 bg-black bg-opacity-30"></div>
  </div>

  <!-- OTP Verification Content -->
  <main class="flex min-h-screen items-center justify-center p-4">
    <section class="w-full max-w-md bg-white bg-opacity-90 rounded-xl border border-amber-700 shadow-lg p-6" aria-labelledby="kodeotp-heading">
      <!-- Logo -->
      <div class="flex items-start mb-3">
        <img src="{{ asset('logo_insphony.png') }}" alt="InsPhony Logo" class="h-12">
      </div>
      
      <h1 id="kodeotp-heading" class="text-xl text-center font-medium mb-6">
        Verifikasi OTP
      </h1>
      
      @if(session('status'))
        <div class="mb-4 text-green-600 text-center">
          {{ session('status') }}
        </div>
      @endif

      @if($errors->any())
        <div class="mb-4 text-red-600 text-center">
          {{ $errors->first() }}
        </div>
      @endif

      <div class="text-center mb-4">
        <p class="text-gray-700">Kami telah mengirim kode OTP ke</p>
        <p class="font-medium">{{ $phone ?? session('phone') }}</p>
      </div>

      <!-- OTP Form -->
      <form id="kodeotp-form" method="POST" action="{{ route('password.verify.submit', ['phone' => $phone ?? session('phone')]) }}" class="space-y-4">
        @csrf
        
        <!-- OTP Input -->
        <div>
          <label for="kodeotp" class="block text-base font-normal mb-1 text-gray-800">Masukkan Kode OTP</label>
          <div class="relative">
            <input
              type="number"
              id="kodeotp"
              name="otp"
              inputmode="numeric"
              pattern="[0-9]*"
              maxlength="6"
              class="w-full px-3 py-2 text-base font-light border border-amber-700 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-center tracking-widest"
              placeholder="------"
              required
              autofocus
              oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 6); if(this.value.length === 6) this.form.submit();"
            />
          </div>
        </div>
        
        <button type="submit" class="w-full py-2 px-4 bg-amber-100 hover:bg-amber-700 text-amber-900 hover:text-white text-base font-medium rounded-md border border-amber-700 transition duration-300 focus:ring-2 focus:ring-blue-500 focus:outline-none mt-4">
          Verifikasi
        </button>
        
        <div class="text-center pt-2">
          <button type="button" id="resend-otp" class="text-sm font-light text-gray-700 hover:text-amber-700 disabled:opacity-50" disabled>
            Kirim ulang OTP (<span id="countdown">60</span> detik)
          </button>
        </div>
      </form>
    </section>
  </main>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        const resendButton = document.getElementById('resend-otp');
        const countdownElement = document.getElementById('countdown');
        let timeLeft = 60;

        // Start countdown timer
        const countdown = setInterval(() => {
            timeLeft--;
            countdownElement.textContent = timeLeft;
            
            if (timeLeft <= 0) {
                clearInterval(countdown);
                resendButton.disabled = false;
                resendButton.innerHTML = 'Kirim ulang OTP';
            }
        }, 1000);

        // Resend OTP handler
        resendButton.addEventListener('click', function() {
            this.disabled = true;
            timeLeft = 60;
            countdownElement.textContent = timeLeft;
            
            fetch("{{ route('otp.resend') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    alert(data.message);
                }
                
                // Restart countdown
                const newCountdown = setInterval(() => {
                    timeLeft--;
                    countdownElement.textContent = timeLeft;
                    
                    if (timeLeft <= 0) {
                        clearInterval(newCountdown);
                        resendButton.disabled = false;
                        resendButton.innerHTML = 'Kirim ulang OTP';
                    }
                }, 1000);
            })
            .catch(error => {
                console.error('Error:', error);
                resendButton.disabled = false;
            });
        });
    });
  </script>
</body>
</html>