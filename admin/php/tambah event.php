<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
// Proses simpan tiket jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_event = $_POST['nama_event'] ?? '';
    $tanggal = $_POST['tanggal'] ?? '';
    $waktu = $_POST['waktu'] ?? '';
    $lokasi = $_POST['lokasi'] ?? '';
    $status = $_POST['status'] ?? '';
    $kapasitas = $_POST['0'] ?? '';

    // Validasi sederhana
    if ($nama_event && $tanggal && $waktu && $lokasi && $status) {
        // Koneksi ke database (ganti sesuai konfigurasi Anda)
        $conn = new mysqli('localhost', 'root', '', 'web_tiket');
        if ($conn->connect_error) {
            die('<div class="alert alert-danger">Koneksi gagal: ' . $conn->connect_error . '</div>');
        }

        $stmt = $conn->prepare("INSERT INTO manajemen_event (Nama_Event, Tanggal, waktu, Lokasi, Status, Kapasitas) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $nama_event, $tanggal, $waktu, $lokasi, $status, $kapasitas);
        if ($stmt->execute()) {
            $msg = '<div class="alert alert-success">Event berhasil ditambahkan!</div>';
            echo "<script>setTimeout(function(){ window.location.href = 'manajemen_event.php'; }, 2000);</script>";
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
                        <h4 class="mb-0">Tambah Event</h4>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($msg)) echo $msg; ?>
                        <form method="post">
                            <div class="mb-3">
                                <label class="form-label">Nama Event</label>
                                <input type="text" name="nama_event" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" min="0" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Waktu</label>
                                <input type="time" name="waktu" class="form-control" min="1" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Lokasi</label>
                                <input type="text" name="lokasi" class="form-control" min="1" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" id="Status" name="status" min="1" required>
                                    <option value="">Pilih Status</option>
                                    <option value="tersedia">tersedia</option>
                                    <option value="tidak tersedia">Tidak Tersedia</option>
                                    <option value="dibatalkan">dibatalkan</option>
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