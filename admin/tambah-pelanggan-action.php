<?php
include('./session.php');
include('../config/koneksi.php');
$res['status'] = "gagal";
if (isset($_POST['simpan']) && isset($_POST['inputName']) && isset($_POST['inputUsername']) && isset($_POST['inputAlamat']) && isset($_POST['inputEmail']) && isset($_POST['inputTelepon']) && isset($_POST['statususer'])) {
    $namauser = $_POST['inputName'];
    $usernameuser = $_POST['inputUsername'];
    $alamatuser = $_POST['inputAlamat'];
    $emailuser = $_POST['inputEmail'];
    $teleponuser = $_POST['inputTelepon'];
    $statususer = $_POST['statususer'];
    $ambilUser = $koneksi->query("SELECT id_user FROM tbl_user ORDER BY id_user DESC LIMIT 1") or die("Last error: {$koneksi->error}\n");
    $pecahUser = $ambilUser->fetch_array();
    if (empty($pecahUser)) {
        $idUser = "USR001";
    } else {
        $pre_idUser = $pecahUser['id_user'];
        $num_pre_idUser = substr($pre_idUser, 3);
        $input = (int) $num_pre_idUser + 1;
        $idUser = str_pad($input, 6, "USR001", STR_PAD_LEFT);
    }
    $query = $koneksi->query("INSERT INTO tbl_user VALUES('$idUser','$namauser','$usernameuser','123456','$alamatuser','$emailuser','$teleponuser','$statususer','')");
    if ($query) {
        $res['status'] = "sukses";
        $res['id'] = "$idUser";
    }
}
echo json_encode($res);
