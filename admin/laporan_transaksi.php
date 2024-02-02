<?php session_start();

if (!isset($_SESSION['is_login'])) {
    header('location:./login.php');
    die();
}
require __DIR__ . "/../functions/functions.php";
require __DIR__ . "/../functions/statistik.php";

$uri = $app_path . $_SERVER['REQUEST_URI'];
$db = db();
$laporanTransaksi = $db->query("SELECT transaksi.*,
(SELECT SUM(total) 
FROM detail_transaksi 
WHERE kode_transaksi=transaksi.kode_transaksi) total 
FROM transaksi");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <style>
        table{
            margin: 10px 0px;
            border-collapse: collapse;
        }
        table th{
            background-color: red;
            color: white;
            height: 28px;
        }
        table td{
            height: 25px;
        }
     </style>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <div class="admin_page">
        <?php require __DIR__ . '/_admin_navbar.php' ?>
        <main class="main_page">
            <h1>Riwayat & Laporan Transaksi</h1>
            <table id='table' border='1' width="100%" style="text-align:center;">
                <thead>
                    <tr>
                        <th>Kode Transaksi</th>
                        <th>Tanggal Transaksi</th>
                        <th>Total Belanja</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $subtotal = 0;
                    if ($laporanTransaksi->num_rows > 0) {
                        while ($row = $laporanTransaksi->fetch_object()) {
                            $subtotal += $row->total;
                    ?>
                            <tr>
                                <td><?= $row->kode_transaksi ?></td>
                                <td><?= $row->waktu_transaksi ?></td>
                                <td>Rp.<?= formatRupiah($row->total) ?></td>
                                
                            </tr>

                    <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="4">Tidak Ada Transaksi</td>
                        </tr><?php
                    } ?>
                    <tr>
                        <td colspan="2">Subtotal:</td>
                        <td>Rp.<?= formatRupiah($subtotal) ?></td>
                    </tr>
                </tbody>
            </table>
        </main>
    </div>
</body>

</html>