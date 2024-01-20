<?php
require_once __DIR__."/db.php";
function bayar(int $jumlahBayar){
}
function getProducts(){
    $queryGetProduct = db()->query("SELECT * FROM product ORDER BY id ASC");
    return $queryGetProduct;
}
function formatRupiah(int $price){
    return number_format($price,2,',','.');
}
function getProductFromSession() : array{
    session_status()==PHP_SESSION_ACTIVE ?: session_start();
    $data = [];
    $db = db();
    foreach ( $_SESSION['carts'] ?? [] as $key => $qty )
    {
       if ( $qty['qty'] > 0 ){
        $row = $db->query("SELECT * FROM product WHERE id='{$key}'")->fetch_assoc();
        $data[$key] = $row;
        $data[$key]['qty'] = $qty['qty'];
       }
    }
    return $data;
}
function getSubtotalCart(){
    $subtotal = 0;
    foreach (getProductFromSession() as $value) {
        $subtotal += $value['qty'] * $value['price'];
    }
    return $subtotal;
}
function getStockProduct($productId){
    $query = db()->query("SELECT stok FROM product WHERE id='{$productId}'");
    return $query->fetch_object()->stok;
}
function addToCart($product_id){

$product_id = htmlentities($product_id);



if (!isset($_SESSION['carts'][$product_id]) ){
    $_SESSION['carts'][$product_id] = [
        'qty' => 1,
    ];
} else {
    //cek apakah session ada
    if (isset($_SESSION['carts'][$product_id]) ) {
        $_SESSION['carts'][$product_id]['qty']++;
    }
}
return true;
}

function getCartQtyById(int $id){
    session_status() === PHP_SESSION_ACTIVE ?: session_start();
    return $_SESSION['carts'][$id]['qty'] ?? 0;

}
function updateQtyFromCart($product_id, $current_qty, $type){
    session_status() === PHP_SESSION_ACTIVE ?: session_start();
    if( $type === 'plus' ){
        $qty = $current_qty + 1;
    } else{
        $qty = $current_qty -1;
    }
    if ( isset($_SESSION['carts'][$product_id]) ){
        $_SESSION['carts'][$product_id]['qty'] = $qty;
    }
    if ( $_SESSION['carts'][$product_id]['qty'] < 1){
        unset($_SESSION['carts'][$product_id]);
    }
}
