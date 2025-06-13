<?php
// Tidak perlu koneksi database jika hanya info statis
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Kontak Admin - Lana Fest</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #a4508b 0%, #5f0a87 100%);
            min-height: 100vh;
        }

        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.97);
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

        .container-xl {
            margin-top: 110px;
        }

        .card {
            border: none;
            border-radius: 2rem;
            background: #fff;
            box-shadow: 0 8px 32px 0 rgba(80, 0, 120, 0.15);
            margin-bottom: 2.5rem;
            font-size: 1.35rem;
            padding: 2rem 1.5rem;
            margin-left: auto;
            margin-right: auto;
        }

        @media (max-width: 576px) {
            .card {
                font-size: 1rem;
                padding: 1rem 0.5rem;
            }
        }
    </style>
</head>

<body>
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
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="btn btn-gradient rounded-pill px-4 fw-bold" href="index.php">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                    </li>
                </ul>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
                <style>
                    .btn-gradient {
                        background: linear-gradient(90deg, #a4508b 0%, #5f0a87 100%);
                        color: #fff !important;
                        border: none;
                        transition: background 0.2s;
                    }

                    .btn-gradient:hover,
                    .btn-gradient:focus {
                        background: linear-gradient(90deg, #5f0a87 0%, #a4508b 100%);
                        color: #fff !important;
                    }
                </style>
            </div>
        </div>
    </nav>
    <div class="container-xl py-5">
        <h1 class="text-center mb-5 text-white fw-bold" style="letter-spacing:2px; font-size:3rem;">Kontak Admin</h1>
        <div class="row justify-content-center">
            <div class="col-lg-7 mb-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Hubungi Admin Lana Fest</h2>
                        <ul class="list-group list-group-flush fs-5">
                            <li class="list-group-item">
                                <i class="bi bi-person-circle me-2"></i>
                                Nama: <strong>Admin Lana Fest</strong>
                            </li>
                            <li class="list-group-item">
                                <i class="bi bi-envelope me-2"></i>
                                Email: <a href="mailto:admin@lanafest.com">admin@lanafest.com</a>
                            </li>
                            <li class="list-group-item">
                                <i class="bi bi-telephone me-2"></i>
                                WhatsApp: <a href="https://wa.me/6281234567890" target="_blank">+62 812-3456-7890</a>
                            </li>
                            <li class="list-group-item">
                                <i class="bi bi-geo-alt me-2"></i>
                                Alamat: Jl. Raya Festival No. 123, Jakarta
                            </li>
                        </ul>
                        <div class="mt-4 text-center">
                            <span class="text-muted">Silakan hubungi admin untuk pertanyaan atau bantuan terkait tiket Lana Fest.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>