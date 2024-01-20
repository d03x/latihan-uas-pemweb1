<?php

function db(){
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'db_pos_uas';
    try {
        $konek = new mysqli($host,$user,$password,$database);
        return $konek;
    } catch (\Throwable $th) {
        die($th->getMessage());
    }
}
