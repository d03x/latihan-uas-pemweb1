<?php  require_once __DIR__."../../../functions/functions.php";

if ( isset($_GET['id']) )
{
    $id = strip_tags(htmlspecialchars($_GET['id']));
    $file_image = db()->query("SELECT product_image FROM product WHERE id='$id' LIMIT 1")->fetch_object()->product_image;
    
    if ( db()->query("DELETE FROM product WHERE id='$id'") ) {
        if(file_exists($upload_file = __DIR__ . "/../../uploads/".$file_image)) {
            @unlink($upload_file);
        }
        header('location:../product.php');
    }
} else {
    header('location:../product.php');
}