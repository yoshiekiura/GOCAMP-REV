<?php
include('./session.php');
require('./ovo.php');
require('../config/koneksi.php');
if (!file_exists("config.txt")) {
    $fp = fopen("config.txt", "wb");
    if ($fp == false) {
        header('Location: setting.php?status=nothingconfig');
    } else {
        fwrite($fp, "");
        fclose($fp);
    }
    unset($_SESSION["expire"]);
}
$ovo = new Ovo;
$now = time();
if (isset($_POST['setting-ovo'])) {
    if (isset($_POST['no_ovo']) && isset($_POST['pin_ovo']) && !isset($_POST['kode_verifikasi'])) {
        if ($now > $_SESSION['expire'] || !isset($_SESSION['expire'])) {
            $_SESSION['start'] = time();
            $_SESSION['expire'] = $_SESSION['start'] + (1 * 60);
            $nomer = $_POST['no_ovo'];
            $rand = "6cd799d5-8979-3139-96db-" . random_string(12);
            $_SESSION['rand'] = $rand;
            $sendCode = $ovo->login_ovo(['deviceId' => $rand, 'mobile' => trim($nomer)], 1)->refId;
            if (isset($sendCode)) {
                $_SESSION['send-code'] = $sendCode;
                $noovo = $_POST['no_ovo'];
                $pinovo = $_POST['pin_ovo'];
                $ambil = $koneksi->query("SELECT * FROM tbl_setting");
                $hitung = mysqli_num_rows($ambil);
                if ($hitung > 0) {
                    $koneksi->query("UPDATE tbl_setting SET no_ovo='$noovo',pin_ovo='$pinovo'");
                } else {
                    $koneksi->query("INSERT INTO tbl_setting(id_setting,no_ovo,pin_ovo) VALUES('','$noovo','$pinovo')");
                }
                header('Location: setting.php?status=otp');
            } else {
                header('Location: setting.php?status=gagalno');
            }
        } else {
            header('Location: setting.php?status=gagal');
            echo "Hanya dapat mengirim 1 kode dalam 1 menit, harap tunggu!";
        }
    }
    if (isset($_POST['no_ovo']) && isset($_POST['pin_ovo']) && isset($_POST['kode_verifikasi']) && isset($_POST['rand']) && $_POST['kode_verifikasi'] != null) {
        $nomer = $_POST['no_ovo'];
        $pin = $_POST['pin_ovo'];
        $rand = $_POST['rand'];
        unset($_SESSION["rand"]);
        $sendCode = $_SESSION['send-code'];
        unset($_SESSION["send-code"]);
        $kode = $_POST['kode_verifikasi'];
        $array =
            [
                "appVersion" => "2.13.0",
                "deviceId" => $rand,
                "macAddress" => "00:CE:0A:ED:BF:BD",
                "mobile" => trim($nomer),
                "osName" => "android",
                "osVersion" => "7.1.2",
                "pushNotificationId" => "FCM|dOJkIbwZgbQ:APA91bGBWD1m3UGmcdQmeDMM4S_lFx3I2CyigmnE4vSjagq6Kg2qXBi4ZzWi-CMVrXv2YkmU_0rgW699b04a2msnoyQ-vVqsWGXUDZiSVATiQQ2WvPcVgLF2LdgJ4KTDwWZqxEPZoafM",
                "refId" => $sendCode,
                "verificationCode" => trim($kode)
            ];
        $verify = $ovo->login_ovo($array, 2);
        if (isset($verify->code)) {
            return die($verify->message);
        }
        $verifyPin = $ovo->login_ovo([
            "deviceUnixtime" => strtotime(date("Y-m-d H:i:s")),
            "securityCode" => trim($pin),
            "updateAccessToken" => $verify->updateAccessToken
        ], 3);
        if (isset($verifyPin->token)) {
            $file = fopen("config.txt", "w");
            $write = fwrite($file, $verifyPin->token);
            fclose($file);
            unset($_SESSION["expire"]);
            header('Location: setting.php?status=berhasil');
        } else {
            return die("Sistem Error.");
            header('Location: setting.php?status=pinsalah');
        }
    }
} else if (isset($_POST['reset-ovo'])) {
    if (file_exists("config.txt")) {
        $koneksi->query("UPDATE tbl_setting SET no_ovo='',pin_ovo=''");
        $f = @fopen("config.txt", "r+");
        if ($f !== false) {
            ftruncate($f, 0);
            fclose($f);
        }
        header('Location: setting.php?status=berhasil');
    } else {
        $fp = fopen("config.txt", "wb");
        if ($fp == false) {
            //do debugging or logging here
        } else {
            fwrite($fp, "");
            fclose($fp);
        }
        $koneksi->query("UPDATE tbl_setting SET no_ovo='',pin_ovo=''");
        header('Location: setting.php?status=berhasil');
    }
    unset($_SESSION["expire"]);
} else if (isset($_POST['login-ovo'])) {
    if ($now < $_SESSION['expire'] || !isset($_SESSION['expire'])) {
        loginOvo();
    } else {
        if (isset($_SESSION['expire']) && $now > $_SESSION['expire']) {
            unset($_SESSION["expire"]);
        }
        header('Location: setting.php?status=gagal');
        echo "Hanya dapat mengirim 1 kode dalam 1 menit, harap tunggu!";
    }
} else if (isset($_POST['value'])) {
    $smtp_status = $_POST['value'];
    $koneksi->query("UPDATE tbl_setting SET smtp_status='$smtp_status'");
} else if (isset($_POST['resetsmtp'])) {
    $query = $koneksi->query("UPDATE tbl_setting SET smtp_server='',smtp_username='',smtp_password='',smtp_port='',smtp_secure='',smtp_status=''");
    if ($query) {
        $res['status'] = "sukses";
    } else {
        $res['status'] = "gagal";
    }
    echo json_encode($res);
} else if (isset($_POST['resetsms'])) {
    $query = $koneksi->query("UPDATE tbl_setting SET api_sms=''");
    if ($query) {
        $res['status'] = "sukses";
    } else {
        $res['status'] = "gagal";
    }
    echo json_encode($res);
} else if (isset($_POST['smsapi'])) {
    $smsapi = $_POST['smsapi'];
    if (stripos($smsapi, "{pesan}") !== false) {
        $query = $koneksi->query("UPDATE tbl_setting SET api_sms='$smsapi'");
        if ($query) {
            $res['status'] = "sukses";
        } else {
            $res['status'] = "gagal";
        }
    } else {
        $res['status'] = "gagal";
    }
    echo json_encode($res);
} else if (isset($_POST['smtpserver']) && isset($_POST['smtpusername']) && isset($_POST['smtppassword']) && isset($_POST['smtpport']) && isset($_POST['smtpsecure'])) {
    $smtpserver = $_POST['smtpserver'];
    $smtpusername = $_POST['smtpusername'];
    $smtppassword = $_POST['smtppassword'];
    $smtpport = $_POST['smtpport'];
    $smtpsecure = $_POST['smtpsecure'];
    $query = $koneksi->query("UPDATE tbl_setting SET smtp_server='$smtpserver',smtp_username='$smtpusername',smtp_password='$smtppassword',smtp_port='$smtpport',smtp_secure='$smtpsecure'");
    if ($query) {
        $res['status'] = "sukses";
    } else {
        $res['status'] = "gagal";
    }
    echo json_encode($res);
}

function loginOvo()
{
    $_SESSION['start'] = time();
    $_SESSION['expire'] = $_SESSION['start'] + (1 * 60);
    global $ovo;
    $nomer = $_POST['no_ovo'];
    $rand = "6cd799d5-8979-3139-96db-" . random_string(12);
    $_SESSION['rand'] = $rand;
    $sendCode = $ovo->login_ovo(['deviceId' => $rand, 'mobile' => trim($nomer)], 1)->refId;
    if (isset($sendCode)) {
        $_SESSION['send-code'] = $sendCode;
        header('Location: setting.php?status=otp');
    } else {
        header('Location: setting.php?status=gagalnos');
    }
}
