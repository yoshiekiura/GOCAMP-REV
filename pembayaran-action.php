<?php
include('config/koneksi.php');
if(isset($_POST['tipe']) && isset($_POST['metode']) && isset($_POST['id'])){
    $metode = $_POST['metode'];
    $id = $_POST['id'];
    $query = $koneksi->query("UPDATE tbl_peminjaman SET metode_pembayaran='$metode' WHERE id_peminjaman='$id'");
    if($query){
        $array['status'] = 1;
        echo json_encode($array);
    }
}