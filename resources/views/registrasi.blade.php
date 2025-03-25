<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Mahasigma</title>
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

        .form-container {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        backdrop-filter: blur(5px);
    }

        .registrasi-box {
        background: rgba(255, 255, 255, 0.8);
        padding: 60px;
        border-radius: 10px;
        text-align: center;
        width: 450px;
    }

        .registrasi-box h2 {
        margin-bottom: 25px;
        font-size: 26px;   
    }

        .form-control {
        width: 100%;
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 18px;
    }

        .form-control:focus {
        border-color: #4caf50;
        outline: none;
    }

        .password-wrapper {
        position: relative;
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

        .form-checkbox {
        display: flex;
        align-items: center;
        margin-bottom: 30px;
        font-size: 16px;
    }

        .form-checkbox input {
        margin-right: 10px;
    }

        .submit-button {
        background-color: #4caf50;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 15px;
        width: 100%;
        cursor: pointer;
        font-size: 18px;
    }
    
        .submit-button:hover {
        background-color: #45a049;
    }
    </style>
</head>
<body>

<div class="form-container">
    <div class="registrasi-box">
    <img src="{{ asset('images/mahasigma-reservation-high-resolution-logo.png') }}" class="logo" alt="Logo">
        <h2>Daftar</h2>
        <form action="register.php" method="post">
            <input type="text" class="form-control" placeholder="Nama Pengguna" name="username" required>
            <input type="text" class="form-control" placeholder="Nomor Handphone" name="no_handphone" required>
            <div class="password-wrapper">
                <input type="password" class="form-control" placeholder="Kata Sandi" id="password" name="password" required>
                <span class="toggle-password" id="togglePassword"><i class="fas fa-eye"></i></span>
            </div>
            <div class="password-wrapper">
                <input type="password" class="form-control" placeholder="Konfirmasi Kata Sandi" id="confirmPassword" name="confirm_password" required>
                <span class="toggle-password" id="toggleConfirmPassword"><i class="fas fa-eye"></i></span>
            </div>
            <div class="form-checkbox">
                <input type="checkbox" id="validData" required />
                <label for="validData">Isi data dengan valid</label>
            </div>
            <button type="submit" class="submit-button" name="register">Daftar</button>
        </form>
    </div>
</div>
</body>
</html>
