<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RestEasy Hotel</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="styledashboard.css" rel="stylesheet">
    <style>
.hero-section {
    position: relative;
    text-align: center;
    padding: 340px 5px;
    color: white;
}
.hero-section .background-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcRsv3euBUonxzkSviKN_gUTayz-0xmIy4mq4Jm-rJ-Q7sPxExej');
    background-size: cover;
    background-position: center;
    filter: blur(2px); 
    z-index: -1;
}
.rounded-logo {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
}
.hero-text {
    position: absolute; 
    top: 50%;
    left: 50%;
    background-color: rgba(255, 255, 255, 0.8);
    transform: translate(-50%, -50%);
    padding: 20px;
    border-radius: 35px;
    z-index: 1; 
}
.hero-text h1 {
    font-size: 3.5rem;
    font-weight: bold;
    margin-bottom: 10px;
    text-align: center;
    color: #2c2c54;
}
.hero-text p {
    font-size: 1.3rem;
    margin-bottom: 30px;
    color: black;   
}
.navbar {
    background-color: rgba(255  , 255, 255, 0.8);
    position: fixed; 
    width: 100%; 
    z-index: 2;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); 
}
.navbar .btn {
    background-color: #2c2c54;
    padding: 10px 15px;
    border-radius: 10px;
}
.navbar .btn:hover {
    background-color: #4e2a70;
}
.search-bar {
    position: absolute;
    bottom: 50px;
    left: 50%;
    transform: translateX(-50%);
    width: 35%;
    height: 15%;
    background-color: white;
    border-radius: 20px;
    padding: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.search-bar form {
    width: 100%;
    display: flex;
}
.search-bar .input-group {
    flex-grow: 1;
    margin-right: 10px;
}
.search-bar .input-group input {
    border-radius: 50px 0 0 50px;
}
.search-bar .input-group .input-group-text {
    border-radius: 50px 0 0 50px;
}
.search-bar button {
    border-radius: 0 50px 50px 0;
    padding: 10px 20px;
    font-size: 16px;
    background-color: #007bff;
    color: white;
    border: none;
}
.search-bar button:hover {
    background-color: #0056b3;
}
.room-card {
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    text-align: center;
    padding: 15px;
    margin: 10px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: none;
    background: linear-gradient(145deg, #2c3e50, #34495e);
}
.room-card img {
    width: 100%;
    height: auto;
    border-radius: 10px;
}
.room-card h5 {
    font-size: 1.2rem;
    color: #e7decf;
    margin-top: 10px;
    font-weight: bold;
}
.room-card p {
    font-size: 1rem;
    color: #ba96f2;
    font-weight: bold;
}
.section-heading {  
    font-size: 2.5rem;
    font-weight: bold;
    text-align: center;
    margin-top: 60px;
    margin-bottom: 30px;
    color: white;
}

.room-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}
.room-image {
    height: 300px;
    object-fit: cover;
    border-radius: 15px 0 0 15px;
}
.facilities-list {
    list-style: none;
    padding-left: 0;
}
.facilities-list li {
    margin-bottom: 8px;
    display: flex;
    align-items: center;
}
.facilities-list li::before {
    content: "✓";
    color: #2ecc71;
    margin-right: 10px;
    font-weight: bold;
}
.price-tag {
    font-size: 1.5rem;
    font-weight: bold;
    color: #f1c40f;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
}
.badge {
    margin-right: 5px;
    padding: 8px 12px;
    border-radius: 20px;
}
.book-now-btn {
    background: linear-gradient(145deg, #e74c3c, #c0392b);
    border: none;
    padding: 12px 25px;
    border-radius: 25px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
}
.book-now-btn:hover {
    background: linear-gradient(145deg, #c0392b, #e74c3c);
    transform: scale(1.05);
}
.search-container {
    background: rgba(44, 62, 80, 0.9);
    padding: 20px;
    border-radius: 20px;
    margin-bottom: 30px;
}
.helo {
    text-align: left !important;
}
body {
    background-color: #2c2c54;
    font-family: Arial, sans-serif;
}
.footer {
    text-align: center;
    background-color: #e7decf;
    color: black;
    padding: 40px 20px;
    font-family: Arial, sans-serif;
}
.footer-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 20px;
}
.footer-section {
    flex: 1;
    min-width: 250px;
}
.footer-section h4 {
    font-size: 25px;
    margin-bottom: 15px;
    color: #f39c12;
}
.footer-section p,
.footer-section ul,
.footer-section li {
    font-size: 17px;
    line-height: 1.5;
}
.footer-section ul {
    list-style: none;
    padding: 0;
}
.footer-section ul li {
    margin-bottom: 10px;
}
.footer-section ul li a {
    color: black;
    text-decoration: none;
}
.footer-section ul li a:hover {
    text-decoration: underline;
}
.social-icons a {
    margin-right: 10px;
    color: black;
    font-size: 25px;
    text-decoration: none;
}
.social-icons a:hover {
    color: #f39c12;
}
.footer-bottom {
    text-align: center;
    margin-top: 20px;
    font-size: 13px;
    border-top: 1px solid black;
    padding-top: 11px;
}
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-transparan">
         <div class="container">
            <a class="navbar-brand" href="#">
             <img src="{{ asset('images/logo_resteasy.jpg') }}" alt="RestEasy Logo" class="rounded-logo">RestEasy
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <li class="nav-item"><a class="btn btn-primary ms-2" href="login.php">Book Now</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="background-image"></div>
        <div class="hero-text">
            <h1>Start your vacation with us</h1>
            <p>Discover the world with RestEasy Hotel. Get the best service with us.</p>
        </div>
        <div class="search-bar d-flex justify-content-between align-items-center">
            <form action="search.php" method="GET" class="d-flex">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-user"></i>
                    </span>
                    <input type="text" name="query" class="form-control" placeholder="Search room" required>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- Room Section -->
    <div class="container my-5">
        <h2 id="home" class="section-heading">OUR ROOMS</h2>
        <div class="row">
            <!-- Kamar Standar -->
            <div class="col-md-4">
                <div class="room-card">
                    <a href="daftar_standart.php">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRn__LIliXo2ktoNEE5i-gBgU-so0TzMppKcFGk6krtD59JKDRC" alt="Standard Room">
                    </a>
                        <h5>Standart Room</h5>
                        <p>Rp. 500.000 - 1.000.000/malam</p>
                </div>
            </div>
            <!-- Kamar Deluxe -->
            <div class="col-md-4">
                <div class="room-card">
                    <a href="daftar_deluxe.php">
                        <img src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcTbH3sCE-6AfI13DN6QOxjAA_7Gx5dh-3Z9UeLKT_UioF2_H2fp" alt="Deluxe Room">
                    </a>
                        <h5>Deluxe Room</h5>
                        <p>Rp. 1.750.000/malam</p>
                </div>
            </div>
            <!-- Kamar Suite -->
            <div class="col-md-4">
                <div class="room-card">
                    <a href="daftar_suite.php">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRuoK7sBs7_-4LMrBCZRjWl1gyWrTJSQ20A0Y3R-ClAl7xI8dQn" alt="Suite Room">
                    </a>
                    <h5>Suite Room</h5>
                    <p>Rp. 2.050.000/malam</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section">
                <h4 id="about">About Us</h4>
                <p>Experience the Extraordinary at RestEasy Hotel  
                  RestEasy Hotel brings comfort with a touch of elegance. Located in the city center, we offer modern rooms, 
                  a classy restaurant, a spacious swimming pool, and a comfortable sports area for visitors. Whether you come for business or pleasure, 
                  we are ready to provide an unforgettable experience.</p>
            </div>
            <div class="footer-section">
                <h4 id="contact">Contact Us</h4>
                <ul>
                    <li>📍 Hotel RestEasy, Batam</li>
                    <li>📞 +62 852 7190 1194</li>
                    <li>✉️ info@resteasyhotel.com</li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="https://wa.me/qr/FLMEQFAAKLWVB1">Contact Us</a></li>
                    <li><a href="https://maps.app.goo.gl/AcL35RGv97HTroc26">Locations</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Follow Us</h4>
                <div class="social-icons">
                    <a href="https://www.instagram.com/arrelzi?igsh=MmltcHVqeHJuMHhv"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Paradise Hotel. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
