<?php
include '../../admin/php/database.php';

// Ambil data lineup dari database
$sql = "SELECT lineup.*, manajemen_event.Nama_Event FROM lineup LEFT JOIN manajemen_event ON lineup.ID_Event = manajemen_event.ID_Event";
$result = $db->query($sql);

$lineups = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $lineups[$row['Nama_Event']][] = [
            'name'  => $row['band'],
            'foto'  => $row['foto'],
            'time'  => $row['waktu'],
            'stage' => $row['stage']
        ];
    }
}
$db->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>LAna Fest Band Lineup</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- plugin table -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
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

        /* Tambahan agar lebih rapi */
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
        <h1 class="text-center mb-5 text-white fw-bold" style="letter-spacing:2px; font-size:3rem;">Lana Fest Band Lineup</h1>

        <div class="row justify-content-center">
            <?php foreach ($lineups as $category => $bands): ?>
                <div class="col-lg-10 mb-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <h2 class="card-title text-center mb-4"><?= htmlspecialchars($category) ?></h2>
                            <div class="table-responsive">
                                <table class="table table-striped align-middle" id="<?= htmlspecialchars(strtolower(str_replace(' ', '-', $category))) ?>">
                                    <thead class="table-primary">
                                        <tr>
                                            <th style="width:5%;">No</th>
                                            <th style="width:40%;">Band</th>
                                            <th style="width:40%;">Foto</th>
                                            <th style="width:20%;">Time</th>
                                            <th style="width:35%;">Stage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($bands as $i => $band): ?>
                                            <tr>
                                                <td><?= $i + 1 ?></td>
                                                <td><?= htmlspecialchars($band['name']) ?></td>
                                                <td><img src="../../uploads/lineup/<?= $band['foto'] ?>" alt="" width="30%"></td>
                                                <td><?= htmlspecialchars($band['time']) ?></td>
                                                <td><?= htmlspecialchars($band['stage']) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>

    <!-- Bootstrap JS (optional, for interactivity) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- plagin bootstrap -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script> -->
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>
    <script>
        $(document).ready(function() {
            $('#konser-90s').DataTable({});
            $('#konser-gigs').DataTable({});
            $('#konser-jazz').DataTable({});
        });
    </script>
</body>

</html>