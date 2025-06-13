<?php
$db = mysqli_connect('localhost', 'root', '', 'web_tiket');

function select($query)
{
    global $db;
    $result = mysqli_query($db, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// ubah data event

function ubah_data_event($data)
{
    global $db;
    $ID_Event = $data['ID_Event'];
    $Nama_Event = $data['Nama_Event'];
    $Tanggal = $data['Tanggal'];
    $Waktu = $data['Waktu'];
    $Lokasi = $data['Lokasi'];
    $Kapasitas = $data['Kapasitas'];
    $Status = $data['Status'];
    $query = "UPDATE manajemen_event SET  Nama_Event = '$Nama_Event', Tanggal = '$Tanggal', Waktu = '$Waktu', Lokasi = '$Lokasi', Kapasitas ='$Kapasitas', Status = '$Status' WHERE ID_Event = '$ID_Event'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// ubah data tiket
function ubah_data_tiket($data)
{
    global $db;
    $ID_TIket = $data['ID_Tiket'];
    $Nama_Tiket = $data['Nama_Tiket'];
    $deskripsi = $data['deskripsi'];
    $harga = $data['Harga'];
    $kuota = $data['Kuota'];
    $kode_promo = $data['Kode_Promo'];
    $tanggal_berlaku = $data['Tanggal_Berlaku'];
    $Status = $data['Status'];
    $query = "UPDATE manajemen_tiket SET  Nama_Tiket = '$Nama_Tiket', deskripsi = '$deskripsi', Harga = '$harga', kuota = '$kuota', Kode_Promo = '$kode_promo', Tanggal_Berlaku ='$tanggal_berlaku', Status = '$Status' WHERE ID_Tiket = '$ID_TIket'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// ubah data lineup
function ubah_data_lineup($data)
{
    global $db;
    $ID_Lineup = mysqli_real_escape_string($db, $data['ID_Lineup']);
    $band = mysqli_real_escape_string($db, $data['nama_band']);
    $waktu = mysqli_real_escape_string($db, $data['waktu']);
    $stage = mysqli_real_escape_string($db, $data['stage']);
    $ID_Event = mysqli_real_escape_string($db, $data['genre']);

    $foto = $_FILES['foto'];
    $foto_nama_baru = null;

    if (!empty($foto['name'])) {
        $target_dir = "../../uploads/lineup/";
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $file_ext = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION));

        if (in_array($file_ext, $allowed_extensions)) {
            $foto_nama_baru = uniqid('lineup_', true) . '.' . $file_ext;
            $target_file = $target_dir . $foto_nama_baru;

            if (!move_uploaded_file($foto['tmp_name'], $target_file)) {
                return 0;
            }
        } else {
            return 0;
        }
    }

    if ($foto_nama_baru) {
        $query = "UPDATE lineup SET band = '$band', foto = '$foto_nama_baru', waktu = '$waktu', stage = '$stage', ID_Event = '$ID_Event' WHERE id = '$ID_Lineup'";
    } else {
        $query = "UPDATE lineup SET band = '$band', waktu = '$waktu', stage = '$stage', ID_Event = '$ID_Event' WHERE id = '$ID_Lineup'";
    }

    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}


// hapus data event
function hapus_data_event($id)
{
    global $db;
    $query = "DELETE FROM manajemen_event WHERE ID_Event = '$id'";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// hapus data tiket
function hapus_data_tiket($id)
{
    global $db;
    $query = "DELETE FROM manajemen_tiket WHERE ID_Tiket = '$id'";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// hapus data regist
function hapus_data_regist($id)
{
    global $db;
    $query = "DELETE FROM regist WHERE ID_Regist = '$id'";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function hapus_data_lineup($id)
{
    global $db;
    $query = "DELETE FROM lineup WHERE id = '$id'";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}
