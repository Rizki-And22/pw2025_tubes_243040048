<?php
include '../php/database.php';

$id = (int)$_GET['id'];

if (hapus_data_lineup($id) > 0) {
    echo "<script>
            alert('Data lineup berhasil dihapus!');
            document.location.href = '../php/manajemen lineup.php';
          </script>";
} else {
    echo "<script>
            alert('Gagal menghapus data lineup!');
            document.location.href = '../php/manajemen lineup.php';
          </script>";
}
