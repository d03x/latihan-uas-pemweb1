<?php session_start();

if (!isset($_SESSION['is_login']))
{
    header('location:./login.php');
    die();
}
require __DIR__ . "/../functions/functions.php";
require __DIR__ . "/../functions/statistik.php";

$uri = $app_path.$_SERVER['REQUEST_URI']
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
    <?php require __DIR__.'/_admin_navbar.php'?>
        <main class="main_page">
            <div class="statistik statistik_general">
                <div class="statistik_item">
                    <span>Total Product</span>
                    <span><?= getTotalProduct(); ?></span>
                </div>
                <div class="statistik_item">
                    <span>Total Transaksi</span>
                    <span><?= getTotalTransaksi(); ?></span>
                </div>
            </div>
            <h2>Stasistik Penjualan</h2>
            <div class="statistik statistik_penjualan">
                <div class="statistik_item">
                    <span>Transaksi Hari ini</span>
                    <span><?= transaksiHariIni()->jumlah_transaksi; ?></span>
                </div>
                <div class="statistik_item">
                    <span>Transaksi Bulan Ini</span>
                    <span><?= transaksiBulanIni()->jumlah_transaksi ?? 0; ?></span>
                </div>
                <div class="statistik_item">
                    <span>Penhasilan Hari Ini</span>
                    <span>Rp. <?= formatRupiah(transaksiHariIni()->total_transaksi ?? 0); ?></span>
                </div>
                <div class="statistik_item">
                    <span>Penghasilan Bulan Ini</span>
                    <span>Rp. <?= formatRupiah(transaksiBulanIni()->total_transaksi ?? 0); ?></span>
                </div>
            </div>
            <div class="" style="margin:20px 0px;">
                <div class="statistik">
                    <div class="statistik_item">
                        <span>Total Penghasilan</span>
                        <span>Rp. <?= formatRupiah(getTotalPenghasilan()) ?></span>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
