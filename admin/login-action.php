<?php
include('../config/koneksi.php');
$arr['status'] = false;
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $ambil = $koneksi->query("SELECT * FROM tbl_admin WHERE email_admin='$email' AND password_admin='$password'");
    $count = mysqli_num_rows($ambil);
    if ($count > 0) {
        $pecah = $ambil->fetch_array();
        $_SESSION['logged-admin'] = $pecah['id_admin'];
        $arr['status'] = true;
        echo json_encode($arr);
    }else{
        echo json_encode($arr);
    }
}else{
    echo json_encode($arr);
}
