<?php
session_start();
require_once '../../admin/php/database.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pemesan = $_SESSION['id'];
    $nama = $_POST['nama'];
    $kontak = $_POST['kontak'];
    $email = $_POST['email'];
    $metode = $_POST['metode'];
    $kategori = $_POST['kategori'];
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['harga'];
    $subtotal = $_POST['subtotal'];
    $tanggal = date('Y-m-d H:i:s');
    $event = $_POST['event'];

    if (empty($nama) || empty($kontak) || empty($email) || empty($metode) || empty($kategori) || empty($jumlah) || empty($harga) || empty($subtotal) || empty($event)) {
        echo "<script>alert('Semua field harus diisi!');</script>";
    } else {
        $stock = mysqli_query($db, "SELECT Kuota FROM manajemen_tiket WHERE ID_Tiket = '$kategori'");
        $stock_data = mysqli_fetch_assoc($stock);

        $stok_akhir = $stock_data['Kuota'] - $jumlah;

        if ($stok_akhir <= 0) {
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                window.onload = function() {
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Tidak cukup stok tiket untuk kategori ini.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            </script>";
            exit;
        } else {
            $decrease_query = "UPDATE manajemen_tiket SET Kuota = '$stok_akhir' WHERE ID_Tiket = '$kategori'";
            mysqli_query($db, $decrease_query);

            $insert_query = "INSERT INTO penjualan_tiket (metode_pembayaran, jumlah_tiket, id_pemesan, ID_Event, nama_pemesan, kontak_pemesan,  email, ID_Tiket, harga, total_harga, kode_booking, tanggal)
                         VALUES ('$metode', '$jumlah', $id_pemesan, $event, '$nama', '$kontak', '$email','$kategori', '$harga', '$subtotal', 'BK-" . time() . "', '$tanggal')";
            if (mysqli_query($db, $insert_query)) {
                echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        window.onload = function() {
            Swal.fire({
                title: 'Berhasil!',
                text: 'Pembelian tiket berhasil!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = '../php/index.php';
            });
        }
    </script>";
            } else {
                echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        window.onload = function() {
            Swal.fire({
                title: 'Gagal!',
                text: 'Terjadi kesalahan saat menyimpan data: " . mysqli_error($db) . "',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    </script>";
            }
        }
    }
} else {
    echo "<script>alert('Form tidak disubmit dengan benar!');</script>";
}
