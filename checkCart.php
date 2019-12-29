<?php
if (!isset($_SESSION)) {
    session_start();
}
include('config/koneksi.php');
$res['status'] = "sukses";
if (isset($_POST['check']) && isset($_POST['idbarang'])) {
    $idbarang = $_POST['idbarang'];
    $ambil = $koneksi->query("SELECT FROm tbl_barang WHERE id_barang='$idbarang' AND stok_barang='0'");
    $count = mysqli_num_rows($ambil);
    if ($count > 0) {
        $res['status'] = "gagal";
    }
}
echo json_encode($res);
