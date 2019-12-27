<?php
//format rupiah
function rupiah($angka){
	
	$rupiah = "Rp " . number_format($angka,2,',','.');
	return $rupiah;
}
if (!isset($_SESSION)) {
	session_start();
}
//db settings
$db_username = 'root';
$db_password = '';
$db_name = 'gocamp';
$db_host = 'localhost';
$koneksi = new mysqli($db_host, $db_username, $db_password,$db_name);
