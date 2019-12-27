<?php
if (!isset($_SESSION)) {
    session_start();
}
include('config/koneksi.php');
$id = $_GET['id'];
$ambil = $koneksi->query("SELECT * FROM tbl_user WHERE email_user='$id'") or die("Last error: {$koneksi->error}\n");
$pecah = $ambil->fetch_array();
echo $pecah['email_user'];