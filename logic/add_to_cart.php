<?php require __DIR__."/../functions/functions.php";
session_start();
if ( getStockProduct($_GET['product_id']) < 1  )
{
   die("Stok Habis");
}
$a = addToCart($_GET['product_id']);

header('location:../entry_transaksi.php');
