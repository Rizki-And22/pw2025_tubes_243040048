<?php include 'database.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
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


        .home-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 60px 40px;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 8px 32px rgba(106, 13, 173, 0.15);
            margin-top: 40px;
        }

        .home-content .kiri {
            max-width: 55%;
            color: #fff;
        }

        .home-content h1 {
            font-size: 48px;
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: 1px;
            color: #6a0dad;
            text-shadow: 4px 8px 24px rgba(106, 13, 173, 0.25), 2px 4px 16px rgba(0, 0, 0, 0.18);
        }

        .home-content h3 {
            font-size: 32px;
            font-weight: 700;
            color: #A9A9A9;
            margin-bottom: 18px;
            text-shadow: 2px 4px 16px rgba(106, 13, 173, 0.18), 1px 2px 8px rgba(0, 0, 0, 0.15);
        }

        .home-content p {
            font-size: 17px;
            margin: 18px 0 28px;
            text-align: justify;
            color: #333;
            line-height: 1.7;
        }

        .home-content strong {
            color: #A9A9A9;
        }

        .home-content img {
            max-width: 320px;
            min-width: 200px;
            height: auto;
            border-radius: 18px;
            box-shadow: 0 8px 32px rgba(106, 13, 173, 0.18), 0 2px 8px rgba(0, 0, 0, 0.08);
            border: 6px solid #fff;
            margin-left: 40px;
            transition: transform 0.3s, box-shadow 0.3s;
            display: block;
            background: none;
        }

        .home-content img:hover {
            transform: scale(1.05) rotate(-2deg);
            box-shadow: 0 16px 48px rgba(106, 13, 173, 0.25), 0 4px 16px rgba(0, 0, 0, 0.12);
        }

        .home-content .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }




        @media (max-width: 900px) {
            .home-content {
                flex-direction: column;
                padding: 30px 10px;
                text-align: center;
            }

            .home-content .kiri {
                max-width: 100%;
            }

            .home-content img {
                margin-top: 24px;
                max-width: 220px;
            }
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

                <li><a href="manajemen pembeli.php" class="nav-link"><i class="bi bi-bag-check-fill me-2"></i>Manajemen Pembeli</a></li>

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
                                header("Location:../../PW2025_TUBES_243040048/index.php");
                                exit;
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Content -->
            <div class="home-content">
                <div class="container">
                    <div class="kiri">
                        <h1>Hallo Sobat Lana!</h1>
                        <h3>Lana Fest!</h3>
                        <p>
                            Selamat datang di halaman admin Lana Fest! Di sini kamu bisa mengelola berbagai aspek dari festival ini, mulai dari manajemen event, tiket, hingga pengguna. Pastikan untuk selalu memperbarui informasi dan menjaga keamanan data.
                        </p>
                        <p>
                            Jika ada pertanyaan atau butuh bantuan, jangan ragu untuk menghubungi tim support kami. Selamat beraktivitas!
                        </p>
                        <p>
                            <strong>Catatan:</strong> Pastikan untuk selalu logout setelah selesai mengelola data untuk menjaga keamanan akun Anda.
                        </p>
                    </div>
                    <img src="../img/logo.png" />
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>