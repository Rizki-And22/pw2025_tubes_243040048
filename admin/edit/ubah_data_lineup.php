<?php
include '../php/database.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}



$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$lineup = select("SELECT * FROM lineup WHERE id = $id");

$lineup = $lineup[0];

$manajemen_event = select("SELECT * FROM manajemen_event");

if (isset($_POST['ubah'])) {


    if (ubah_data_lineup($_POST) > 0) {
        echo "<script>
                alert('Data lineup berhasil diubah!');
                document.location.href = '../php/manajemen lineup.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal mengubah data lineup!');
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

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Edit Lineup</h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if (!empty($_SESSION['msg'])) {
                            echo '<div class="alert alert-danger">' . $_SESSION['msg'] . '</div>';
                            unset($_SESSION['msg']);
                        }
                        ?>
                        <?php if (!empty($msg)) echo $msg; ?>
                        <form method="post" enctype="multipart/form-data">
                            <input type="hidden" name="ID_Lineup" value="<?= $lineup['id'] ?>">
                            <div class="mb-3">
                                <label class="form-label">Nama Band</label>
                                <input type="text" name="nama_band" class="form-control" required value="<?= htmlspecialchars($lineup['band']) ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Foto Band</label>
                                <input type="file" name="foto" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Genre</label>
                                <select name="genre" id="genre" class="form-select" required>
                                    <option value="">-- Pilih Genre --</option>
                                    <?php foreach ($manajemen_event as $event): ?>
                                        <option value="<?= $event['ID_Event'] ?>" <?= $event['ID_Event'] == $lineup['ID_Event'] ? 'selected' : ''  ?>><?= $event['Nama_Event'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Waktu</label>
                                <input type="time" name="waktu" class="form-control" min="1" required value="<?= htmlspecialchars($lineup['waktu']) ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Stage</label>
                                <select name="stage" id="stage" class="form-select" required>
                                    <option value="">-- Pilih Stage --</option>
                                    <option value="Stage 1" <?= $lineup['stage'] == 'Stage 1' ? 'selected' : '' ?>>Stage 1</option>
                                    <option value="Stage 2" <?= $lineup['stage'] == 'Stage 2' ? 'selected' : '' ?>>Stage 2</option>
                                    <option value="Stage 3" <?= $lineup['stage'] == 'Stage 3' ? 'selected' : '' ?>>Stage 3</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success w-100" name="ubah">Ubah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


</html>