<?php require_once __DIR__."/../functions/functions.php";
if ( isset($_POST['min']) ){
    updateQtyFromCart($_POST['product_id'],$_POST['current_qty'],'min');
}
if ( isset($_POST['plus']) ){
    if ( getStockProduct($_POST['product_id']) <= getCartQtyById($_POST['product_id'])  ){
        echo "<script>alert('Qty melebihi jumlah stok yang ada!!');window.location.href='../entry_transaksi.php'</script>";
        die;
    }else{
        updateQtyFromCart($_POST['product_id'],$_POST['current_qty'],'plus');
    }
}
header('location:../entry_transaksi.php');
