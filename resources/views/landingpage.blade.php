<!DOCTYPE html>
<html>
<head>
    <title>Mahasigma Reservation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-success">
        <div class="container-fluid">
            <img src="{{ asset('images/mahasigma-logo.png') }}" height="70">
            <div>
                <a href="{{ url('/register') }}" class="btn btn-primary">Daftar</a>
                <a href="{{ url('/login') }}" class="btn btn-danger">Login</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center">Lapangan</h2>
        <div class="row">
            @foreach ($lapangan as $data)
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="{{ asset('uploads/' . $data->gambar) }}" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">{{ $data->nama_lapangan }}</h5>
                            <p class="card-text">Harga: Rp. {{ number_format($data->harga, 0, ',', '.') }} /Jam</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <footer class="text-white text-center py-3 bg-success">
        <p>&copy; 2024 MAHASIGMA RESERVATION. All rights reserved.</p>
    </footer>
</body>
</html>
