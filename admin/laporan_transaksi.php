<?php session_start();

if (!isset($_SESSION['is_login']))
{
    header('location:./login.php');
    die();
}
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
          <h1>Laporan Transaksi</h1>
        </main>
    </div>
</body>

</html>
