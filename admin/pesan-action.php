<?php
include('./session.php');
require('../config/koneksi.php');

$res['status'] = "gagal";
if (isset($_POST['lupapassword']) && isset($_POST['pesanfpassword'])) {
    if (!file_exists("./config/lupapassword.txt")) {
        $fp = fopen("./config/lupapassword.txt", "wb");
        if ($fp == false) {
            $res['status'] = "gagal";
        } else {
            fwrite($fp, "");
            fclose($fp);
        }
    }
    $pesan = $_POST['pesanfpassword'];
    $file = fopen("./config/lupapassword.txt", "w");
    ftruncate($file, 0);
    if (fwrite($file, $pesan)) {
        fclose($file);
        $res['status'] = "sukses";
    }
    echo json_encode($res);
} else if (isset($_POST['daftar']) && isset($_POST['pesanfdaftar'])) {
    if (!file_exists("./config/daftar.txt")) {
        $fp = fopen("./config/daftar.txt", "wb");
        if ($fp == false) {
            $res['status'] = "gagal";
        } else {
            fwrite($fp, "");
            fclose($fp);
        }
    }
    $pesan = $_POST['pesanfdaftar'];
    $file = fopen("./config/daftar.txt", "w");
    ftruncate($file, 0);
    if (fwrite($file, $pesan)) {
        fclose($file);
        $res['status'] = "sukses";
    }
    echo json_encode($res);
} else if (isset($_POST['sms']) && isset($_POST['pesansms'])) {
    if (!file_exists("./config/sms.txt")) {
        $fp = fopen("./config/sms.txt", "wb");
        if ($fp == false) {
            $res['status'] = "gagal";
        } else {
            fwrite($fp, "");
            fclose($fp);
        }
    }
    $pesan = $_POST['pesansms'];
    $file = fopen("./config/sms.txt", "w");
    ftruncate($file, 0);
    if (fwrite($file, $pesan)) {
        fclose($file);
        $res['status'] = "sukses";
    }
    echo json_encode($res);
}
