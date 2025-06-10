<?php include 'database.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
?>
<?php $data_pelanggan = select("SELECT lineup.*, manajemen_event.Nama_Event FROM lineup LEFT JOIN manajemen_event ON lineup.ID_Event = manajemen_event.ID_Event"); ?>
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
                    <a href="manajemen lineup.php" class="nav-link active">
                        <i class="bi bi-calendar-event-fill me-2"></i>Manajemen Lineup
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
            </ul>
        </nav>
        <!-- Main Content -->
        <div class="flex-grow-1 d-flex flex-column min-vh-100">
            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light border-bottom">
                <div class="container-fluid justify-content-end">
                    <div class="dropdown">
                        <button class="btn btn-light d-flex align-items-center dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://ui-avatars.com/api/?name=<?= urlencode($_SESSION['username'][0] ?? 'U') ?>&background=198754&color=fff" class="avatar" alt="avatar">
                            <span class="fw-semibold"><?= htmlspecialchars($_SESSION['username'] ?? 'User'); ?></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Ubah Password</a></li>
                            <li>
                                <form method="POST" class="d-inline" action="logout.php">
                                    <button type="submit" name="logout" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                            <?php
                            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
                                session_start();
                                session_unset();
                                session_destroy();
                                header("Location:../../index.php");
                                exit;
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Content -->
            <div class="container py-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold mb-0">Manajemen Lineup</h3>
                    <a href="tambah_lineup.php" class="btn btn-success btn-custom">
                        <i class="bi bi-plus-circle me-1"></i>Tambah Lineup
                    </a>
                </div>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped align-middle" id="table" class="table table-striped">
                                <thead class="table-success text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Band</th>
                                        <th>Foto</th>
                                        <th>Genre</th>
                                        <th>Waktu</th>
                                        <th>Stage</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($data_pelanggan)): ?>
                                        <?php $no = 1; ?>
                                        <?php foreach ($data_pelanggan as $pelanggan): ?>
                                            <tr>
                                                <td class="text-center"><?= $no++ ?></td>
                                                <td><?= htmlspecialchars($pelanggan['band']); ?></td>
                                                <td><img src="../../uploads/lineup/<?= $pelanggan['foto'] ?>" alt="" width="50%"></td>
                                                <td><?= htmlspecialchars($pelanggan['Nama_Event']); ?></td>
                                                <td class="text-center"><?= $pelanggan['waktu']; ?></td>
                                                <td><?= htmlspecialchars($pelanggan['stage']); ?></td>
                                                <td>
                                                    <a href="../edit/ubah_data_tiket.php?id=<?= urlencode($pelanggan['id']); ?>"
                                                        class="btn btn-outline-success btn-sm me-1" title="Ubah Data">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <a href="../hapus/hapus_data_tiket.php?id=<?= urlencode($pelanggan['id']); ?>"
                                                        class="btn btn-outline-danger btn-sm"
                                                        onclick="return confirm('Yakin ingin menghapus data ini?');" title="Hapus Data">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="8" class="text-center text-muted">Belum ada data tiket.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
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