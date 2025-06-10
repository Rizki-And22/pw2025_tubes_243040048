<?php
session_start();

include 'database.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

$query_event = "SELECT * FROM manajemen_event";
$result_event = mysqli_query($db, $query_event);
$data_event = mysqli_fetch_all($result_event, MYSQLI_ASSOC);

// Proses simpan tiket jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_band = $_POST['nama_band'] ?? '';
    $genre = $_POST['genre'] ?? '';
    $waktu = $_POST['waktu'] ?? '';
    $stage = $_POST['stage'] ?? '';
    $foto = $_FILES['foto']['name'] ?? '';
    $foto_tmp = $_FILES['foto']['tmp_name'] ?? '';
    $msg = '';
    $target_dir = "../../uploads/lineup/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }
    $typefoto = strtolower(pathinfo($foto, PATHINFO_EXTENSION));

    $imageFileType = $typefoto;
    $target_file = $target_dir . basename($nama_band) . '.' . $imageFileType;
    $save_foto = basename($nama_band) . '.' . $imageFileType;
    $uploadOk = 1;
    $check = getimagesize($foto_tmp);

    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $_SESSION['msg'] = 'File yang diunggah bukan gambar!';
        $uploadOk = 0;
        header("Location: tambah_lineup.php");
        exit();
    }

    // Cek ukuran file
    if ($_FILES['foto']['size'] > 500000) {
        $_SESSION['msg'] = 'Maaf, ukuran file terlalu besar!';
        $uploadOk = 0;
        header("Location: tambah_lineup.php");
        exit();
    }
    // Cek format file
    if (!in_array($typefoto, ['jpg', 'png', 'jpeg', 'gif'])) {
        $_SESSION['msg'] = 'Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan!';
        $uploadOk = 0;
        header("Location: tambah_lineup.php");
        exit();
    }
    if ($uploadOk == 0) {
        $_SESSION['msg'] = 'Maaf, file tidak dapat diunggah!';
        header("Location: tambah_lineup.php");
        exit();
    } else {
        if (move_uploaded_file($foto_tmp, $target_file)) {
            $msg = '<div class="alert alert-success">File ' . htmlspecialchars(basename($foto)) . ' berhasil diunggah.</div>';
        } else {
            $_SESSION['msg'] = 'Maaf, terjadi kesalahan saat mengunggah file.';
            header("Location: tambah_lineup.php");
            exit();
        }
    }

    // Validasi sederhana
    if ($nama_band && $waktu && $genre && $stage) {
        // Koneksi ke database (ganti sesuai konfigurasi Anda)
        $conn = new mysqli('localhost', 'root', '', 'web_tiket');
        if ($conn->connect_error) {
            die('<div class="alert alert-danger">Koneksi gagal: ' . $conn->connect_error . '</div>');
        }

        if ($foto) {
            $stmt = $conn->prepare("INSERT INTO lineup (band, ID_Event, waktu, stage, foto) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sisss", $nama_band, $genre, $waktu, $stage, $save_foto);
        } else {
            $stmt = $conn->prepare("INSERT INTO lineup (band, ID_Event, waktu, stage) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("siss", $nama_band, $genre, $waktu, $stage);
        }

        if ($stmt->execute()) {
            $msg = '<div class="alert alert-success">Event berhasil ditambahkan!</div>';
            echo "<script>setTimeout(function(){ window.location.href = 'manajemen lineup.php'; }, 2000);</script>";
        } else {
            $msg = '<div class="alert alert-danger">Gagal menambah event: ' . $conn->error . '</div>';
        }

        $stmt->close();
        $conn->close();
    } else {
        $msg = '<div class="alert alert-warning">Semua field wajib diisi!</div>';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Tambah Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Tambah Lineup</h4>
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
                            <div class="mb-3">
                                <label class="form-label">Nama Band</label>
                                <input type="text" name="nama_band" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Foto Band</label>
                                <input type="file" name="foto" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Genre</label>
                                <select name="genre" id="genre" class="form-select" required>
                                    <option value="">-- Pilih Genre --</option>
                                    <?php foreach ($data_event as $event): ?>
                                        <option value="<?= $event['ID_Event'] ?>"><?= $event['Nama_Event'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Waktu</label>
                                <input type="time" name="waktu" class="form-control" min="1" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Stage</label>
                                <select name="stage" id="stage" class="form-select" required>
                                    <option value="">-- Pilih Stage --</option>
                                    <option value="Stage 1">Stage 1</option>
                                    <option value="Stage 2">Stage 2</option>
                                    <option value="Stage 3">Stage 3</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success w-100">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>