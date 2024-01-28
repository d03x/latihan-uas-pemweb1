<?php session_start();
require __DIR__ . "/../functions/functions.php";
require __DIR__ . "/../functions/statistik.php";

$uri = $app_path.$_SERVER['REQUEST_URI']
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <div class="admin_page">
        <?php require __DIR__.'/_admin_navbar.php'?>
        <main class="main_page">
            <h1 style="margin:20px 0px;">Add New Product</h1>
            <form method="POST" enctype="multipart/form-data" action="logic/product_insert.php" class="form_new_product">
               <div class="fields">
                    <div class="field">
                        <label for="product_name">Product Name</label>
                        <input type="text" name='product_name' required autocomplete placeholder="Ketikan Nama Produk Anda">
                    </div>
                    <div class="field">
                        <label for="price">Price</label>
                        <input type="number" name='price' required autocomplete placeholder="Ketikan harga Produk Anda">
                    </div>
                    <div class="field">
                        <label for="stok">stok</label>
                        <input type="number" name='Stok' required autocomplete placeholder="Ketikan Stok Produk Anda">
                    </div>
                    <div class="field">
                        <label for="category">stok</label>
                        <select name="category" id="">
                        <option disabled selected>--Pilih Kategori--</option>
                                <?php foreach(getCategory() as $value){
                                    ?>
                                    <option value="<?= $value ?>"><?= $value ?></option>
                                    <?php
                                } ?>
                        </select>
                    </div>
                    <div class="field">
                        <label for="image">Image</label>
                        <input class="input_file" type="file" name="image" id="image">
                    </div>
                            <div class="field">
                                <button name="save" class="btn_save" type="submit">Save</button>
                            </div>
               </div>
            </form>  
        </main>
    </div>
</body>

</html>
