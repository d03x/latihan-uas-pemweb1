<?php
require __DIR__ . "/../../functions/functions.php";
if (isset($_POST['save'])) {
    $db = db();
    // var_dump($_FILES);
    foreach ($_POST as $key => $value) {
        $$key = $db->escape_string($value);
    }

    $image = $_FILES['image'] ?? null;
    $uploadPath = 'images/';
    $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
    if ($image) {
        $product_image = $uploadPath . md5(rand()) . "." . $extension;
    } else {
        $product_image = null;
    }

  

    if (in_array(strtolower($extension), ['jpg','jpeg','png','webp']) && insertProduct($product_name, $price, $Stok, $category, $product_image)) {
        if ($image['size'] >= (1024 * 5)) {
            $uploadPath = __DIR__ . "/../../uploads";
            @move_uploaded_file($image['tmp_name'], $uploadPath . "/" . $product_image);
        }
        header('location:../product.php');
    } else {
        header('location:../product.php?insert=false');
    }
}
