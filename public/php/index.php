<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Lana Fest - Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;400&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', Arial, sans-serif;
            background: #6a0dad;
            color: #22223b;
            min-height: 100vh;
            padding-top: 90px;
            /* Agar tidak tertutup navbar */
        }

        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background: #fff;
            box-shadow: 0 2px 16px rgba(106, 13, 173, 0.10);
            border-radius: 0 0 24px 24px;
            padding: 1rem 0;
            z-index: 1000;
        }

        .navbar-brand {
            font-weight: 800;
            letter-spacing: 2px;
            font-size: 2.3rem;
            color: #6a0dad !important;
            text-shadow: 0 2px 8px #b993d6;
        }

        .nav-link {
            color: #6a0dad !important;
            font-weight: 600;
            margin-left: 1.2rem;
            transition: color 0.2s, border-bottom 0.2s;
            border-bottom: 2px solid transparent;
        }

        .nav-link.active,
        .nav-link:hover {
            color: #a259e6 !important;
            border-bottom: 2px solid #a259e6;
        }

        .btn-primary {
            background: #6a0dad;
            border: none;
            font-weight: 700;
            letter-spacing: 1px;
            color: white;
            box-shadow: 0 4px 16px rgba(106, 13, 173, 0.15);
            transition: background 0.2s, transform 0.2s;
        }

        .btn-primary:hover {
            background: #6a0dad;
            transform: scale(1.05);
        }

        .hero-section {
            background: url("../img/konser.jpeg") no-repeat center center/cover;
            min-height: 90vh;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .hero-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            /* tingkat gelap, bisa disesuaikan */
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            /* agar berada di atas overlay */
            color: #fff;
            text-shadow: 0 2px 16px rgba(0, 0, 0, 0.4);
            padding: 4rem 2rem;
            animation: fadeInDown 1.2s;
        }


        .hero-content h1 {
            font-size: 4rem;
            font-weight: 900;
            letter-spacing: 2px;
            margin-bottom: 1.2rem;
        }

        .hero-content p {
            font-size: 1.7rem;
            margin-bottom: 2.5rem;
        }

        .btn-warning {
            background: linear-gradient(90deg, #a259e6 0%, #6a0dad 100%);
            border: none;
            font-weight: 700;
            letter-spacing: 1px;
            color: white;
            box-shadow: 0 4px 16px rgba(106, 13, 173, 0.18);
            transition: background 0.2s, transform 0.2s;
        }

        .btn-warning:hover {
            background: linear-gradient(90deg, #6a0dad 0%, #a259e6 100%);
            transform: scale(1.05);
        }

        .about-section {
            background: #fff;
            border-radius: 2rem;
            box-shadow: 0 8px 32px rgba(79, 70, 229, 0.10);
            margin-top: -4rem;
            position: relative;
            z-index: 3;
            padding: 3.5rem 2rem;
            animation: fadeInUp 1.2s;
        }

        .about-icon {
            font-size: 3rem;
            color: #a259e6;
            background: #f3e9ff;
            border-radius: 50%;
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem auto;
            box-shadow: 0 2px 8px rgba(106, 13, 173, 0.10);
        }

        .stats-title {
            color: #6a0dad;
            font-weight: 800;
            font-size: 2.2rem;
        }

        .card {
            border: none;
            border-radius: 1.5rem;
            box-shadow: 0 4px 24px rgba(31, 41, 55, 0.10);
            transition: transform 0.2s, box-shadow 0.2s;
            background: linear-gradient(120deg, #fff 80%, #f3e9ff 100%);
        }

        .card:hover {
            transform: translateY(-8px) scale(1.04);
            box-shadow: 0 8px 32px rgba(106, 13, 173, 0.15);
        }

        .card-img-top {
            border-top-left-radius: 1.5rem;
            border-top-right-radius: 1.5rem;
            height: 260px;
            object-fit: cover;
            filter: grayscale(10%) brightness(0.98);
            transition: filter 0.3s;
        }

        .card:hover .card-img-top {
            filter: none;
        }

        .card-title {
            color: #6a0dad;
            font-weight: 700;
        }

        .footer-link {
            color: #a259e6;
            text-decoration: underline;
        }

        footer {
            background: #6a0dad;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .glass {
            background: rgba(255, 255, 255, 0.10);
            border-radius: 2rem;
            box-shadow: 0 8px 32px rgba(106, 13, 173, 0.10);
            backdrop-filter: blur(4px);
        }

        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.2rem;
            }

            .hero-content p {
                font-size: 1.1rem;
            }

            .about-section {
                padding: 2rem 1rem;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="../../admin/img/logo.png" alt="Logo" class="me-2" style="height:44px;">
                LANA FEST
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="lineup.php">Line Up</a></li>
                    <li class="nav-item"><a class="nav-link" href="tiket_public.php">Tickets</a></li>
                    <li class="nav-item"><a class="nav-link active" href="form tiket anda.php">Tiket Saya</a></li>
                    <li class="nav-item"><a class="nav-link" href="kontak.php">Contact</a></li>
                </ul>
                <a href="logout user.php" class="ms-lg-3">
                    <button type="button" class="btn btn-primary btn-lg" name="login">Logout</button>
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section position-relative">
        <div class="container hero-content text-center py-5">
            <h1>Welcome to Lana Fest 2024</h1>
            <p>Unleash your passion for music. 3 days. 30+ artists. 10,000+ fans. Are you ready?</p>
            <a href="../beli tiket/pembelian tiket.php" class="btn btn-warning btn-lg px-5 shadow">Buy Tickets</a>
        </div>
        <div class="position-absolute bottom-0 start-50 translate-middle-x" style="width:100px;height:40px;">
            <svg width="100" height="40" viewBox="0 0 100 40" fill="none">
                <ellipse cx="50" cy="20" rx="50" ry="10" fill="#fff" fill-opacity="0.15" />
            </svg>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section container py-5 mt-5 mb-5">
        <h2 class="text-center mb-4 fw-bold" style="color:#6a0dad;">About Lana Fest</h2>
        <p class="text-center fs-5 mx-auto" style="max-width: 700px;">
            Lana Fest is the ultimate celebration of music, creativity, and togetherness. Join us for a weekend packed with electrifying performances, immersive experiences, and unforgettable moments under the stars.
        </p>
        <div class="row justify-content-center mt-4">
            <div class="col-md-3 text-center mb-4 mb-md-0">
                <div class="about-icon mb-2">&#127908;</div>
                <h3 class="stats-title">30+</h3>
                <p>Artists</p>
            </div>
            <div class="col-md-3 text-center mb-4 mb-md-0">
                <div class="about-icon mb-2">&#128197;</div>
                <h3 class="stats-title">3</h3>
                <p>Days</p>
            </div>
            <div class="col-md-3 text-center">
                <div class="about-icon mb-2">&#128101;</div>
                <h3 class="stats-title">10K+</h3>
                <p>Attendees</p>
            </div>
        </div>
    </section>

    <!-- Line Up Preview -->
    <section class="bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-4 fw-bold" style="color:#6a0dad;">Featured Artists</h2>
            <div class="row justify-content-center">
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <img src="https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?auto=format&fit=crop&w=400&q=80" class="card-img-top" alt="Artist 1">
                        <div class="card-body text-center">
                            <h5 class="card-title">Aurora Lane</h5>
                            <p class="card-text text-muted">Pop Sensation</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <img src="https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=crop&w=400&q=80" class="card-img-top" alt="Artist 2">
                        <div class="card-body text-center">
                            <h5 class="card-title">Echo Drive</h5>
                            <p class="card-text text-muted">Rock Legend</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <img src="https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?auto=format&fit=crop&w=400&q=80" class="card-img-top" alt="Artist 3">
                        <div class="card-body text-center">
                            <h5 class="card-title">DJ Nova</h5>
                            <p class="card-text text-muted">EDM Star</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="lineup.php" class="btn btn-outline-primary btn-lg" style="border-width:2px;">See Full Line Up</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-white text-center py-4 mt-5">
        <div class="container">
            &copy; <?php echo date('Y'); ?> Lana Fest. All rights reserved.
            <br>
            <a href="#" class="footer-link">Privacy Policy</a> &middot; <a href="#" class="footer-link">Terms</a>
        </div>
    </footer>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>