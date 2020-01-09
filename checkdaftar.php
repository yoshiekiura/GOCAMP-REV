<?php
if (!isset($_SESSION)) {
    session_start();
}
include('config/koneksi.php');
$res['status'] = false;
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $ambil = $koneksi->query("SELECT * FROM tbl_user WHERE email_user='$email'");
    $count = mysqli_num_rows($ambil);
    if ($count > 0) {
        $res['status'] = true;
    }
}
echo json_encode($res);
