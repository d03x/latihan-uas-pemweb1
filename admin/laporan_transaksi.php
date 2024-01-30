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
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <div class="admin_page">
        <?php require __DIR__ . '/_admin_navbar.php' ?>
        <main class="main_page">
            <h1>Laporan Transaksi</h1>
            <table id='table' border='1' width="100%" style="text-align:center;">
                <thead>
                    <tr>
                        <th>Kode Transaksi</th>
                        <th>Tanggal Transaksi</th>
                        <th>Total Belanja</th>
                        <th>Action</th>
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
                                <td>
                                    <a href="javascript:void()">Detail</a>
                                    <!-- <a href="./cetak_laporan_transaksi.php?trx=<?= $row->kode_transaksi ?>">Cetak</a> -->
                                </td>
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
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </main>
    </div>
</body>

</html>