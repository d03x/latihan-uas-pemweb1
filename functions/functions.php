<?php
require_once __DIR__ . "/db.php";
function bayar(int $jumlahBayar)
{
}
function getProducts()
{
    $queryGetProduct = db()->query("SELECT * FROM product ORDER BY id ASC");
    return $queryGetProduct;
}
function formatRupiah(?int $price = 0)
{
    return number_format($price, 2, ',', '.');
}
function getProductFromSession(): array
{
    session_status() == PHP_SESSION_ACTIVE ?: session_start();
    $data = [];
    $db = db();
    foreach ($_SESSION['carts'] ?? [] as $key => $qty) {
        if ($qty['qty'] > 0) {
            $row = $db->query("SELECT * FROM product WHERE id='{$key}'")->fetch_assoc();
            $data[$key] = $row;
            $data[$key]['qty'] = $qty['qty'];
        }
    }
    return $data;
}
function getSubtotalCart()
{
    $subtotal = 0;
    foreach (getProductFromSession() as $value) {
        $subtotal += $value['qty'] * $value['price'];
    }
    return $subtotal;
}
function getStockProduct($productId)
{
    $query = db()->query("SELECT stok FROM product WHERE id='{$productId}'");
    return $query->fetch_object()->stok;
}
function addToCart($product_id)
{

    $product_id = htmlentities($product_id);



    if (!isset($_SESSION['carts'][$product_id])) {
        $_SESSION['carts'][$product_id] = [
            'qty' => 1,
        ];
    } else {
        //cek apakah session ada
        if (isset($_SESSION['carts'][$product_id])) {
            $_SESSION['carts'][$product_id]['qty']++;
        }
    }
    return true;
}

function getCartQtyById(int $id)
{
    session_status() === PHP_SESSION_ACTIVE ?: session_start();
    return $_SESSION['carts'][$id]['qty'] ?? 0;
}
function updateQtyFromCart($product_id, $current_qty, $type)
{
    session_status() === PHP_SESSION_ACTIVE ?: session_start();
    if ($type === 'plus') {
        $qty = $current_qty + 1;
    } else {
        $qty = $current_qty - 1;
    }
    if (isset($_SESSION['carts'][$product_id])) {
        $_SESSION['carts'][$product_id]['qty'] = $qty;
    }
    if ($_SESSION['carts'][$product_id]['qty'] < 1) {
        unset($_SESSION['carts'][$product_id]);
    }
}
function getProduct($value = '')
{
    $db = db();
    $queryGetProduct = $db->query("SELECT * FROM product");
    return $queryGetProduct;
}

function getCategory()
{
    return   [
        "Elektronik", "Pakaian", "Perlengkapan Rumah", "Kesehatan dan Kecantikan", "Olahraga dan Aktivitas Luar",
        "Mainan dan Games", "Makanan dan Minuman", "Alat Tulis dan Perlengkapan Kantor", "Buku dan Majalah", "Alat-alat Musik",
        "Alat-alat Rumah Tangga", "Perhiasan dan Aksesoris", "Kendaraan dan Aksesoris", "Alat-alat Tukang", "Komputer dan Aksesoris",
        "Perawatan Hewan Peliharaan", "Kamera dan Aksesoris", "Alat-alat Dapur", "Perabotan Rumah Tangga", "Peralatan Olahraga",
        "Film dan Musik", "Peralatan Kecantikan", "Sepatu", "Tas dan Koper", "Produk Kesehatan",
        "Produk Kesejahteraan", "Perangkat Lunak", "Produk Perawatan Bayi", "Pakaian Bayi", "Produk Pendidikan",
        "Alat-alat Seni dan Kerajinan", "Produk Outdoor", "Produk Travel", "Produk Fashion", "Produk Gaya Hidup",
        "Produk Elektronik Rumah Tangga", "Peralatan Pertukangan", "Pakaian Dalam dan Pajama", "Produk Gaming", "Produk Desain Interior",
        "Peralatan Camping", "Produk Seni dan Desain", "Peralatan Musik Elektronik", "Produk Pesta", "Peralatan Bercocok Tanam",
        "Produk Teknologi", "Alat-alat Fotografi", "Produk Keamanan", "Produk Kebersihan", "Produk Hobi",
    ];
}

function insertProduct($product_name, $price, $Stok, $category,$product_image)
{
    $db = db();
    $query = $db->query("INSERT INTO `product`(`product_name`,`price`,`stok`,`category`,`product_image`) VALUES ('$product_name','$price','$Stok','$category','$product_image')");
    return $query;
}
function updateProduct($product_name, $price, $stok, $category,$product_image,$id)
{
    $db = db();
    $query = $db->query("UPDATE product SET product_name='$product_name',price='$price',stok='$stok',category='$category',product_image='$product_image' WHERE id='$id'");
    return $query;
}
