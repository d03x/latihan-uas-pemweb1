<?php session_start();

include __DIR__."/functions/functions.php";
if ( isset($_SESSION['carts']) && isset($_POST['btn_bayar']))
{
    $jumlahBayar = (int) $_POST['jumlah_bayar'] ?? 0;
    if ( $jumlahBayar < getSubtotalCart() ){
        $kurangNya = formatRupiah( getSubtotalCart() - $jumlahBayar);
        die("<script>alert('jumlah bayar kurang {$kurangNya}');location.href='entry_transaksi.php'</script>");
    }

    $produk = getProductFromSession();
    //insert ke tabel transaksi

    $tanggal = date('Y-m-d h:i:s');
    $kembalian = $jumlahBayar - getSubtotalCart();
    $kodeTransaksi = strtoupper("TRX".date('Y').uniqid());
    $db = db();
    $db->begin_transaction();
    $queryTrx = $db->query("INSERT INTO transaksi (kode_transaksi,waktu_transaksi,jumlah_bayar,kembalian) VALUES('$kodeTransaksi','$tanggal','$jumlahBayar','$kembalian')");

    try {
       foreach ($produk as  $value) {
        $total =($value['price'] * $value['qty']);
            $db->query("INSERT INTO detail_transaksi (kode_transaksi,id_produk,qty,total) VALUES('$kodeTransaksi','{$value['id']}','{$value['qty']}','{$total}')");
            $db->query("UPDATE `product` SET `stok`=stok-$value[qty] WHERE id='$value[id]';");
       }
       $db->commit();
       unset($_SESSION['carts']);
       header('location:cetak_struk.php?trx='.$kodeTransaksi);
    } catch (mysqli_sql_exception $th) {
     $db->rollback();
     die("<script>alert('Transaksi Gagal!');location.href='entry_transaksi.php'</script>");
    }

}
?>
