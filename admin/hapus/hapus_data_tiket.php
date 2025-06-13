<?php
include '../php/database.php';

$id = (int)$_GET['id'];

if (hapus_data_tiket($id) > 0) {
  echo "<script>
            alert('Data tiket berhasil dihapus!');
            document.location.href = '../php/manajemen tiket.php';
          </script>";
} else {
  echo "<script>
            alert('Gagal menghapus data tiket!');
            document.location.href = '../php/manajemen tiket.php';
          </script>";
}
