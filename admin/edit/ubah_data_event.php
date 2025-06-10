<?php
include '../php/database.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}



$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$manajemen_event = select("SELECT * FROM manajemen_event WHERE id_event = $id");

$manajemen_event = $manajemen_event[0];

if (isset($_POST['ubah'])) {


    if (ubah_data_event($_POST) > 0) {
        echo "<script>
                alert('Data event berhasil diubah!');
                document.location.href = '../php/manajemen event.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal mengubah data event!');
              </script>";
    }
}
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
    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            min-width: 220px;
            background: linear-gradient(180deg, #6a0dad 80%, #8e44ad 100%);
            color: #fff;
            min-height: 100vh;
        }

        .sidebar .nav-link {
            color: #e9ecef;
            font-weight: 500;
            border-radius: 8px;
            margin-bottom: 4px;
            transition: background 0.2s, color 0.2s;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background: #fff;
            color: #6a0dad;
        }

        .navbar {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
            background-color: rgb(145, 143, 143);
        }

        .logo-img {
            width: 60px;
            height: 60px;
            object-fit: contain;
        }

        .card {
            border: none;
            border-radius: 16px;
        }

        .form-label {
            font-weight: 500;
        }

        .btn-primary {
            background-color: #6a0dad;
            border: none;
        }

        .btn-primary:hover {
            background-color: #5a0984;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                min-width: 100px;
                padding: 1rem 0.5rem;
            }

            .sidebar .navbar-brand {
                font-size: 1.2rem;
            }
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
                    <a href="manajemen_event.php" class="nav-link"><i class="bi bi-calendar-event-fill"></i> Manajemen Event</a>
                </li>
                <li>
                    <a href="manajemen_tiket.php" class="nav-link"><i class="bi bi-ticket-perforated-fill"></i> Manajemen Tiket</a>
                </li>
                <li>
                    <a href="manajemen_pengguna.php" class="nav-link"><i class="bi bi-people-fill"></i> Manajemen Pengguna</a>
                </li>
                <li>
                    <a href="manajemen_pembelian.php" class="nav-link"><i class="bi bi-people-fill"></i> Manajemen Pembeli</a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="container py-5">
            <div class="row justify-content-center align-items-center min-vh-100">
                <div class="col-md-7 col-lg-6">
                    <div class="card shadow-lg p-4">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <img src="../img/logo.png" alt="Logo" class="logo-img mb-2">
                                <h3 class="card-title mb-1">Ubah Data Event</h3>
                                <p class="text-muted" style="font-size: 0.95rem;">Edit detail event Lana Fest</p>
                            </div>
                            <form method="post" autocomplete="off">
                                <input type="hidden" name="ID_Event" value="<?= $manajemen_event['ID_Event'] ?>">

                                <div class="mb-3">
                                    <label for="nama_event" class="form-label">Nama Event</label>
                                    <input type="text" class="form-control" id="nama_event" name="Nama_Event" placeholder="Masukkan Nama Event" value="<?= $manajemen_event['Nama_Event'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal" name="Tanggal" value="<?= $manajemen_event['Tanggal'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="waktu" class="form-label">Waktu</label>
                                    <input type="time" class="form-control" id="waktu" name="Waktu" value="<?= $manajemen_event['Waktu'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="lokasi" class="form-label">Lokasi</label>
                                    <input type="text" class="form-control" id="lokasi" name="Lokasi" placeholder="Masukkan Lokasi" value="<?= $manajemen_event['Lokasi'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="Status" value="<?= $manajemen_event['Status'] ?>" required>>
                                        <option value="">Pilih Status</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Tidak Aktif">Tidak Aktif</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="kapasitas" class="form-label">Kapasitas</label>
                                    <input type="number" class="form-control" id="kapasitas" name="Kapasitas" placeholder="Masukkan Kapasitas" value="<?= $manajemen_event['Kapasitas'] ?>" required min="1">
                                </div>
                                <div class="d-grid mb-2">
                                    <button type="submit" class="btn btn-primary btn-lg" name="ubah">Ubah Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <small class="text-muted">© <?= date('Y') ?> Lana Fest. All rights reserved.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>