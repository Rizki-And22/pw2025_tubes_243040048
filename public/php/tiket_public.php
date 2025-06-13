<?php
require_once('../../admin/php/database.php');


$data_tiket = select("SELECT * FROM manajemen_tiket");





?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Lana Fest Ticket List</title>
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

        .card {
            border: none;
            border-radius: 2rem;
            background: #fff;
            box-shadow: 0 8px 32px 0 rgba(80, 0, 120, 0.15);
            margin-bottom: 2.5rem;
            font-size: 1.35rem;
            padding: 2rem 1.5rem;
        }

        .card-title {
            color: #5f0a87;
            font-weight: 800;
            letter-spacing: 2px;
            font-size: 2.5rem;
        }

        .table {
            background: #fff;
            border-radius: 1.5rem;
            overflow: hidden;
            font-size: 1.25rem;
        }

        .table-primary {
            background: linear-gradient(90deg, #a4508b 0%, #5f0a87 100%);
            color: #fff;
            border: none;
            font-size: 1.2rem;
        }

        .table-striped>tbody>tr:nth-of-type(odd) {
            --bs-table-accent-bg: #f3e6fa;
        }



        th,
        td {
            vertical-align: middle !important;
            padding-top: 1rem !important;
            padding-bottom: 1rem !important;
            font-weight: bold;
        }

        p {
            font-weight: normal;
            color: #808080;
            font-size: 15px;
        }

        @media (max-width: 576px) {
            .card-title {
                font-size: 1.5rem;
            }

            .card {
                font-size: 1rem;
                padding: 1rem 0.5rem;
            }

            .table {
                font-size: 1rem;
            }
        }

        .container-xl {
            margin-top: 110px;
        }

        .card {
            margin-left: auto;
            margin-right: auto;
        }

        .table th,
        .table td {
            text-align: center;
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
                <!-- Bootstrap Icons CDN -->
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
        <h1 class="text-center mb-5 text-white fw-bold" style="letter-spacing:2px; font-size:3rem;">LAna Fest Ticket List</h1>
        <div class="row justify-content-center">
            <div class="col-lg-10 mb-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Daftar Tiket</h2>
                        <div class="table-responsive">
                            <table class="table table-striped align-middle">
                                <thead class="table-primary">
                                    <tr>
                                        <th style="width:5%;">No</th>
                                        <th style="width:30%;">Nama Tiket</th>
                                        <th style="width:20%;">Harga</th>
                                        <!-- <th style="width:15%;">Kuota</th>
                                        <th style="width:30%;">Tanggal Berlaku</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data_tiket as $i => $ticket): ?>

                                        <tr>
                                            <td><?= $i + 1 ?></td>
                                            <td><?= htmlspecialchars($ticket['Nama_Tiket']) ?>
                                                <p>
                                                <p><?= htmlspecialchars($ticket['deskripsi']); ?></p>
                                                </p>

                                            </td>
                                            <td>Rp <?= number_format($ticket['Harga'], 0, ',', '.') ?></td>
                                            <!-- <td><?= htmlspecialchars($ticket['Kuota']) ?></td>
                                            <td><?= htmlspecialchars($ticket['Tanggal_Berlaku']) ?></td> -->
                                        </tr>

                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS (optional, for interactivity) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>