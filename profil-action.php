<?php
include('config/koneksi.php');
if(isset($_POST['id_user'])&&isset($_POST['nama_user'])&&isset($_POST['email_user'])&&isset($_POST['nohp_user'])&&isset($_POST['alamat_user'])){
    $id_user = $_POST['id_user'];
    $nama_user = $_POST['nama_user'];
    $email_user = $_POST['email_user'];
    $nohp_user = $_POST['nohp_user'];
    $alamat_user = $_POST['alamat_user'];
    $query = $koneksi->query("UPDATE tbl_user SET nama_user='$nama_user', email_user='$email_user', nohp_user='$nohp_user', alamat_user='$alamat_user' WHERE id_user='$id_user'");
    if($query){
            header("location:profil.php");
    }
}
else if(isset ($_POST['id_user'])&&isset($_POST['password_baru'])){
    $id_user = $_POST['id_user'];
    $password_baru = $_POST['password_baru'];
    $query = $koneksi->query("UPDATE tbl_user SET password_user='$password_baru' WHERE id_user='$id_user'");
    if($query){
        header("location:profil.php");
}
}