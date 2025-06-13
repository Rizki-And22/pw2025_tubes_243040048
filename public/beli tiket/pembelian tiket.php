<?php
require_once '../../admin/php/database.php';
$query = "SELECT * FROM manajemen_tiket";
$result = mysqli_query($db, $query);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pembelian Tiket Lana Fest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #3a266a 0%, #6d4e9e 100%);
            min-height: 100vh;
        }

        .card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.18);
            background: #f8f7fa;
        }

        .card-header {
            background: linear-gradient(90deg, #4b2067 0%, #7b2ff2 100%);
            border-top-left-radius: 18px;
            border-top-right-radius: 18px;
        }

        .card-header h3 {
            font-weight: 700;
            letter-spacing: 1px;
        }

        .form-label {
            color: #4b2067;
            font-weight: 500;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            border: 1px solid #d1c4e9;
            background: #f3f0fa;
        }

        .btn-primary {
            background: linear-gradient(90deg, #4b2067 0%, #7b2ff2 100%);
            border: none;
            font-weight: 600;
            letter-spacing: 1px;
            border-radius: 10px;
        }

        .btn-primary:hover {
            background: linear-gradient(90deg, #7b2ff2 0%, #4b2067 100%);
        }

        .card-footer {
            background: transparent;
            color: #4b2067;
            font-weight: 500;
        }

        #harga_span,
        #subtotal_span {
            color: #4b2067;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6">
                <div class="card shadow-lg">
                    <div class="card-header text-white text-center">
                        <h3>Pembelian Tiket Lana Fest</h3>
                    </div>
                    <div class="card-body px-4 py-4">
                        <form action="proses_pembelian.php" method="POST" id="pembelian-form">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <div class="mb-3">
                                <label for="kontak" class="form-label">Kontak</label>
                                <input type="text" class="form-control" id="kontak" name="kontak" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="metode" class="form-label">Metode Pembayaran</label>
                                <select class="form-select" id="metode" name="metode" required>
                                    <option value="">-- Pilih Metode --</option>
                                    <option value="ditempat">Ditempat</option>
                                    <option value="online">Online</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori Tiket</label>
                                <select class="form-select" id="kategori" name="kategori" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    <?php
                                    $tiket = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                    foreach ($tiket as $t) {
                                        echo "<option value='{$t['ID_Tiket']}' data-harga='{$t['Harga']}'>{$t['Nama_Tiket']} - Rp{$t['Harga']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah" class="form-label">Jumlah Tiket</label>
                                <input type="number" class="form-control" id="jumlah" name="jumlah" min="1" max="10" value="1" required>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3 px-1">
                                <div>
                                    <span>Harga: <span id="harga_span">0</span></span>
                                    <input type="hidden" id="harga" name="harga" value="0">
                                </div>
                                <div>
                                    <span>Subtotal: <span id="subtotal_span">0</span></span>
                                    <input type="hidden" id="subtotal" name="subtotal" value="0">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100" id="submit-form" name="submit_form">Beli Tiket</button>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <small>&copy; 2024 Lana Fest</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#kategori').on('change', function() {
                const selectedOption = $('#kategori option:selected');
                const harga = parseInt(selectedOption.data('harga')) || 0;
                const jumlah = parseInt($('#jumlah').val()) || 1;

                $('#harga_span').text(`Rp ${harga}`);
                $('#subtotal_span').text(`Rp ${harga * jumlah}`);
                $('#harga').val(harga);
                $('#subtotal').val(harga * jumlah);
            });

            $('#jumlah').on('input', function() {
                const selectedOption = $('#kategori option:selected');
                const harga = parseInt(selectedOption.data('harga')) || 0;
                const jumlah = parseInt($('#jumlah').val()) || 1;

                $('#harga_span').text(`Rp ${harga}`);
                $('#subtotal_span').text(`Rp ${harga * jumlah}`);
                $('#harga').val(harga);
                $('#subtotal').val(harga * jumlah);
            });

            $('#submit-form').on('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: "Apa kamu yakin?",
                    text: "Yakin Membeli Tiket ini?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#7b2ff2",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, Beli!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#pembelian-form').submit();
                    }
                });
            });
        });
    </script>
</body>

</html>