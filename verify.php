<?php

include('config/koneksi.php');
if (isset($_GET['email']) && isset($_GET['kode'])) {
    $email = $_GET['email'];
    $kode = $_GET['kode'];

    $now = date("Y-m-d H:i:s");
    $code = rand(100000, 999999);
    $expired = date("Y/m/d H:i", strtotime("+5 minutes"));
    $ambil = $koneksi->query("SELECT * FROM tbl_verifikasidaftar WHERE kode='$kode' AND STR_TO_DATE('$now', '%Y-%m-%d %H:%i')<expired");
    $hitung = mysqli_num_rows($ambil);
    if ($hitung > 0) {
        $query = $koneksi->query("UPDATE tbl_user SET status_user='AKTIF' WHERE email_user='$email'");
        if (!$query) {
            header('location: daftar.php?status=gagal');
        } else {
            header('location: login.php?status=sukses');
        }
    } else {
        header('location: daftar.php?status=gagal');
    }
} else {
    header('location: daftar.php?status=gagal');
}
