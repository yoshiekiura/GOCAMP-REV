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
            $subTotal =  $subTotal + $input;
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
                    for ($i = 0; $i < $durasiPinjam; $i++) {
                        $ambil = $koneksi->query("SELECT DISTINCT id_peminjaman FROM tbl_peminjaman WHERE status_peminjaman='BELUM DIBAYAR' AND '$tanggalPinjam' BETWEEN CAST(tgl_pinjam AS DATE) AND DATE_ADD(tgl_pinjam, INTERVAL durasi_peminjaman DAY)") or die("Last error: {$koneksi->error}\n");
                        $hitung = mysqli_num_rows($ambil);
                        $res['peminjaman'][] = "";
                        $res['barang'][] = "";
                        if ($hitung > 0) {
                            while ($pecah = $ambil->fetch_array()) {
                                $ambilDetail = $koneksi->query("SELECT * FROM tbl_detailpeminjaman WHERE id_peminjaman='" . $pecah['id_peminjaman'] . "'");
                                $pecahDetail = $ambilDetail->fetch_array();
                                if (!in_array($pecah['id_peminjaman'], $res['peminjaman'])) {
                                    $res['peminjaman'] = array(
                                        'id' => $pecah['id_peminjaman']
                                    );
                                }
                                $ambilCart = $koneksi->query("SELECT * FROM tbl_cart WHERE id_barang='" . $pecahDetail['id_barang'] . "' AND id_user='" . $_SESSION['id_login'] . "'");
                                $hitungCart = mysqli_num_rows($ambilCart);
                                if ($hitungCart > 0) {
                                    while ($pecahCart = $ambilCart->fetch_array()) {
                                        $ambilBarang = $koneksi->query("SELECT * FROM tbl_barang WHERE id_barang='" . $pecahCart['id_barang'] . "' AND '" . $pecahCart['jumlah_cart'] . "'>stok_barang") or die("Last error1: {$koneksi->error}\n");
                                        $hitungBarang = mysqli_num_rows($ambilBarang);
                                        $pecahBarang = $ambilBarang->fetch_array();
                                        if ($hitungBarang > 0) {
                                            if (!in_array($pecahBarang['id_barang'], $res['barang'])) {
                                                $res['barang'] = array(
                                                    'id' => $pecahBarang['id_barang'],
                                                    'nama' => $pecahBarang['nama_barang']
                                                );
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        if ($i != $durasiPinjam) {
                            $tanggalPinjam = date('Y-m-d', strtotime($tanggalPinjam . ' + 1 days'));
                        }
                    }
                    $countRes = count(array_filter($res['barang'], function ($x) {
                        return !empty($x);
                    }));
                    if ($countRes > 0) {
                        $res['status'] = "gagal";
                        $res['ket'] = "stok";
                        header('Location: ./checkout.php?status=gagaltanggal');
                    } else {
                        $koneksi->query("INSERT INTO tbl_peminjaman VALUES('" . $idPeminjaman . "','" . $_SESSION['id_login'] . "','" . $tanggalTransaksi . "','" . $durasiPinjam . "','" . $tanggalPinjam . "','BELUM DIBAYAR','" . $metodePembayaran . "','" . $subTotal . "')") or die("Last error: {$koneksi->error}\n");
                        while ($pecahCart = $ambilCart->fetch_array()) {
                            $koneksi->query("INSERT INTO tbl_detailpeminjaman VALUES('" . $idPeminjaman . "','" . $pecahCart['id_barang'] . "','" . $pecahCart['jumlah_cart'] . "')") or die("Last error: {$koneksi->error}\n");
                            $koneksi->query("UPDATE tbl_barang SET stok_barang=stok_barang-'" . $pecahCart['jumlah_cart'] . "' WHERE id_barang='" . $pecahCart['id_barang'] . "'") or die("Last error: {$koneksi->error}\n");

                            // $ambilBarang = $koneksi->query("SELECT * FROM tbl_barang WHERE id_barang='" . $pecahCart['id_barang'] . "'") or die("Last error: {$koneksi->error}\n");
                            // $pecahBarang = $ambilBarang->fetch_array();
                            // if ($pecahBarang['stok_barang'] < $pecahCart['jumlah_cart']) {
                            //     $ambilDPeminjaman = $koneksi->query("SELECT * FROM tbl_cart JOIN tbl_detailpeminjaman ON tbl_cart.id_barang=tbl_detailpeminjaman.id_barang WHERE tbl_cart.id_user='" . $_SESSION['id_login'] . "'") or die("Last error: {$koneksi->error}\n");
                            //     $count_dpeminjaman = mysqli_num_rows($ambilDPeminjaman);
                            //     if ($count_dpeminjaman > 0) {
                            //         while ($pecahdpeminjaman = $ambilDPeminjaman->fetch_array()) {
                            //             $koneksi->query("UPDATE tbl_barang SET stok_barang=stok_barang+'" . $pecahdpeminjaman['jumlah_detailBarang'] . "' WHERE id_barang='" . $pecahdpeminjaman['id_barang'] . "'") or die("Last error: {$koneksi->error}\n");
                            //         }
                            //     }
                            //     header('Location:' . $return_url);
                            // } else {
                            //     $koneksi->query("INSERT INTO tbl_detailpeminjaman VALUES('" . $idPeminjaman . "','" . $pecahCart['id_barang'] . "','" . $pecahCart['jumlah_cart'] . "')") or die("Last error: {$koneksi->error}\n");
                            //     $koneksi->query("UPDATE tbl_barang SET stok_barang=stok_barang-'" . $pecahCart['jumlah_cart'] . "' WHERE id_barang='" . $pecahCart['id_barang'] . "'") or die("Last error: {$koneksi->error}\n");
                            // }
                        }
                        $koneksi->query("DELETE FROM tbl_cart WHERE id_user='" . $_SESSION['id_login'] . "'") or die("Last error: {$koneksi->error}\n");
                        header('Location: ./pembayaran.php?id=' . $idPeminjaman . '');
                        $res['status'] = "sukses";
                    }
                } else {
                    header('Location: ./' . dirname($_SERVER["PHP_SELF"]) . '');
                }
            }
        }
        echo json_encode($res);
    }
} else if (isset($_POST['action']) && isset($_POST['id']) && isset($_POST['jumlahcart'])) {
    $jumlahcart = $_POST['jumlahcart'];
    $id = $_POST['id'];
    $res['status'] = true;
    $ambilBarang = $koneksi->query("SELECT * FROM tbl_barang WHERE id_barang='$id'") or die("Last error: {$koneksi->error}\n");
    $pecahBarang = $ambilBarang->fetch_array();
    $stok_barang = $pecahBarang['stok_barang'];
    if (!isset($_SESSION['id_login'])) {
        if ($stok_barang >= $jumlahcart) {
            $_SESSION['cart'][$id] = $jumlahcart;
        } else {
            $res['stok'] = $stok_barang;
            $res['status'] = false;
        }
        
    } else {

        if ($stok_barang >= $jumlahcart) {
            $query = $koneksi->query("UPDATE tbl_cart SET jumlah_cart='$jumlahcart' WHERE id_user='" . $_SESSION['id_login'] . "' AND id_barang='$id'") or die("Last error: {$koneksi->error}\n");
            if (!$query) {
                $res['status'] = false;
            }
        } else {
            $res['stok'] = $stok_barang;
            $res['status'] = false;
        }
    }
    echo json_encode($res);

    // $jumlahcart = $_POST['jumlahcart'];
    // $id = $_POST['id'];
    // $res['status'] = true;
    // if (!isset($_SESSION['id_login'])) {
    //     $_SESSION['cart'][$id] = $jumlahcart;
    // } else {
    //     $query = $koneksi->query("UPDATE tbl_cart SET jumlah_cart='$jumlahcart' WHERE id_user='" . $_SESSION['id_login'] . "' AND id_barang='$id'") or die("Last error: {$koneksi->error}\n");
    //     if (!$query) {
    //         $res['status'] = false;
    //     }
    // }
    // echo json_encode($res);
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
