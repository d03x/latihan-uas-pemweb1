<?php
require __DIR__ . "/../../functions/functions.php";
if (isset($_POST['save'])) {
    $id = strip_tags($_GET['id'] ?? null);
    if(!$id){
        header('location:../product.php');die();
    }
    $db = db();
    // var_dump($_FILES);
    foreach ($_POST as $key => $value) {
        $$key = $db->escape_string($value);
    }

    //gambar sekarang 
    
    $image = $_FILES['image'] ?? null;
    $uploadPath = 'images/';
    $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
   
    if ($image && $image['error']!=4) {
        $product_image = $uploadPath . md5(rand()) . "." . $extension;
    } else {
        $product_image = $db->query("SELECT product_image FROM product WHERE id='$id'")->fetch_object()->product_image;
    }
    // in_array(strtolower($extension), ['jpg','jpeg','png','webp'])
  

    if ( updateProduct($product_name, $price, $Stok, $category, $product_image,$id)) {
        if ($image['size'] >= (1024 * 5)) {
            $uploadPath = __DIR__ . "/../../uploads";
            @move_uploaded_file($image['tmp_name'], $uploadPath . "/" . $product_image);
        }
        header('location:../product.php');
    } else {
        header('location:../product.php?insert=false');
    }
}
