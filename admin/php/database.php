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
