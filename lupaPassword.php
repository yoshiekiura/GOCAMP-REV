<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <title>Lupa Password</title>
  <!-- Google font -->
  <link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">

  <!-- Custom stlylesheet -->
  <link type="text/css" rel="stylesheet" href="css/style.css" />

  <!-- Bootstrap -->
  <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

  <!-- Slick -->
  <link type="text/css" rel="stylesheet" href="css/slick.css" />
  <link type="text/css" rel="stylesheet" href="css/slick-theme.css" />

  <!-- nouislider -->
  <link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />

  <!-- Font Awesome Icon -->
  <link rel="stylesheet" href="css/font-awesome.min.css">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>
  <!-- section -->
  <div class="section">
    <!-- container -->
    <div class="container">
      <!-- row -->
      <div class="row">
        <div class="col-md-6">
        </div>

        <div class="col-md-6">
          <form action="lupaPasswordAct.php" method="post" name="forgot" id="checkout-form" class="clearfix" style="padding:20px;margin:45px;float:none;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);border-radius: 25px">
            <div class="text-center">
              <h3 class="title">Lupa Password</h3>
              <span><a href="login.php"><strong class="text-success">Login</strong></a> / <a href="daftar.php"><strong class="text-success">Daftar</strong></a></span>
            </div>
            <br>
            <?php
            if (!isset($_GET['status'])) { ?>
              <div class="form-group">
                <p>Email / Telepon</p>
                <input class="input" type="text" name="emailtel" placeholder="Masukkan Email atau Telepon" maxlength="40">
              </div>
            <?php } else if ($_GET['status'] == "terkirim") { ?>
              <script type="text/javascript">
                alert("Kode verifikasi berhasil dikirim, silahkan cek email atau pesan anda!");
              </script>
              <div class="form-group">
                <p>Kode Verifikasi</p>
                <input class="input" type="text" name="kode" placeholder="Masukkan Kode Verifikasi" maxlength="6">
              </div>
            <?php } else if ($_GET['status'] == "limit") { ?>
              <script type="text/javascript">
                alert("Kode verifikasi hanya dapat dikirim 1 kali dalam 5 menit, harap periksa email anda!");
              </script>
              <div class="form-group">
                <p>Kode Verifikasi</p>
                <input class="input" type="text" name="kode" placeholder="Masukkan Kode Verifikasi" maxlength="6">
              </div>
            <?php } else if ($_GET['status'] == "verified") { ?>
              <script type="text/javascript">
                alert("Silahkan masukkan password baru anda!");

                function valid() {
                  if (document.forgot.password.value != document.forgot.password2.value) {
                    alert("Password and Confirm Password Field do not match !!");
                    document.forgot.password2.focus();
                    return false;
                  }
                  return true;
                }
              </script>
              <input type="hidden" name="token" value="<?php echo $_GET['auth'] ?>">
              <div class="form-group">
                <p>Password Baru</p>
                <input class="input" type="text" name="password" placeholder="Masukkan Kode Verifikasi" maxlength="20">
              </div>
              <div class="form-group">
                <p>Konfirmasi Password Baru</p>
                <input class="input" type="text" name="password2" placeholder="Masukkan Kode Verifikasi" maxlength="20">
              </div>
            <?php } else if ($_GET['status'] == "notfound") { ?>
              <script type="text/javascript">
                alert("Email atau nomor telepon anda tidak ditemukan!");
              </script>
              <div class="form-group">
                <p>Kode Verifikasi</p>
                <input class="input" type="text" name="kode" placeholder="Masukkan Kode Verifikasi" maxlength="6">
              </div>
            <?php } else if ($_GET['status'] == "expired") { ?>
              <script type="text/javascript">
                alert("Kode verifikasi telah kadaluarsa, silahkan lakukan permintaan baru!");
              </script>
              <div class="form-group">
                <p>Email / Telepon</p>
                <input class="input" type="text" name="emailtel" placeholder="Masukkan Email atau Telepon" maxlength="40">
              </div>
            <?php } else if ($_GET['status'] == "changed") { ?>
              <script type="text/javascript">
                alert("Password berhasil diubah, silahkan login kembali!");
                window.location.href = "login.php";
              </script>
              <div class="form-group">
                <p>Email / Telepon</p>
                <input class="input" type="text" name="emailtel" placeholder="Masukkan Email atau Telepon" maxlength="40">
              </div>
            <?php } ?>
            <br>
            <div class="form-group">
              <button class="primary-btn btn-block btn-flat" onclick="return valid();" type="submit" name="submit">Kirim</button>
            </div>
          </form>
        </div>
      </div>

    </div>
    <!-- /row -->
  </div>
  <!-- /container -->
  </div>
  <!-- /section -->

  <!-- jQuery Plugins -->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/slick.min.js"></script>
  <script src="js/nouislider.min.js"></script>
  <script src="js/jquery.zoom.min.js"></script>
  <script src="js/main.js"></script>
  <script>
    // check if input is bigger than 3
    $("input").on("keyup", function() {
      var maxLength = $(this).attr("maxlength");
      if (maxLength == $(this).val().length) {
        alert("Anda hanya bisa mengisi sebanyak " + maxLength + " karakter")
        // this.val("");
      }
    })
  </script>
</body>

</html>