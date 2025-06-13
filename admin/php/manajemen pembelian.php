<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
require_once '../../admin/php/database.php';
$query = "SELECT penjualan_tiket.*, manajemen_event.Nama_Event 
          FROM penjualan_tiket 
          LEFT JOIN manajemen_event ON penjualan_tiket.ID_Event = manajemen_event.ID_Event";
$result = mysqli_query($db, $query);
$data_pembelian = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lana Fest!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/style.css">
    <!-- plugin table -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
    <style>
        body {
            background-color: white;
        }

        .sidebar {
            min-width: 220px;
            background-color: #6a0dad;
            color: #fff;
            min-height: 100vh;
        }

        .sidebar .nav-link {
            color: #e9ecef;
            font-weight: 500;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background: #ffffff;
            color: #6a0dad;
            ;
        }



        .navbar {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
            background-color: rgb(145, 143, 143);
        }



        .avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 8px;
        }

        .btn-custom {
            min-width: 70px;
        }

        .table-striped>tbody>tr:nth-of-type(odd) {
            background-color: #f3f6f9;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="sidebar d-flex flex-column p-3 shadow">
            <a class="navbar-brand mb-4 fs-4 fw-bold text-white d-flex align-items-center" href="home.php">
                <i class="bi bi-music-note-beamed me-2"></i> Lana Fest!
            </a>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="manajemen event.php" class="nav-link">
                        <i class="bi bi-calendar-event-fill me-2"></i>Manajemen Event
                    </a>
                </li>
                <li class="nav-item">
                    <a href="manajemen lineup.php" class="nav-link">
                        <i class="bi bi-people-fill me-2"></i>Manajemen Lineup
                    </a>
                </li>
                <li>
                    <a href="manajemen tiket.php" class="nav-link">
                        <i class="bi bi-ticket-perforated-fill me-2"></i>Manajemen Tiket
                    </a>
                </li>

                <li>
                    <a href="manajemen pembelian.php" class="nav-link">
                        <i class="bi bi-bag-check-fill me-2"></i>Manajemen Pembeli
                    </a>
                </li>
                <li>
                    <a href="manajemen_regist.php" class="nav-link">
                        <i class="bi bi-person-fill-add me-2"></i>Manajemen Registrasi
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="flex-grow-1 d-flex flex-column min-vh-100">
            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light border-bottom">
                <div class="container-fluid justify-content-end">
                    <div class="dropdown">
                        <img src="https://ui-avatars.com/api/?name=<?= urlencode($_SESSION['username'][0] ?? 'U') ?>&background=198754&color=fff" class="avatar" alt="avatar">
                        <span class="me-2 fw-semibold"><?= htmlspecialchars($_SESSION['username'] ?? 'User'); ?></span>
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

            <!-- Content -->
            <div class="container py-4">
                <h3 class="mb-4 fw-bold">Manajemen Pembeli</h3>
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle" id="table" class="table table-striped">
                        <thead class="table-success">
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th style="width: 20%;">Nama</th>
                                <th style="width: 15%;">Kontak</th>
                                <th style="width: 15%;">Email</th>
                                <th style="width: 15%;">Event</th>
                                <th style="width: 15%;">Harga</th>
                                <th style="width: 15%;">Total</th>
                                <th style="width: 15%;">Kode Booking</th>
                                <th style="width: 15%;">Metode Pembayaran</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($data_pembelian)): ?>
                                <?php $no = 1; ?>
                                <?php foreach ($data_pembelian as $pembelian): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $pembelian['nama_pemesan']; ?></td>
                                        <td><?= $pembelian['kontak_pemesan']; ?></td>
                                        <td><?= $pembelian['email']; ?></td>
                                        <td><?= $pembelian['Nama_Event']; ?></td>
                                        <td><?= $pembelian['harga']; ?></td>
                                        <td><?= $pembelian['total_harga']; ?></td>
                                        <td><?= $pembelian['kode_booking']; ?></td>
                                        <td><?= $pembelian['metode_pembayaran']; ?></td>


                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Belum ada data pelanggan.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- plagin bootstrap -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script> -->
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable({});
        });
    </script>
</body>

</html>