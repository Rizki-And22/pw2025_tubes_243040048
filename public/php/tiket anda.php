<?php
session_start();
require_once('../../lib/TCPDF-main/tcpdf.php');
require_once('../../admin/php/database.php');

$id = $_GET['id'];
// if ($id == null) {
//     # code...
// }

$stmt = mysqli_prepare($db, "SELECT penjualan_tiket.*, manajemen_event.Nama_Event FROM penjualan_tiket LEFT JOIN manajemen_event ON penjualan_tiket.ID_Event = manajemen_event.ID_Event WHERE penjualan_tiket.id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
if (!$result) {
    die("Query gagal: " . mysqli_error($db));
}
$data = mysqli_fetch_assoc($result);
if (!$data) {
    die("Data tidak ditemukan.");
}

// Buat objek PDF
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('Tiket Konser');
$pdf->AddPage();

// Tambahkan gaya dan konten bertema konser modern
$html = '
<style>
    .ticket-container {
    background-color: purple;
    color: #f2e9e4;
    padding: 32px 28px;
    width: 420px;
    margin: 0 auto;
    font-family: Arial, Helvetica, sans-serif;
    border: 2px solid #ffbe0b;
}

.ticket-info {
    font-size: 16px;
    margin-top: 12px;
    margin-bottom: 22px;
    background-color: rgb(74,78,105);
    padding: 16px 12px;
    border: 1px solid #333;
}

    .concert-name {
        font-size: 30px;
        font-weight: bold;
        color: #ffbe0b;
        letter-spacing: 2.5px;
        margin-bottom: 20px;
        text-shadow: 2px 2px 8px #3a3a5a;
        text-align: center;
    }
   
    .ticket-info p {
        margin: 8px 0;
        line-height: 1.5;
    }
    .barcode {
        font-size: 26px;
        font-weight: bold;
        letter-spacing: 6px;
        margin-top: 28px;
        color: #f2e9e4;
        background: #22223b;
        padding: 12px 0;
        border-radius: 8px;
        border: 2.5px dashed #ffbe0b;
        width: 85%;
        margin-left: auto;
        margin-right: auto;
        text-align: center;
    }
</style>

<div class="ticket-container">
    <div class="concert-name">Lana Fest</div>
    <div class="ticket-info">
        <p><strong>Nama:</strong> ' . htmlspecialchars($data['nama_pemesan']) . '</p>
        <p><strong>Kode Booking:</strong> ' . htmlspecialchars($data['kode_booking']) . '</p>
        <p><strong>Tanggal Pembelian:</strong> ' . date('d F Y', strtotime($data['tanggal'])) .  '</p>
        <p><strong>Event:</strong> ' . htmlspecialchars($data['Nama_Event']) . '</p>
        <p><strong>Jumlah:</strong> ' . htmlspecialchars($data['jumlah_tiket']) . '</p>
    </div>
    <div class="barcode">|| ||| | ||| ||| ||</div>
</div>
';

// Tambahkan HTML ke PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Simpan atau tampilkan PDF
$pdf->Output('tiket_konser.pdf', 'D');
