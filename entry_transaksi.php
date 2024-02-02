<?php
require_once __DIR__ . "/functions/functions.php";
$products = getProducts();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir Warung Kelontong</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <!-- <nav class="cart_header">
        <h2>DADAN MART</h2>
        <p>
            Jln. Bandung No23, Dusun Pangersa
        </p>
    </nav> -->
    <div class="kasir">
        <div class="kasir_left">
            <span class="barang_lists_title">Warung Jaya Berkah</span>
            <div class="produk_lists">
                <?php while ($product = $products->fetch_object()) { ?>
                    <div class="produk_list">
                        <img width="100%" src="uploads/<?= $product->product_image ?? '' ?>">
                        <div class="produk_list_footer">
                            <span><?= $product->product_name ?> - <small>(<?= $product->category ?>)</small></span>
                            <span><b>Stok:</b>&nbsp;<?= $product->stok ?></span>
                            <?php if (($qty = getCartQtyById($product->id)) > 0) { ?>
                                <form class="cart_button_change_qty" action="logic/change_qty_cart_item.php" method="POST">
                                    <input type="text" hidden name="product_id" value="<?= $product->id ?>">
                                    <input type="submit" name="min" value="-">
                                    <input type="text" readonly name="current_qty" value="<?= $qty ?>">
                                    <input type="submit" name="plus" value="+">
                                </form>
                            <?php } ?>
                            <span class="price">Rp.<?= formatRupiah($product->price) ?></span>
                            <?php if ($product->stok > 0) { ?>

                                <a href="logic/add_to_cart.php?product_id=<?= $product->id ?>" class="btn_add">Add</a>
                            <?php } else { ?>
                                <span style="color:red;text-align:left;font-weight:bold;">Produk Habis😣</span>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="kasir_right">
            <div class="cart">
                <div class="cart_main">
                    <div class="cart_main_top">
                        <span>Total:</span>
                        <span class="cart_total_belanja">Rp. <?= formatRupiah(getSubtotalCart()) ?></span>
                    </div>
                </div>
                <div class="cart_main_header">
                    <span>Barang</span>
                </div>
                <div class="cart_product_lists">
                    <table border="1">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Produk</th>
                                <th>Qty</th>
                                <th>@total</th>
                                <th>Act</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $data = getProductFromSession();
                            if (count($data) > 0) { ?>

                                <?php foreach ($data as $value) { ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $value['product_name'] ?></td>
                                        <td><?= $value['qty'] ?></td>
                                        <td>Rp.<?= formatRupiah($value['price'] * $value['qty']) ?></td>
                                        <td><a onclick="return confirm('Apakah anda yakin ingin menghapus dari cart?');" href="logic/delete_item_from_cart.php?id=<?= $value['id'] ?>">❌</a></td>
                                    </tr>

                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="6">Belum Ada barang!</td>
                                </tr>
                            <?php  } ?>

                        </tbody>
                    </table>
                </div>
                <div class="cart_footer">
                    <?php if (isset($_SESSION['carts']) && count($_SESSION['carts']) > 0) { ?>
                        <form class="form_bayar" action="bayar.php" method="POST">
                            <span>Rp</span>
                            <input placeholder="Masukan Jumlah Bayar" name="jumlah_bayar" type="text" class="jumlah_bayar">
                            <button name="btn_bayar">Bayar</button>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>