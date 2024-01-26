<?php

require_once __DIR__ . "/db.php";

function getTotalTransaksi()
{
    $db = db();
    return $db->query("SELECT count(kode_transaksi) total_transaksi FROM transaksi")->fetch_object()->total_transaksi;
}

function getTotalProduct()
{

    $db = db();
    return $db->query("SELECT count(id) total_product FROM product")->fetch_object()->total_product;
}

function transaksiHariIni()
{
    $db = db();
    $now = $db->query("SELECT COUNT( DISTINCT tr.kode_transaksi) jumlah_transaksi, SUM(dt.total) total_transaksi FROM transaksi tr  JOIN detail_transaksi dt USING(kode_transaksi) WHERE DATE(tr.waktu_transaksi) >= DATE(CURRENT_DATE())")->fetch_object();

    return $now;
}
function transaksiBulanIni()
{
    $db = db();
    $now = $db->query("SELECT COUNT( DISTINCT tr.kode_transaksi) jumlah_transaksi, SUM(dt.total) total_transaksi FROM transaksi tr  JOIN detail_transaksi dt USING(kode_transaksi) WHERE MONTH(waktu_transaksi) = MONTH(CURRENT_DATE())")->fetch_object();
    return $now;
}

function getTotalPenghasilan(){
    return db()->query("SELECT SUM(total) total_transaksi FROM detail_transaksi")->fetch_object()->total_transaksi;
}
