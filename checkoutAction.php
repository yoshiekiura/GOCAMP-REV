<?php
include('config/koneksi.php');
if (isset($_GET["return_url"]) && isset($_GET["tanggal_pinjam"]) && isset($_GET["durasi_pinjam"]) && isset($_GET["metode_pembayaran"]) && isset($_GET["subTotal"])) {
    $return_url = base64_decode($_GET["return_url"]);
    $tanggalTransaksi = date("Y-m-d");
    $tanggalPinjam = $_GET['tanggal_pinjam'];
    $durasiPinjam = $_GET['durasi_pinjam'];
    $metodePembayaran = $_GET['metode_pembayaran'];
    $TotalBarang = $_GET['subTotal'];
    $subTotal = $TotalBarang * $durasiPinjam;
    if ($tanggalPinjam < $tanggalTransaksi) {
        header('Location:' . $return_url);
    }

    $ambilPeminjaman = $koneksi->query("SELECT id_peminjaman FROM tbl_peminjaman ORDER BY id_peminjaman DESC LIMIT 1") or die("Last error: {$koneksi->error}\n");
    $pecahPeminjaman = $ambilPeminjaman->fetch_array();
    if (empty($pecahPeminjaman)) {
        $idPeminjaman = "PMJ001";
    } else {
        $pre_idBarang = $pecahPeminjaman['id_peminjaman'];
        $num_pre_idBarang = substr($pre_idBarang, 3);
        $input = (int) $num_pre_idBarang + 1;
        $idPeminjaman = str_pad($input, 6, "PMJ001", STR_PAD_LEFT);
        if ($metodePembayaran != "COD") {
            while (checkTotal($subTotal, $koneksi)) {
                $subTotal =  $subTotal + rand(11, 999);
            }
        } else {
            $subTotal = $_GET['subTotal'];
        }
    }

    if (empty($return_url)) {
        header('Location: ./');
    }

    if (!isset($tanggalPinjam) && !isset($durasiPinjam) && !isset($metodePembayaran)) {
        header('Location:' . $return_url);
    } else {
        if (!isset($_SESSION['id_login'])) {
            $_SESSION['return_url'] = $_GET["return_url"];
            header('Location: ./login.php');
        } else {
            if ($tanggalPinjam < $tanggalTransaksi) {
                header('Location:' . $return_url . '?status=tanggalsalah');
            } else {
                $ambilCart = $koneksi->query("SELECT * FROM tbl_cart WHERE id_user='" . $_SESSION['id_login'] . "'") or die("Last error: {$koneksi->error}\n");
                $count_cart = mysqli_num_rows($ambilCart);
                if ($count_cart > 0) {
                    $koneksi->query("INSERT INTO tbl_peminjaman VALUES('" . $idPeminjaman . "','" . $_SESSION['id_login'] . "','" . $tanggalTransaksi . "','" . $durasiPinjam . "','" . $tanggalPinjam . "','BELUM DIBAYAR','" . $metodePembayaran . "','" . $subTotal . "')") or die("Last error: {$koneksi->error}\n");
                    while ($pecahCart = $ambilCart->fetch_array()) {
                        $koneksi->query("INSERT INTO tbl_detailpeminjaman VALUES('" . $idPeminjaman . "','" . $pecahCart['id_barang'] . "','" . $pecahCart['jumlah_cart'] . "')") or die("Last error: {$koneksi->error}\n");
                    }
                    $koneksi->query("DELETE FROM tbl_cart WHERE id_user='" . $_SESSION['id_login'] . "'") or die("Last error: {$koneksi->error}\n");
                    header('Location: ./pembayaran.php?id=' . $idPeminjaman . '');
                } else {
                    header('Location: ./' . dirname($_SERVER["PHP_SELF"]) . '');
                }
            }
        }
    }
} else if (isset($_POST['action']) && isset($_POST['id']) && isset($_POST['jumlahcart'])) {
    $jumlahcart = $_POST['jumlahcart'];
    $id = $_POST['id'];
    $res['status'] = true;
    if (!isset($_SESSION['id_login'])) {
        $_SESSION['cart'][$id] = $jumlahcart;
    } else {
        $query = $koneksi->query("UPDATE tbl_cart SET jumlah_cart='$jumlahcart' WHERE id_user='" . $_SESSION['id_login'] . "' AND id_barang='$id'") or die("Last error: {$koneksi->error}\n");
        if (!$query) {
            $res['status'] = false;
        }
    }
    echo json_encode($res);
}

function checkTotal($stotal, $koneksi)
{
    $ambilPeminjaman = $koneksi->query("SELECT * FROM tbl_peminjaman WHERE total_harga='" . $stotal . "'") or die("Last error: {$koneksi->error}\n");
    $pecahPeminjaman = $ambilPeminjaman->fetch_array();
    if (empty($pecahPeminjaman)) {
        return false;
    } else {
        return true;
    }
}
