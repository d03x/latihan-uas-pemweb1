<?php session_start();
$product_id = $_GET['id'];
if(isset($_SESSION['carts'][$product_id]))
{
    unset($_SESSION['carts'][$product_id]);
    echo "<script>alert('Produk Berhasil di hapus dari cart!');window.location.href='../entry_transaksi.php'</script>";

}
