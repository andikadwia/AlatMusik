<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mahasigma</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
      * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    body {
      background: url('{{ asset('images/background.jpg') }}');
      background-size: cover;
      background-position: center;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    .logo {
      position: absolute;
      bottom: 10px;
      left: 10px;
      width: 250px;
      height: auto;
    }

    .login-container {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 100%;
      height: 100%;
      backdrop-filter: blur(5px);
    }

    .login-box {
      background: rgba(255, 255, 255, 0.8);
      padding: 60px;
      border-radius: 10px;
      text-align: center;
      width: 450px;
    }

    .login-box h2 {
      margin-bottom: 25px;
      font-size: 26px;
    }

    .login-box input[type="text"],
    .login-box input[type="password"] {
      width: 100%;
      padding: 15px;
      margin: 30px 0 35px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
    }

    .login-box button {
      width: 100%;
      padding: 15px;
      background-color: #4caf50;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 20px;
    }

    .login-box button:hover {
      background-color: #45a049;
    }

    .btn-primary i {
      margin-right: 8px;
    }

    .login-box p {
      margin-top: 20px;
      font-size: 16px;
    }

    .login-box p a {
      color: #0000ee;
      text-decoration: none;
      font-size: 16px;
    }

    .forgot-password {
      display: block;
      margin-top: 15px;
      color: #0000ee;
      text-decoration: none;
      font-size: 16px;
      text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.6);
    }
    .signup-link {
      color: #0000ee;
      text-decoration: none;
      font-size: 16px;
      text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.6); /* Thicker and darker shadow */
    }

    .password-wrapper {
      position: relative;
    }

    .password-wrapper input {
      padding-right: 50px;
    }

    .toggle-password {
      position: absolute;
      top: 50%;
      right: 15px;
      transform: translateY(-50%);
      cursor: pointer;
      color: #888;
    }

    .toggle-password:hover {
      color: #333;
    }
    </style>
  </head>
  <body>
    <div class="login-container">
      <div class="login-box">
      <img src="{{ asset('images/mahasigma-reservation-high-resolution-logo.png') }}" class="logo" alt="Logo">
        <h2>Login</h2>
        <form action="login.php" method="post">
      
      <input
            type="text"
            class="form-control"
            id="username"
            placeholder="Masukkan nama pengguna"
            name="username"
            required
          />
          <div class="password-wrapper">
            <input
              type="password"
              class="form-control"
              id="password"
              placeholder="Masukkan kata sandi"
              name="password"
              required
            />
            <span class="toggle-password">
              <i class="fas fa-eye" id="togglePassword"></i>
            </span>
          </div>
          <button name="login" type="submit" class="btn btn-primary w-100">
            <i class="fas fa-sign-in-alt"></i> Masuk
          </button>
          <a href="lupa_sandi.php" class="forgot-password">Lupa kata sandi?</a>
          <p>
            Belum punya akun?
            <a href="{{ route('register') }}">Daftar</a>
          </p>
        </form>
      </div>
    </div>
</body>
</html>
