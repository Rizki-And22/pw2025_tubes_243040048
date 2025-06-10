<?php
include '../php/database.php';

$id = (int)$_GET['id'];

if (hapus_data_event($id) > 0) {
    echo "<script>
            alert('Data event berhasil dihapus!');
            document.location.href = '../php/manajemen event.php';
          </script>";
} else {
    echo "<script>
            alert('Gagal menghapus data event!');
            document.location.href = '../php/manajemen event.php';
          </script>";
}
