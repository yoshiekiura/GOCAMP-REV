<?php
include('./session.php');
include('../config/koneksi.php');
$res['status'] = "gagal";
if (isset($_POST['simpan']) && isset($_POST['idtransaksi']) && isset($_POST['namapelanggan']) && isset($_POST['statuspeminjaman']) && isset($_POST['durasi']) && isset($_POST['tglpinjam'])) {
    $idtransaksi = $_POST['idtransaksi'];
    $namapelanggan = $_POST['namapelanggan'];
    $statuspeminjaman = $_POST['statuspeminjaman'];
    $durasi = $_POST['durasi'];
    $tglpinjam = $_POST['tglpinjam'];


    // $ambil = $koneksi->query("SELECT DISTINCT id_peminjaman FROM tbl_peminjaman WHERE status_peminjaman='DIBAYAR' AND '$tglpinjam' BETWEEN CAST(tgl_pinjam AS DATE) AND DATE_ADD(tgl_pinjam, INTERVAL durasi_peminjaman DAY)") or die("Last error: {$koneksi->error}\n");
    // $hitung = mysqli_num_rows($ambil);
    // if ($hitung > 0) {
    //     $res['status'] = "sukses";
    //     while ($pecah = $ambil->fetch_array()) {
    //         $ambilCart = $koneksi->query("SELECT * FROM tbl_detailpeminjaman WHERE id_peminjaman='" . $pecah['id_peminjaman'] . "'");
    //         $hitungCart = mysqli_num_rows($ambilCart);
    //         if ($hitungCart > 0) {
    //             while ($pecahCart = $ambilCart->fetch_array()) {
    //                 $ambilBarang = $koneksi->query("SELECT * FROM tbl_barang WHERE id_barang='" . $pecahCart['id_barang'] . "' AND '" . $pecahCart['jumlah_detailBarang'] . "'>stok_barang") or die("Last error1: {$koneksi->error}\n");
    //                 $hitungBarang = mysqli_num_rows($ambilBarang);
    //                 if ($hitungBarang > 0) {
    //                     $res['status'] = "gagal";
    //                     $res['ket'] = "stok";
    //                     break;
    //                 }
    //             }
    //         }
    //     }
    // }
    $res['status'] = "sukses";
    for ($i = 0; $i < $durasi; $i++) {
        $ambil = $koneksi->query("SELECT DISTINCT id_peminjaman FROM tbl_peminjaman WHERE status_peminjaman='DIBAYAR' AND '$tglpinjam' BETWEEN CAST(tgl_pinjam AS DATE) AND DATE_ADD(tgl_pinjam, INTERVAL durasi_peminjaman DAY)") or die("Last error: {$koneksi->error}\n");
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
                $ambilPmj = $koneksi->query("SELECT * FROM tbl_detailpeminjaman WHERE id_barang='" . $pecahDetail['id_barang'] . "' AND id_peminjaman='$idtransaksi'");
                $hitungPmj = mysqli_num_rows($ambilPmj);
                if ($hitungPmj > 0) {
                    while ($pecahPmj = $ambilPmj->fetch_array()) {
                        $ambilBarang = $koneksi->query("SELECT * FROM tbl_barang WHERE id_barang='" . $pecahPmj['id_barang'] . "' AND '" . $pecahPmj['jumlah_detailBarang'] . "'>stok_barang") or die("Last error1: {$koneksi->error}\n");
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
        if ($i != $durasi) {
            $tglpinjam = date('Y-m-d', strtotime($tglpinjam . ' + 1 days'));
        }
    }
    $countRes = count(array_filter($res['barang'], function ($x) {
        return !empty($x);
    }));
    if ($countRes > 0) {
        $res['status'] = "gagal";
        $res['ket'] = "stok";
    } else {
        $query = $koneksi->query("UPDATE tbl_peminjaman SET tgl_pinjam='$tglpinjam',durasi_peminjaman='$durasi' WHERE id_peminjaman='$idtransaksi'");

        if ($query) {
            $res['status'] = "sukses";
            $ambil = $koneksi->query("SELECT * FROM tbl_peminjaman WHERE id_peminjaman='$idtransaksi'") or die("Last error1: {$koneksi->error}\n");
            $hitung = mysqli_num_rows($ambil);
            if ($hitung > 0) {
                $pecah = $ambil->fetch_array();
                if ($pecah['status_peminjaman'] == "DIPINJAM" && $statuspeminjaman == "BELUM DIBAYAR" || $pecah['status_peminjaman'] == "DIPINJAM" && $statuspeminjaman == "DIBAYAR" || $pecah['status_peminjaman'] == "DIPINJAM" && $statuspeminjaman == "SELESAI") {
                    if (checkTgl($idtransaksi, "plus") == true) {
                        $query = $koneksi->query("UPDATE tbl_peminjaman SET status_peminjaman='$statuspeminjaman' WHERE id_peminjaman='" . $pecah['id_peminjaman'] . "'");
                    }
                } else if (($pecah['status_peminjaman'] == "BELUM DIBAYAR" && $statuspeminjaman == "DIPINJAM") || ($pecah['status_peminjaman'] == "DIBAYAR" && $statuspeminjaman == "DIPINJAM") || ($pecah['status_peminjaman'] == "DIBAYAR" && $statuspeminjaman == "DIDENDA") || ($pecah['status_peminjaman'] == "BELUM DIBAYAR" && $statuspeminjaman == "DIDENDA")) {
                    if (checkTgl($idtransaksi, "min") == true) {
                        $query = $koneksi->query("UPDATE tbl_peminjaman SET status_peminjaman='$statuspeminjaman' WHERE id_peminjaman='" . $pecah['id_peminjaman'] . "'");
                    }
                } else {
                    $query = $koneksi->query("UPDATE tbl_peminjaman SET status_peminjaman='$statuspeminjaman' WHERE id_peminjaman='" . $pecah['id_peminjaman'] . "'");
                    $res['set'] = "awe";
                }
                if ($query) {
                    $res['status'] = "sukses";
                } else {
                    $res['status'] = "gagal";
                }
            }

            //update status
        } else {
            $res['status'] = "gagal";
            $res['ket'] = "query tanggal";
        }
    }

    //cek tanggal pinjam

}
echo json_encode($res);

function checkTgl($idtransaksi, $act)
{
    global $koneksi;
    $ambil = $koneksi->query("SELECT * FROM tbl_peminjaman WHERE id_peminjaman='$idtransaksi'") or die("Last error1: {$koneksi->error}\n");
    while ($pecah = $ambil->fetch_array()) {
        $ambilCart = $koneksi->query("SELECT * FROM tbl_detailpeminjaman WHERE id_peminjaman='" . $pecah['id_peminjaman'] . "'");
        $hitungCart = mysqli_num_rows($ambilCart);
        if ($hitungCart > 0) {
            while ($pecahCart = $ambilCart->fetch_array()) {
                if ($act == "min") {
                    $query = $koneksi->query("UPDATE tbl_barang SET stok_barang=stok_barang-'" . $pecahCart['jumlah_detailBarang'] . "' WHERE id_barang='" . $pecahCart['id_barang'] . "'") or die("Last error1: {$koneksi->error}\n");
                } else {
                    $query = $koneksi->query("UPDATE tbl_barang SET stok_barang=stok_barang+'" . $pecahCart['jumlah_detailBarang'] . "' WHERE id_barang='" . $pecahCart['id_barang'] . "'") or die("Last error1: {$koneksi->error}\n");
                }
            }
        }
    }
    if ($query) {
        return true;
    } else {
        return false;
    }
}

//     $query = $koneksi->query("UPDATE tbl_user SET nama_user='$nama_user',alamat_user='$alamat_user',email_user='$email_user',nohp_user='$nohp_user',status_user='$status_user' WHERE id_user='$id_user'");
//     if ($query) {
//         $res['status'] = "sukses";
//         echo json_encode($res);
//     } else {
//         $res['status'] = "gagal";
//         echo json_encode($res);
//     }
// } else {
//     $res['status'] = "gagal";
//     echo json_encode($res);
// }
