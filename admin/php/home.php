<?php
include 'database.php';

// Ambil data total dari database
$manajemen_event = select("SELECT COUNT(*) as total FROM manajemen_event")[0]['total'] ?? 0;
$manajemen_tiket = select("SELECT COUNT(*) as total FROM manajemen_tiket")[0]['total'] ?? 0;
$penjualan_tiket = select("SELECT COUNT(*) as total FROM penjualan_tiket")[0]['total'] ?? 0;

// Mulai session jika belum
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuliner Khas Sunda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/data.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        /* .dropdown-menu {
            display: block !important;
            opacity: 1 !important;
            visibility: visible !important;
            z-index: 1050 !important;

        } */

        .sidebar {
            min-width: 220px;
            background: linear-gradient(180deg, #6a0dad 80%, #8f5fe8 100%);
            color: #fff;
            min-height: 100vh;
        }

        .sidebar .nav-link {
            color: #e9ecef;
            font-weight: 500;
            border-radius: 8px;
            margin-bottom: 4px;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background: #fff;
            color: #6a0dad;
        }

        .navbar {
            background-color: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
        }

        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 8px;
            border: 2px solid #6a0dad;
        }

        .btn-custom {
            min-width: 100px;
        }

        .table thead th {
            vertical-align: middle;
            text-align: center;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }
    </style>
</head>


<body>
    <div class="d-flex">


        <!-- Sidebar -->
        <nav class="sidebar d-flex flex-column p-3">
            <a class="navbar-brand mb-4 fs-4 fw-bold text-white" href="home.php">
                <i class="bi bi-music-note-beamed"></i> Lana Fest!
            </a>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="manajemen event.php" class="nav-link"><i class="bi bi-calendar-event-fill"></i>Manajemen Event</a>
                </li>
                <li class="nav-item">
                    <a href="manajemen lineup.php" class="nav-link">
                        <i class="bi bi-calendar-event-fill me-2"></i>Manajemen Lineup
                    </a>
                </li>
                <li><a href="manajemen tiket.php" class="nav-link"><i class="bi bi-ticket-perforated-fill"></i>Manajemen Tiket</a></li>

                <li><a href="manajemen pembelian.php" class="nav-link"><i class="bi bi-bag-check-fill me-2l"></i>Manajemen Pembeli</a></li>

            </ul>
        </nav>

        <!-- End Sidebar -->

        <!-- Main Content -->
        <div class="flex-grow-1 d-flex flex-column min-vh-100">
            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light border-bottom">
                <div class="container-fluid justify-content-end">
                    <div class="dropdown">
                        <img src="https://ui-avatars.com/api/?name=<?= urlencode($_SESSION['username'][0] ?? 'U') ?>&background=198754&color=fff" class="avatar" alt="avatar">
                        <span class="me-2 fw-semibold"><?= htmlspecialchars($_SES['username'] ?? 'User'); ?></span>
                        <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            ▼
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Ubah Password</a></li>
                            <li>
                                <form method="POST" class="d-inline" action="logout.php">
                                    <button type="submit" name="logout" class="dropdown-item">Logout</button>
                                </form>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Topbar -->

            <!-- Dashboard Cards -->
            <div class="container py-4">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card border-success shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <i class="bi bi-basket display-5 text-success me-3"></i>
                                <div>
                                    <h5 class="card-title mb-1">Total Event</h5>
                                    <h3 class="mb-0"><?= $manajemen_event ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-primary shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <i class="bi bi-list-ul display-5 text-primary me-3"></i>
                                <div>
                                    <h5 class="card-title mb-1">Total Tiket</h5>
                                    <h3 class="mb-0"><?= $manajemen_tiket ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-warning shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <i class="bi bi-person-check display-5 text-warning me-3"></i>
                                <div>
                                    <h5 class="card-title mb-1">Total Penjualan</h5>
                                    <h3 class="mb-0"><?= $penjualan_tiket ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Dashboard Cards -->

        </div>
        <!-- End Main Content -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>