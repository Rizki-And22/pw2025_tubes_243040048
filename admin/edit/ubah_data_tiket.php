<?php
include '../php/database.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}



$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$manajemen_tiket = select("SELECT * FROM manajemen_tiket WHERE id_tiket = $id");

$manajemen_tiket = $manajemen_tiket[0];

if (isset($_POST['ubah'])) {


    if (ubah_data_tiket($_POST) > 0) {
        echo "<script>
                alert('Data tiket berhasil diubah!');
                document.location.href = '../php/manajemen tiket.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal mengubah data tiket!');
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
                                <input type="hidden" name="ID_Tiket" value="<?= $manajemen_tiket['ID_Tiket'] ?>">

                                <div class="mb-3">
                                    <label for="Nama_Tiket" class="form-label">Nama Tiket</label>
                                    <input type="text" class="form-control" id="nama_Tiket" name="Nama_Tiket" placeholder="Masukkan Nama Tiket" value="<?= $manajemen_tiket['Nama_Tiket'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="Harga" class="form-label">Harga</label>
                                    <input type="decimal" class="form-control" id="harga" name="Harga" value="<?= $manajemen_tiket['Harga'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="Kuota" class="form-label">Kuota</label>
                                    <input type="int" class="form-control" id="kuota" name="Kuota" value="<?= $manajemen_tiket['Kuota'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="Kode_Promo" class="form-label">Kode Promo</label>
                                    <input type="text" class="form-control" id="Kode_Promo" name="Kode_Promo" placeholder="Masukkan Kode" value="<?= $manajemen_tiket['Kode_Promo'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="Tanggal_Berlaku" class="form-label">Tanggal Berlaku</label>
                                    <input type="date" class="form-control" id="Tanggal_Berlaku" name="Tanggal_Berlaku" placeholder="Masukkan Tanggal" value="<?= $manajemen_tiket['Tanggal_Berlaku'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="Status" class="form-label">Status</label>
                                    <select class="form-select" id="Status" name="Status" value="<?= $manajemen_tiket['Status'] ?>" required>>
                                        <option value="">Pilih Status</option>
                                        <option value="tersedia">Tersedia</option>
                                        <option value="terjual">Terjual</option>
                                    </select>
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