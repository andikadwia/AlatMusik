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
  </style>
</head>
<body class="min-h-screen">
  <!-- Fullscreen Background -->
  <div class="fixed inset-0 -z-10">
    <div 
        class="absolute inset-0 bg-[url('gitar.jpg')] bg-contain bg-center bg-no-repeat"
        style="background-size: 100% 100%;"
    ></div>
    <div class="absolute inset-0 bg-black bg-opacity-30"></div>
</div>

  <!-- LupaPW Content -->
  <main class="flex min-h-screen items-center justify-center p-4">
    <section class="w-full max-w-md bg-white bg-opacity-90 rounded-xl border border-amber-700 shadow-lg p-6" aria-labelledby="kodeotp-heading">
      <!-- Logo in top-left corner -->
      <div class="flex items-start mb-3">
        <img src="logo_insphony.png" alt="InsPhony Logo" class="h-12">
      </div>
    
      
   <!-- Forget password Form -->
<form id="kodeotp-form" class="space-y-4">
  <!-- OTP code Field -->
  <div>
     <label for="kodeotp" class="block text-base font-normal mb-1 text-gray-800">Masukkan kode OTP</label>
     <div class="relative">
       <input
       type="number"
       id="kodeotp"
       name="kodeotp"
       maxlength="6"
       oninput="this.value = this.value.slice(0, 6)"
       class="w-full pl-10 pr-3 py-2 text-base font-light border border-amber-700 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 [appearance:textfield] [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none"
       placeholder="Masukkan kode"
       required/>            
       <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
        
         <!-- <Alternatif: Ikon shield (perlindungan) -->
         <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
         </svg>   
       </div>
     </div>
   </div>
</form>
            <!-- Forgot Password Link -->
        <div class="text-center pt-2">
          <a class="text-sm font-light text-gray-700">
            Kode OTP terdiri dari 6 digit
          </a>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full py-2 px-4 bg-amber-100 hover:bg-amber-700 text-amber-900 hover:text-white text-base font-medium rounded-md border border-amber-700 transition duration-300 focus:ring-2 focus:ring-blue-500 focus:outline-none mt-4">
          Kirim
        </button>
           

  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
  <script>
    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
      const passwordInput = document.getElementById('password');
      const eyeIcon = document.getElementById('eyeIcon');
      
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.innerHTML = `
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
        `;
      } else {
        passwordInput.type = 'password';
        eyeIcon.innerHTML = `
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
        `;
      }
    });
  </script>
</body>
</html>