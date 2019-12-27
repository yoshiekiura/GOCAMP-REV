<?php
include('./session.php');
include('../config/koneksi.php');

if (isset($_POST['simpan']) && isset($_POST['id_user']) && isset($_POST['nama_user']) && isset($_POST['alamat_user']) && isset($_POST['email_user']) && isset($_POST['nohp_user'])) {
    $id_user = $_POST['id_user'];
    $nama_user = $_POST['nama_user'];
    $alamat_user = $_POST['alamat_user'];
    $email_user = $_POST['email_user'];
    $nohp_user = $_POST['nohp_user'];
    $status_user = $_POST['status_user'];
    $query = $koneksi->query("UPDATE tbl_user SET nama_user='$nama_user',alamat_user='$alamat_user',email_user='$email_user',nohp_user='$nohp_user',status_user='$status_user' WHERE id_user='$id_user'");
    if ($query) {
        $res['status'] = "sukses";
        echo json_encode($res);
    } else {
        $res['status'] = "gagal";
        echo json_encode($res);
    }
} else {
    $res['status'] = "gagal";
    echo json_encode($res);
}
