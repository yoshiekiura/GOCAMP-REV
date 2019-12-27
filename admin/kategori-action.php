<?php
include('./session.php');
include('../config/koneksi.php');

if (isset($_POST['action']) && $_POST['action']=="tambah" && isset($_POST['namakategori'])) {
    $namakategori = $_POST['namakategori'];
    $ambil = $koneksi->query("SELECT id_kategoriBarang FROM tbl_kategoribarang ORDER BY id_kategoriBarang DESC LIMIT 1");
    $pecah = $ambil->fetch_array();
    if (empty($pecah)) {
        $idkategori = "KTB001";
    } else {
        $pre_idkategori = $pecah['id_kategoriBarang'];
        $num_pre_idkategori = substr($pre_idkategori, 3);
        $input = (int) $num_pre_idkategori + 1;
        $idkategori = str_pad($input, 6, "KTB001", STR_PAD_LEFT);
    }
    $query = $koneksi->query("INSERT INTO tbl_kategoribarang VALUES('$idkategori','$namakategori')");
    if ($query) {
        $res['status'] = "sukses";
    } else {
        $res['status'] = "gagal";
    }
} else {
    $res['status'] = "gagal";
}
echo json_encode($res);