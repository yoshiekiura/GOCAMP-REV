<?php
include('./session.php');
include('../config/koneksi.php');
$res['status'] = "gagal";
if (isset($_POST['simpan']) && isset($_POST['namabarang']) && isset($_POST['deskripsibarang']) && isset($_POST['kategoribarang']) && isset($_POST['hargabarang']) && isset($_POST['stokbarang']) && isset($_POST['idbarang'])) {
    $idbarang = $_POST['idbarang'];
    $namabarang = $_POST['namabarang'];
    $deskripsibarang = $_POST['deskripsibarang'];
    $kategoribarang = $_POST['kategoribarang'];
    $hargabarang = $_POST['hargabarang'];
    $stokbarang = $_POST['stokbarang'];
    $query = $koneksi->query("UPDATE tbl_barang SET nama_barang='$namabarang',deskripsi_barang='$deskripsibarang',id_kategoriBarang='$kategoribarang',harga_barang='$hargabarang',stok_barang='$stokbarang' WHERE id_barang='$idbarang'");
    if ($query) {
        $res['status'] = "sukses";
    }
}
echo json_encode($res);
