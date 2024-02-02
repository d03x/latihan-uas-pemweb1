<?php require __DIR__ . "/functions/functions.php";

$kodeTransaksi = $_GET['trx'] ?? null;
if (!$kodeTransaksi) header('location:index.php');
$dataTransaksi = db()->query("SELECT * FROM transaksi WHERE kode_transaksi='{$kodeTransaksi}'")->fetch_assoc();

?>
<html>

<head>
    <title>Struk Pembayaran</title>
    <style>
        #tabel {
            font-size: 15px;
            border-collapse: collapse;
        }

        #tabel td {
            padding-left: 5px;
            border: 1px solid black;
        }
    </style>
</head>

<body style='font-family:tahoma; font-size:8pt;'>
    <center>
        <table style='width:350px; font-size:16pt; font-family:calibri; border-collapse: collapse;' border='0'>
            <td width='70%' align='CENTER' vertical-align:top'><span style='color:black;'>
                    <b>WARUNG DADAN HIDYAAT</b></br>JL Dunia</span></br>


                <span style='font-size:12pt'>No. : <?= $dataTransaksi['kode_transaksi'] ?>,
                    <?= $dataTransaksi['waktu_transaksi'] ?> </span></br>
            </td>
        </table>
        <style>
            hr {
                display: block;
                margin-top: 0.5em;
                margin-bottom: 0.5em;
                margin-left: auto;
                margin-right: auto;
                border-style: inset;
                border-width: 1px;
            }
        </style>
        <table cellspacing='0' cellpadding='0' style='width:350px; font-size:12pt; font-family:calibri;  border-collapse: collapse;' border='0'>

            <tr align='center'>
                <td>Item</td>
                <td>Price</td>
                <td>Qty</td>
                <td>@Total</td>
            <tr>
                <td colspan='5'>
                    <hr>
                </td>
            </tr>
            </tr>
            <?php
            $query = db()->query("SELECT  detail_transaksi.*,product.* FROM detail_transaksi INNER JOIN product ON product.id  = detail_transaksi.id_produk WHERE detail_transaksi.kode_transaksi='{$dataTransaksi['kode_transaksi']}'");
            $total_belanja = 0;
            while ($data = $query->fetch_assoc()) {
                $total_belanja += $data['total'];
            ?>
                <tr>
                    <td style='vertical-align:top'><?= $data['product_name'] ?></td>
                    <td style='vertical-align:top; text-align:right; padding-right:10px'>
                        Rp.<?= formatRupiah($data['price']) ?></td>
                    <td style='vertical-align:top; text-align:right; padding-right:10px'><?= $data['qty'] ?></td>
                    <td style='text-align:right; vertical-align:top'><?= "Rp." . formatRupiah($data['total']) ?></td>
                </tr>
            <?php
            }

            ?>
            <tr>
                <td colspan='5'>
                    <hr>
                </td>
            </tr>

            <tr>
                <td colspan='4'>
                    <div style='text-align:right; color:black'>Total : </div>
                </td>
                <td style='text-align:right; font-size:16pt; color:black'><?= 'Rp.' . formatRupiah($total_belanja) ?></td>
            </tr>
            <tr>
                <td colspan='4'>
                    <div style='text-align:right; color:black'>Cash : </div>
                </td>
                <td style='text-align:right; font-size:16pt; color:black'>
                    Rp.<?= formatRupiah($dataTransaksi['jumlah_bayar']) ?></td>
            </tr>
            <tr>
                <td colspan='4'>
                    <div style='text-align:right; color:black'>Change : </div>
                </td>
                <td style='text-align:right; font-size:16pt; color:black'>
                    Rp.<?= formatRupiah($dataTransaksi['kembalian']) ?></td>
            </tr>

        </table>
        <table style='width:350; font-size:12pt;' cellspacing='2'>
            <tr></br>
                <td align='center'>****** TERIMAKASIH ******</br></td>
            </tr>
        </table>
    </center>
</body>

</html>