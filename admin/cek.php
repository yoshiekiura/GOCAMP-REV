<?php
include('ovo.php');
include('../config/koneksi.php');
$p = new Ovo;
$jumlah_data = 100;
$data = $p->get_mutasi_account(trim($jumlah_data))->data;
$array = $data["0"]->complete;
// var_dump($array);
foreach ($array as $key => $value) {
    if ($value->desc2 == "Incoming Transfer" || $value->desc2 == "Transfer Masuk") {
        $ambil = $koneksi->query("SELECT * FROM tbl_peminjaman WHERE total_harga='" . $value->transaction_amount . "' AND status_peminjaman='BELUM DIBAYAR'");
        $hitung = mysqli_num_rows($ambil);
        if ($hitung > 0) {
            $koneksi->query("UPDATE tbl_peminjaman SET status_peminjaman='DIBAYAR' WHERE total_harga='" . $value->transaction_amount . "' AND status_peminjaman='BELUM DIBAYAR'");
        }
    }
}
$ambil = $koneksi->query("SELECT * FROM tbl_peminjaman WHERE status_peminjaman='BELUM DIBAYAR' AND CAST(CURRENT_TIMESTAMP AS DATE)>tgl_pinjam");
$hitung = mysqli_num_rows($ambil);
if ($hitung > 0) {
    $koneksi->query("UPDATE tbl_peminjaman SET status_peminjaman='KADALUARSA' WHERE status_peminjaman='BELUM DIBAYAR' AND CAST(CURRENT_TIMESTAMP AS DATE)>tgl_pinjam");
}
$ambil = $koneksi->query("SELECT * FROM tbl_peminjaman WHERE status_peminjaman='BELUM DIBAYAR' AND CAST(CURRENT_TIMESTAMP AS DATE)>DATE_ADD(tgl_booking, INTERVAL 1 DAY) AND metode_pembayaran<>'COD'");
$hitung = mysqli_num_rows($ambil);
if ($hitung > 0) {
    $koneksi->query("UPDATE tbl_peminjaman SET status_peminjaman='KADALUARSA' WHERE status_peminjaman='BELUM DIBAYAR' AND CAST(CURRENT_TIMESTAMP AS DATE)>DATE_ADD(tgl_booking, INTERVAL 1 DAY) AND metode_pembayaran<>'COD'");
}
$ambil = $koneksi->query("DELETE FROM tbl_verifikasidaftar WHERE CURRENT_TIMESTAMP>expired");
