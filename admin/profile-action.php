<?php
include('./session.php');
include('../config/koneksi.php');
$res['status'] = "gagal";
if (isset($_POST['action']) && $_POST['action'] == "simpan" && isset($_POST['nama']) && isset($_POST['email']) && isset($_POST['nohp'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $nohp = $_POST['nohp'];
    $query = $koneksi->query("UPDATE tbl_admin SET nama_admin='$nama',email_admin='$email',nohp_admin='$nohp'");
    if ($query) {
        $res['status'] = "sukses";
    } else {
        $res['status'] = "gagal";
    }
} else if (isset($_POST['action']) && $_POST['action'] == "ubah" && isset($_POST['OldPassword']) && isset($_POST['NewPassword']) && isset($_POST['ConfirmNewPassword'])) {
    $oldpassword = $_POST['OldPassword'];
    $newpassword = $_POST['NewPassword'];
    $confirmnewpassword = $_POST['ConfirmNewPassword'];
    $id = $_SESSION['logged-admin'];
    $ambil = $koneksi->query("SELECT * FROM tbl_admin WHERE id_admin='$id' AND password_admin='$oldpassword'");
    $hitung = mysqli_num_rows($ambil);
    if ($hitung > 0) {
        $query = $koneksi->query("UPDATE tbl_admin SET password_admin='$newpassword'");
        if ($query) {
            $res['status'] = "sukses";
        }
    }
}
echo json_encode($res);
