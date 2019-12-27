<?php
include('./session.php');
include('../config/koneksi.php');

if (isset($_GET['id_barang']) && isset($_GET['id_peminjaman']) && $_GET['return'] != "") {
    $Aid_barang = $_GET['id_barang'];
    $id_peminjaman = $_GET['id_peminjaman'];
    $return_url = base64_decode($_GET["return"]);
    $query = $koneksi->query("DELETE FROM tbl_detailpeminjaman WHERE id_peminjaman='$id_peminjaman' AND id_barang='$Aid_barang'");
    if ($query) {
        header('Location:' . $return_url . '&status=deleted');
    } else {
        header('Location:' . $return_url . '&status=gagal');
    }
}
