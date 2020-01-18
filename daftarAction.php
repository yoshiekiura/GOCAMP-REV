<?php
include('config/koneksi.php');
include('config/kirimemail.php');

if (isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $code = rand(100000, 999999);
    $expired = date("Y/m/d H:i", strtotime("+5 minutes"));
    $now = date("Y-m-d H:i:s");
    $ambil = $koneksi->query("SELECT * FROM tbl_user WHERE email_user='$email' OR username_user='$username'");
    $hitung = mysqli_num_rows($ambil);
    if ($hitung == 0) {
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
        $query = $koneksi->query("INSERT INTO tbl_verifikasidaftar VALUES('','$email','$code','$expired')");

        if ($query) {
            $daftar = $koneksi->query("INSERT INTO tbl_user VALUES('$idUser','$nama','$username','$password','','$email','$tel','TIDAK AKTIF','')");
            if (!$daftar) {
                exit("Error");
            } else {
                $rurl = 'daftar.php?status=verifikasi';
                $subject = '' . $code . ' adalah kode aktivasi akun Anda';
                $pesan = 'Terima kasih telah mendaftar.<br>Akun anda berhasil terdaftar, anda dapat login setelah melakukan aktifasi akun.<br> <br>------------------------<br>Kode Verifikasi	: ' . $code . '<br>------------------------<br><br>Tolong klik link dibawah ini untuk melakukan aktivasi akun anda:<br>http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER["PHP_SELF"]) . '/verify.php?email=' . $email . '&kode=' . $code . '';
                if (checkSMTP()) {
                    sendMail($email, $subject, $pesan, $rurl);
                } else {
                    $rurl = explode("?", $rurl);
                    header('location: ' . $rurl[0] . '?status=smtpoff');
                }
            }
        } else {
            header('location: daftar.php?status=gagal');
        }
        // header('location: login.php');
    } else {
        $ambilUser = $koneksi->query("SELECT * FROM tbl_user WHERE email_user='$email' OR username_user='$username' AND status_user='TIDAK AKTIF'");
        $hitungUser = mysqli_num_rows($ambilUser);
        if ($hitungUser > 0) {
            $ambil = $koneksi->query("SELECT * FROM tbl_verifikasidaftar WHERE email='$email' AND STR_TO_DATE('$now', '%Y-%m-%d %H:%i')<expired");
            $hitung = mysqli_num_rows($ambil);
            if ($hitung > 0) {
                header('location: daftar.php?status=limit');
                //limit
            } else {
                $query = $koneksi->query("INSERT INTO tbl_verifikasidaftar VALUES('','$email','$code','$expired')");
                $rurl = 'daftar.php?status=verifikasi';
                $subject = '' . $code . ' adalah kode aktivasi akun Anda';
                $pesan = 'Terima kasih telah mendaftar.<br>Akun anda berhasil terdaftar, anda dapat login setelah melakukan aktifasi akun.<br> <br>------------------------<br>Kode Verifikasi	: ' . $code . '<br>------------------------<br><br>Tolong klik link dibawah ini untuk melakukan aktivasi akun anda:<br>http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER["PHP_SELF"]) . '/verify.php?email=' . $email . '&kode=' . $code . '';
                sendMail($email, $subject, $pesan, $rurl);
            }
        } else {
            header('location: daftar.php?status=terdaftar');
            //aktif
        }
    }
} else if (isset($_POST['kode'])) {
    $Skode = $_POST["kode"];
    $now = date("Y-m-d H:i:s");
    $code = rand(100000, 999999);
    $expired = date("Y/m/d H:i", strtotime("+5 minutes"));
    $ambil = $koneksi->query("SELECT * FROM tbl_verifikasidaftar WHERE kode='$Skode' AND STR_TO_DATE('$now', '%Y-%m-%d %H:%i')<expired");
    $hitung = mysqli_num_rows($ambil);
    $pecah = $ambil->fetch_array();
    $email = $pecah['email'];
    if ($hitung > 0) {
        $query = $koneksi->query("UPDATE tbl_user SET status_user='AKTIF' WHERE email_user='$email'");
        if (!$query) {
            header('location: daftar.php?status=gagal');
        } else {
            header('location: login.php?status=sukses');
        }
    } else {
        if (isset($email)) {
            $query = $koneksi->query("INSERT INTO tbl_verifikasidaftar VALUES ('','$email','$code','$expired')");
            if (!$query) {
                exit("Error");
            } else {
                $rurl = 'daftar.php?status=expired';
                $subject = '' . $code . ' adalah kode aktivasi akun Anda';
                $pesan = 'Terima kasih telah mendaftar.<br>Akun anda berhasil terdaftar, anda dapat login setelah melakukan aktifasi akun.<br> <br>------------------------<br>Kode Verifikasi	: ' . $code . '<br>------------------------<br><br>Tolong klik link dibawah ini untuk melakukan aktivasi akun anda:<br>http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER["PHP_SELF"]) . '/verify.php?email=' . $email . '&kode=' . $code . '';
                sendMail($email, $subject, $pesan, $rurl);
            }
        } else {
            header('location: daftar.php?status=gagal');
        }
    }
} else {
    header('location: daftar.php?status=kosong');
}
