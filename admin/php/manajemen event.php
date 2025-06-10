<?php include 'database.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
?>
<?php $data_pelanggan = select("SELECT * FROM manajemen_event"); ?>


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

            <!-- Content -->
            <div class="container py-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold mb-0">Manajemen Tiket</h3>
                    <a href="tambah event.php" class="btn btn-success btn-custom">
                        <i class="bi bi-plus-circle me-1"></i>Tambah Event
                    </a>
                </div>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped align-middle" id="table" class="table table-striped">
                                <thead class="table-success text-center">
                                    <tr>
                                        <th style="width: 5%;">No</th>
                                        <th style="width: 20%;">Nama Event</th>
                                        <th style="width: 15%;">Tanggal</th>
                                        <th style="width: 15%;">Waktu</th>
                                        <th style="width: 15%;">Lokasi</th>
                                        <th style="width: 15%;">Status</th>
                                        <th style="width: 15%;">Kapasitas</th>
                                        <th style="width: 15%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($data_pelanggan)): ?>
                                        <?php $no = 1; ?>
                                        <?php foreach ($data_pelanggan as $pelanggan): ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $pelanggan['Nama_Event']; ?></td>
                                                <td><?= $pelanggan['Tanggal']; ?></td>
                                                <td><?= $pelanggan['Waktu']; ?></td>
                                                <td><?= $pelanggan['Lokasi']; ?></td>
                                                <td><?= $pelanggan['Status']; ?></td>
                                                <td><?= $pelanggan['Kapasitas']; ?></td>

                                                <td>
                                                    <a href="../edit/ubah_data_event.php?id=<?= urlencode($pelanggan['ID_Event']); ?>"
                                                        class="btn btn-outline-success btn-sm me-1" title="Ubah Data">
                                                        <i class="bi bi-pencil-square"></i> Ubah
                                                    </a>
                                                    <a href="../hapus/hapus_data_event.php?id=<?= urlencode($pelanggan['ID_Event']); ?>"
                                                        class="btn btn-outline-danger btn-sm"
                                                        onclick="return confirm('Yakin ingin menghapus data ini?');" title="Hapus Data">
                                                        <i class="bi bi-trash"></i> Hapus
                                                    </a>
                                                </td>
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