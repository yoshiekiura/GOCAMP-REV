<?php
include('./session.php');
include('../config/koneksi.php');

if (isset($_GET['utm_source']) && $_GET['utm_source'] == "edit-transaksi" && isset($_GET['id_barang']) && isset($_GET['id_peminjaman']) && $_GET['return'] != "") {
    $Aid_barang = $_GET['id_barang'];
    $id_peminjaman = $_GET['id_peminjaman'];
    $return_url = base64_decode($_GET["return"]);
    $query = $koneksi->query("DELETE FROM tbl_detailpeminjaman WHERE id_peminjaman='$id_peminjaman' AND id_barang='$Aid_barang'");
    if ($query) {
        header('Location:' . $return_url . '?id=' . $id_peminjaman . '&status=deleted');
    } else {
        header('Location:' . $return_url . '?id=' . $id_peminjaman . '&status=gagal');
    }
}
//hapus barang di edit-transaksi.php

if (isset($_GET['utm_source']) && $_GET['utm_source'] == "transaksi" && isset($_GET['id_peminjaman']) && $_GET['return'] != "") {
    $id_peminjaman = $_GET['id_peminjaman'];
    $return_url = base64_decode($_GET["return"]);
    $query = $koneksi->query("DELETE FROM tbl_peminjaman WHERE id_peminjaman='$id_peminjaman'");
    if ($query) {
        $query = $koneksi->query("DELETE FROM tbl_detailpeminjaman WHERE id_peminjaman='$id_peminjaman'");
        if ($query) {
            header('Location:' . $return_url . '?status=deleted');
        } else {
            header('Location:' . $return_url . '?status=gagal');
        }
    } else {
        header('Location:' . $return_url . '?status=gagal');
    }
}
//hapus transaksi di transaksi.php

if (isset($_GET['utm_source']) && $_GET['utm_source'] == "barang" && isset($_GET['id_barang']) && $_GET['return'] != "") {
    $id_barang = $_GET['id_barang'];
    $return_url = base64_decode($_GET["return"]);
    $query = $koneksi->query("DELETE FROM tbl_barang WHERE id_barang='$id_barang'");
    if ($query) {
        header('Location:' . $return_url . '?status=deleted');
    } else {
        header('Location:' . $return_url . '?status=gagal');
    }
}
//hapus barang di barang.php

if (isset($_GET['utm_source']) && $_GET['utm_source'] == "kategori" && isset($_GET['id_kategori']) && $_GET['return'] != "") {
    $id_kategori = $_GET['id_kategori'];
    $return_url = base64_decode($_GET["return"]);
    $query = $koneksi->query("DELETE FROM tbl_kategoribarang WHERE id_kategoriBarang='$id_kategori'");
    if ($query) {
        header('Location:' . $return_url . '?status=deleted');
    } else {
        header('Location:' . $return_url . '?status=gagal');
    }
}

//hapus pelanggan di pelanggan.php

if (isset($_GET['utm_source']) && $_GET['utm_source'] == "pelanggan" && isset($_GET['id_pelanggan']) && $_GET['return'] != "") {
    $id_kategori = $_GET['id_pelanggan'];
    $return_url = base64_decode($_GET["return"]);
    $query = $koneksi->query("DELETE FROM tbl_user WHERE id_user='$id_kategori'");
    if ($query) {
        header('Location:' . $return_url . '?status=deleted');
    } else {
        header('Location:' . $return_url . '?status=gagal');
    }
}
