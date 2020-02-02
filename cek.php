<?php
if (!isset($_SESSION)) {
    session_start();
}
include('config/koneksi.php');
$tglpinjam = '2020-02-08';
$durasi = 2;
// Start date
// $date = '2009-12-06';
// End date
// $end_date = date('Y-m-d', strtotime($tglpinjam. ' + '.$durasi.' days'));

// while (strtotime($tglpinjam) <= strtotime($end_date)) {
//     echo "$tglpinjam\n";
//     $tglpinjam = date("Y-m-d", strtotime("+1 day", strtotime($tglpinjam)));
// }
for ($i = 0; $i < $durasi; $i++) {
    $ambil = $koneksi->query("SELECT DISTINCT id_peminjaman FROM tbl_peminjaman WHERE status_peminjaman='DIBAYAR' AND '$tglpinjam' BETWEEN CAST(tgl_pinjam AS DATE) AND DATE_ADD(tgl_pinjam, INTERVAL durasi_peminjaman DAY)") or die("Last error: {$koneksi->error}\n");
    $hitung = mysqli_num_rows($ambil);
    $res['id'][]=null;
    $res['barang'][]=null;
    if ($hitung > 0) {
        while ($pecah = $ambil->fetch_array()) {
            $ambilDetail = $koneksi->query("SELECT * FROM tbl_detailpeminjaman WHERE id_peminjaman='" . $pecah['id_peminjaman'] . "'");
            // $res['id'][] = $pecah['id_peminjaman'];
            if (!in_array($pecah['id_peminjaman'], $res['id'])) {
                $res['id'][] = $pecah['id_peminjaman'];
            }
            while ($pecahDetail = $ambilDetail->fetch_array()) {
                // $res['barang'][] = $pecahDetail['id_barang'];
                if (!in_array($pecahDetail['id_barang'], $res['barang'])) {
                    $res['barang'][] = $pecahDetail['id_barang'];
                }
            }
        }
    }
    if ($i != $durasi) {
        $tglpinjam = date('Y-m-d', strtotime($tglpinjam . ' + 1 days'));
    }
}
$postArr = array_map('array_filter', $res);
$postArr = array_filter( $postArr );
print_r($postArr);








// $ambil = $koneksi->query("SELECT DISTINCT id_peminjaman FROM tbl_peminjaman WHERE status_peminjaman='DIBAYAR' AND '$tglpinjam' BETWEEN CAST(tgl_pinjam AS DATE) AND DATE_ADD(tgl_pinjam, INTERVAL durasi_peminjaman DAY)") or die("Last error: {$koneksi->error}\n");
// $hitung = mysqli_num_rows($ambil);
// if ($hitung > 0) {
//     while ($pecah = $ambil->fetch_array()) {
//         $ambilDetail = $koneksi->query("SELECT * FROM tbl_detailpeminjaman WHERE id_peminjaman='" . $pecah['id_peminjaman'] . "'");
//         $res['id'][] = $pecah['id_peminjaman'];
//         while ($pecahDetail = $ambilDetail->fetch_array()) {
//             $res['barang'][] = $pecahDetail['id_barang'];
//         }
//     }
//     echo "ada <br>";
//     print_r($res);
//     // while ($pecah = $ambil->fetch_array()) {
//     //     $ambilCart = $koneksi->query("SELECT * FROM tbl_detailpeminjaman WHERE id_peminjaman='" . $pecah['id_peminjaman'] . "'");
//     //     $hitungCart = mysqli_num_rows($ambilCart);
//     //     if ($hitungCart > 0) {
//     //         while ($pecahCart = $ambilCart->fetch_array()) {
//     //             $koneksi->query("UPDATE tbl_barang SET stok_barang=stok_barang+'" . $pecahCart['jumlah_detailBarang'] . "' WHERE id_barang='" . $pecahCart['id_barang'] . "'") or die("Last error1: {$koneksi->error}\n");
//     //         }
//     //     }
//     // }
//     // $koneksi->query("UPDATE tbl_peminjaman SET status_peminjaman='KADALUARSA' WHERE status_peminjaman='BELUM DIBAYAR' AND CAST(CURRENT_TIMESTAMP AS DATE)>DATE_ADD(tgl_booking, INTERVAL 1 DAY) AND metode_pembayaran<>'COD'");
// }
