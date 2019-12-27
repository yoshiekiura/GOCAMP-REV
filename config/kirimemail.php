<?php
ob_start();

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';

require 'PHPMailer/src/PHPMailer.php';

require 'PHPMailer/src/SMTP.php';

function sendMail($emailTo, $Nsubject, $pesan, $rurl)
{
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions

    try {
        //Server settings

        $mail->SMTPDebug = 2;                                 // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP

        $mail->Host = 'smtp.sendgrid.net';                     // Specify main and backup SMTP servers

        $mail->SMTPAuth = true;                               // Enable SMTP authentication

        $mail->Username = "apikey";     // SMTP username

        $mail->Password = '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';                         // SMTP password

        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted

        $mail->Port = 587;                                    // TCP port to connect to

        //Recipients

        $mail->setFrom("noreply@gocamppolije.com", "GOCAMP"); //email pengirim

        $mail->addAddress($emailTo); // Email penerima

        $mail->addReplyTo("noreply@gocamppolije.com");

        //Content

        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = "$Nsubject - GOCAMP ";

        $mail->Body    = $pesan;

        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        header('location: ' . $rurl);
        // echo("<script>location.href = '$rurl';</script>");
        // exit(header('location: '.$rurl));
    } catch (Exception $e) {

        echo 'Message could not be sent.';
    }

    // exit();

}
function checkSMTP()
{
    if (onSMTP()) {
        global $koneksi;
        $ambil = $koneksi->query("SELECT * FROM tbl_setting");
        $pecah = $ambil->fetch_array();
        if ($pecah['smtp_server'] == "" || $pecah['smtp_username'] == "" || $pecah['smtp_port'] == "" || $pecah['smtp_password'] == "" || $pecah['smtp_secure'] == "") {
            return false;
        } else {
            return true;
        }
    } else {
        return false;
    }
}
function onSMTP()
{
    global $koneksi;
    $ambil = $koneksi->query("SELECT * FROM tbl_setting");
    $pecah = $ambil->fetch_array();
    if ($pecah['smtp_status'] != 1) {
        return false;
    } else {
        return true;
    }
}
ob_flush();
