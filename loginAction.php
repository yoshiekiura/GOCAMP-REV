<?php
include('config/koneksi.php');
include('config/kirimemail.php');
$email = $_POST['email'];
$password = $_POST['password'];
if (isset($email) && isset($password)) {
  $ambilUser =  $koneksi->query("SELECT * FROM tbl_user WHERE email_user='$email' and password_user='$password'") or die("Last error: {$koneksi->error}\n");
  $ambilUserVerif =  $koneksi->query("SELECT * FROM tbl_user WHERE email_user='$email' AND status_user='TIDAK AKTIF'") or die("Last error: {$koneksi->error}\n");
  $pecahUser = $ambilUser->fetch_array();
  $id_user = $pecahUser['id_user'];
  $countVerifikasi = mysqli_num_rows($ambilUserVerif);
  $count = mysqli_num_rows($ambilUser);
  if ($count != null && $countVerifikasi == null) {
    $_SESSION['id_login'] = $id_user;
    $hitungCart = count($_SESSION['cart']);
    if ($hitungCart > 0) {
      foreach ($_SESSION['cart'] as $id_barang => $jumlah) {
        $ambilCart =  $koneksi->query("SELECT * FROM tbl_cart WHERE id_barang='$id_barang' AND id_user='$id_user'") or die("Last error: {$koneksi->error}\n");
        $pecahCart = $ambilCart->fetch_array();
        $countRows = mysqli_num_rows($ambilCart);
        if ($countRows > 0) {
          $koneksi->query("UPDATE tbl_cart SET jumlah_cart=jumlah_cart+$jumlah WHERE id_user='$id_user' AND id_barang='$id_barang'") or die("Last error: {$koneksi->error}\n");
        } else {
          $koneksi->query("INSERT INTO tbl_cart VALUES('','$id_user','$id_barang','$jumlah')") or die("Last error: {$koneksi->error}\n");
        }
      }
      unset($_SESSION["cart"]);
    }
    if (isset($_SESSION['return_url'])) {
      $return_url = base64_decode($_SESSION["return_url"]);
      unset($_SESSION["return_url"]);
      header('Location:' . $return_url);
    } else {
      header('location: index.php');
    }
  } else if ($countVerifikasi > 0 && $count != null) {
    $now = date("Y-m-d H:i:s");
    $ambil = $koneksi->query("SELECT * FROM tbl_verifikasidaftar WHERE email='$email' AND STR_TO_DATE('$now', '%Y-%m-%d %H:%i:%s')<expired");
    $hitung =  mysqli_num_rows($ambil);
    if ($hitung > 0) {
      header('Location: daftar.php?status=verifikasi');
    } else {
      $code = rand(100000, 999999);
      $expired = date("Y/m/d H:i", strtotime("+5 minutes"));
      $query = $koneksi->query("INSERT INTO tbl_verifikasidaftar VALUES('','$email','$code','$expired')");
      if (!$query) {
        exit("Error");
        header('Location: daftar.php?status=gagal');
      } else {
        $rurl = 'daftar.php?status=verifikasi';
        $subject = '' . $code . ' adalah kode aktivasi akun Anda';
        $pesan = 'Terima kasih telah mendaftar.<br>Akun anda berhasil terdaftar, anda dapat login setelah melakukan aktifasi akun.<br> <br>------------------------<br>Kode Verifikasi	: ' . $code . '<br>------------------------<br><br>Tolong klik link dibawah ini untuk melakukan aktivasi akun anda:<br>http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER["PHP_SELF"]) . '/verify.php?email=' . $email . '&kode=' . $code . '';
        sendMail($email, $subject, $pesan, $rurl);
      }
    }
  } else {
    header('Location: login.php?status=gagal');
  }
} else {
  header('Location: login.php');
}
