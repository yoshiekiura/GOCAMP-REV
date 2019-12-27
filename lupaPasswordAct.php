<?php

include('config/koneksi.php');

include('config/kirimemail.php');



if (isset($_POST["emailtel"])) {

    $emailtel = $_POST["emailtel"];
    $ambil = $koneksi->query("SELECT * FROM tbl_user WHERE email_user='$emailtel' OR nohp_user='$emailtel'");
    $hitung = mysqli_num_rows($ambil);
    if ($hitung > 0) {
        // $code = uniqid(true);
        $code = rand(100000, 999999);
        $expired = date("Y/m/d H:i", strtotime("+5 minutes"));
        $now = date("Y-m-d H:i:s");
        $ambil = $koneksi->query("SELECT * FROM tbl_resetpassword WHERE emailtel='$emailtel' AND STR_TO_DATE('$now', '%Y-%m-%d %H:%i:%s')<expired");
        $hitung = mysqli_num_rows($ambil);
        if ($hitung > 0) {
            header('location: lupaPassword.php?status=limit');
        } else {
            $query = $koneksi->query("INSERT INTO tbl_resetpassword VALUES ('','$emailtel','$code','$expired')");

            if (!$query) {
                header('location: lupaPassword.php?status=notfound');
                exit("Error");
            } else {
                if (!filter_var($emailtel, FILTER_VALIDATE_EMAIL)) {
                    $email_api = urlencode("kholiq321@gmail.com");
                    $passkey_api = urlencode("asd123asd");
                    $no_hp_tujuan = urlencode($emailtel);
                    $isi_pesan = urlencode($code . " adalah kode pemulihan akun GOCAMP Anda");
                    $url = "https://reguler.medansms.co.id/sms_api.php?action=kirim_sms&email=" . $email_api . "&passkey=" . $passkey_api . "&no_tujuan=" . $no_hp_tujuan . "&pesan=" . $isi_pesan;
                    $result = sendSMS($url);
                    $data = explode("~~~", $result);
                    if ($data[0]) {
                        header('location: lupaPassword.php?status=terkirim');
                    } else {
                        header('location: lupaPassword.php?status=notfound');
                    }
                } else {
                    $url = 'lupaPassword.php?status=terkirim';
                    $subject = '' . $code . ' adalah kode pemulihan Akun Anda';
                    $pesan = 'Anda menerima email ini karena barusaja anda melakukan permintaan mengatur ulang kata sandi anda.<br> <br>------------------------<br>Kode Verifikasi	: ' . $code . '<br>------------------------<br><br>Tolong klik link dibawah ini untuk mengatur ulang kata sandi anda:<br>http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER["PHP_SELF"]) . '/lupaPassword.php?email=' . $email . '&kode=' . $code . '';
                    sendMail($emailtel, $subject, $pesan, $url);
                }
            }
        }
    } else {
        header('location: lupaPassword.php?status=notfound');
    }
} else if (isset($_POST["kode"])) {
    $Skode = $_POST["kode"];
    $now = date("Y-m-d H:i:s");
    $ambil = $koneksi->query("SELECT * FROM tbl_resetpassword WHERE kode='$Skode' AND STR_TO_DATE('$now', '%Y-%m-%d %H:%i:%s')<expired");
    $hitung = mysqli_num_rows($ambil);
    if ($hitung > 0) {
        header('location: lupaPassword.php?status=verified&auth=' . $Skode);
    } else {
        header('location: lupaPassword.php?status=expired');
    }
} else if (isset($_POST["token"]) && isset($_POST["password"])) {
    $Stoken = $_POST["token"];
    $newpassword = $_POST["password"];
    header('location: lupaPassword.php' . $newpassword);
    $now = date("Y-m-d H:i");
    $ambilX = $koneksi->query("SELECT * FROM tbl_resetpassword WHERE kode='$Stoken'");
    $pecahX = $ambilX->fetch_array();
    $emailtel = $pecahX['emailtel'];
    $hitung = mysqli_num_rows($ambilX);
    if ($hitung > 0) {
        $koneksi->query("UPDATE tbl_user SET password_user='$newpassword' WHERE email_user='$emailtel' OR nohp_user='$emailtel'");
        $koneksi->query("DELETE FROM tbl_resetpassword WHERE emailtel='$emailtel'");
        header('location: lupaPassword.php?status=changed');
    } else {
        header('location: lupaPassword.php?status=notfound');
    }
} else {
    header('location: lupaPassword.php');
}


function validate_email($emailtel)
{
    return filter_var($emailtel, FILTER_VALIDATE_EMAIL);
}
function sendSMS($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}
