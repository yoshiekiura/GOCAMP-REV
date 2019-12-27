<?php
include('./session.php');
include('../config/koneksi.php');

if (isset($_POST['id_barang']) && isset($_POST['tipe'])) {
    $Aid_barang = $_POST['id_barang'];
    if ($_POST['tipe'] == "add") {
        $ambil = $koneksi->query("SELECT * FROM tbl_barang WHERE id_barang='" . $Aid_barang . "'") or die("Last error: {$koneksi->error}\n");
        $rowcount = mysqli_num_rows($ambil);
        if ($rowcount > 0) {
            if (isset($_SESSION['paketbarang'][$Aid_barang])) {
                $_SESSION['paketbarang'][$Aid_barang] += 1;
            } else {
                $_SESSION['paketbarang'][$Aid_barang] = 1;
            }
        } else {
            return false;
        }
    } else if ($_POST['tipe'] == "hapus") {
        unset($_SESSION["paketbarang"][$Aid_barang]);
    }
}
if ($_POST['tipe'] == "reset") {
    unset($_SESSION["paketbarang"]);
}
if (isset($_POST['submit'])) {
    $ekstensi_diperbolehkan    = array('png', 'jpg');
    $nama_file = $_FILES['fotoBarang']['name'];
    $x = explode('.', $nama_file);
    $ekstensi = strtolower(end($x));
    $ukuran    = $_FILES['fotoBarang']['size'];
    $file_tmp = $_FILES['fotoBarang']['tmp_name'];
    $id_kategoriBarang = $_POST['kategoriPaket'];
    $nama_barang = $_POST['namaPaket'];
    $deskripsi_barang = $_POST['deskripsiPaket'];
    $harga_barang = $_POST['hargaPaket'];
    $stok_barang = $_POST['stokPaket'];
    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        if ($ukuran < 104407000) {
            move_uploaded_file($file_tmp, '../img/' . $nama_file);
            $ambil = $koneksi->query("SELECT id_kategoriBarang FROM tbl_kategoriBarang WHERE nama_kategoriBarang='$id_kategoriBarang'");
            $pecah = $ambil->fetch_array();
            $id_kategoriBarang = $pecah['id_kategoriBarang'];
            $ambil = $koneksi->query("SELECT id_barang FROM tbl_barang ORDER BY id_barang DESC LIMIT 1");
            $pecah = $ambil->fetch_array();
            if (empty($pecah)) {
                $idPaket = "BRG001";
            } else {
                $pre_idBarang = $pecah['id_barang'];
                $num_pre_idBarang = substr($pre_idBarang, 3);
                $input = (int) $num_pre_idBarang + 1;
                $idPaket = str_pad($input, 6, "BRG001", STR_PAD_LEFT);
            }
            $hitungCart = count($_SESSION['paketbarang']);
            if ($hitungCart > 0) {
                $query = $koneksi->query("INSERT INTO tbl_barang(id_barang, id_kategoriBarang, nama_barang, deskripsi_barang, harga_barang, stok_barang, foto_barang) VALUES('$idBarang','$id_kategoriBarang','$nama_barang','$deskripsi_barang','$harga_barang','$stok_barang','$nama_file' )") or die("Last error: {$koneksi->error}\n");
                if ($query) {
                    header("location: ./paket-barang.php?status=berhasil");
                } else {
                    header("location: ./paket-barang.php?status=gagal");
                }
                foreach ($_SESSION['paketbarang'] as $id_barang => $jumlah) {
                    $query = $koneksi->query("INSERT INTO tbl_paketbarang VALUES('$idPaket','$id_barang','$jumlah')") or die("Last error: {$koneksi->error}\n");
                    if ($query) {
                        header("location: ./paket-barang.php?status=berhasil");
                    } else {
                        header("location: ./paket-barang.php?status=gagal");
                    }
                }
                unset($_SESSION["paketbarang"]);
                header('Location: ./paket-barang.php?status=berhasil');
            } else {
                unset($_SESSION["paketbarang"]);
                header('Location: ./paket-barang.php?status=gagal');
            }
        } else {
            header("location: tambah-barang.php?status=filesize");
        }
    } else {
        header("location: tambah-barang.php?status=ekstensi");
    }
}
