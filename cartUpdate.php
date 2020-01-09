<?php
if (!isset($_SESSION)) {
    session_start();
}
include('config/koneksi.php');
$return_url = base64_decode($_GET["return_url"]);
if (empty($return_url)) {
    header('Location: ./');
}
if (isset($_GET['addCart']) && isset($_GET["return_url"])) {
    $Aid_barang = $_GET['addCart'];
    $id_user = $_SESSION['id_login'];
    $ambil = $koneksi->query("SELECT * FROM tbl_barang WHERE id_barang='" . $Aid_barang . "' AND stok_barang>'0'") or die("Last error: {$koneksi->error}\n");
    $rowcount = mysqli_num_rows($ambil);

    if ($rowcount > 0) {
        if (!isset($_SESSION['id_login'])) {
            if (isset($_SESSION['cart'][$Aid_barang])) {
                if (isset($_GET['qty'])) {
                    $_SESSION['cart'][$Aid_barang] += $_GET['qty'];
                } else {
                    $_SESSION['cart'][$Aid_barang] += 1;
                }
            } else {
                if (isset($_GET['qty'])) {
                    $_SESSION['cart'][$Aid_barang] += $_GET['qty'];
                } else {
                    $_SESSION['cart'][$Aid_barang] = 1;
                }
            }
        } else {
            if (isset($_GET['qty'])) {
                $jumlah = $_GET['qty'];
            } else {
                $jumlah = 1;
            }
            $ambilCart = $koneksi->query("SELECT * FROM tbl_cart WHERE id_barang='" . $Aid_barang . "' AND id_user='".$id_user."'") or die("Last error: {$koneksi->error}\n");
            $rowcountCart = mysqli_num_rows($ambilCart);
            if ($rowcountCart > 0) {
                $koneksi->query("UPDATE tbl_cart SET jumlah_cart=jumlah_cart+'" . $jumlah . "' WHERE id_barang='" . $Aid_barang . "'") or die("Last error: {$koneksi->error}\n");
            } else {
                $koneksi->query("INSERT INTO tbl_cart VALUES('$id_user','$Aid_barang','$jumlah')") or die("Last error: {$koneksi->error}\n");
            }
        }
    }
} else {
    $Rid_barang = $_GET['hapuscart'];
    if (isset($_GET["hapuscart"]) && isset($_GET["return_url"])) {
        if(!isset($_SESSION['id_login'])){
            unset($_SESSION["cart"][$Rid_barang]);
        }
        if(isset($_SESSION['id_login'])){
            $koneksi->query("DELETE FROM tbl_cart WHERE id_barang='".$Rid_barang."'") or die("Last error: {$koneksi->error}\n");
        }
    }
}
header('Location:' . $return_url);
