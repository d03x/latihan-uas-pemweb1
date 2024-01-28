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
          <a class="btn_new" href="product_new.php">Tambah Produk</a>
          <table border="1" class="table_produk">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Stok</th>
                <th>Price</th>
                <th>Category</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $products = getProduct();
              if($products->num_rows > 0){
                while($product = $products->fetch_object()){

                ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $product->product_name; ?></td>
                    <td><?= $product->stok ?></td>
                    <td>Rp.<?= formatRupiah($product->price) ?></td>
                    <td><?= $product->category ?></td>
                    <td>
                      <a href="./product_update.php?id=<?= $product->id ?>">Update</a>
                      <a onclick="return confirm('Apakah Anda yakin?')" href="./logic/product_delete.php?id=<?=$product->id ?>">Delete</a>

                    </td>
                  </tr>
                <?php
                }
              }
               ?>
            </tbody>
          </table>
        </main>
    </div>
</body>

</html>
