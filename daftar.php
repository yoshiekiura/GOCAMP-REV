<?php
if (isset($_SESSION['id_login'])) {
    header('location: ./');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>DAFTAR USER</title>
    <script type="text/javascript">
        function valid() {
            if (document.forgot.password.value != document.forgot.password2.value) {
                alert("Password and Confirm Password Field do not match !!");
                document.forgot.password2.focus();
                return false;
            }
            return true;
        }
    </script>

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
                    <form action="daftarAction.php" method="post" name="forgot" id="checkout-form" class="clearfix" style="padding:20px;margin:45px;float:none;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);border-radius: 25px">
                        <div class="text-center">
                            <h3 class="title">DAFTAR</h3>
                            <span>Sudah punya akun? <a href="login.php"><strong class="text-success">Login</strong></a></span>
                        </div>
                        <br>
                        <?php if (!isset($_GET['status'])) { ?>
                            <div class="form-group">
                                <p>Nama</p>
                                <input class="input" type="text" name="nama" placeholder="Masukkan Nama" maxlength="25">
                            </div>
                            <div class="form-group">
                                <p>Email</p>
                                <input class="input" type="email" name="email" placeholder="Masukkan Email" maxlength="40">
                            </div>
                            <div class="form-group">
                                <p>No.Hp</p>
                                <input class="input" maxlength="13" type="number" name="tel" placeholder="Masukkan No hp" min="0" step="1">
                            </div>
                            <div class="form-group">
                                <p>Username</p>
                                <input class="input" type="text" name="username" placeholder="Masukkan Username" maxlength="15">
                            </div>
                            <div class="form-group">
                                <p>Password</p>
                                <input class="input" type="password" name="password" id="password" placeholder="Masukkan Password" maxlength="20">
                            </div>
                            <div class="form-group">
                                <p>Konfirmasi Password</p>
                                <input class="input" type="password" name="password2" id="confirmpassword" placeholder="Konfirmasi Password" maxlength="20">
                            </div>
                        <?php } else if ($_GET['status'] == "verifikasi") { ?>
                            <script type="text/javascript">
                                alert("Kode verifikasi berhasil dikirim, silahkan cek email anda!");
                            </script>
                            <div class="form-group">
                                <p>Kode Verifikasi</p>
                                <input class="input" type="number" name="kode" placeholder="Masukkan kode verifikasi anda" min="0" step="1" maxlength="6">
                            </div>
                        <?php } else if ($_GET['status'] == "limit") { ?>
                            <script type="text/javascript">
                                alert("Anda hanya dapat mengirim kode verifikasi 1 kali dalam 5 menit!");
                            </script>
                            <div class="form-group">
                                <p>Kode Verifikasi</p>
                                <input class="input" type="number" name="kode" placeholder="Masukkan kode verifikasi anda" min="0" step="1" maxlength="6">
                            </div>
                        <?php } else if ($_GET['status'] == "expired") { ?>
                            <script type="text/javascript">
                                alert("Kode verifikasi anda telah kadaluarsa, kami telah mengirim kode verifikasi baru, silahkan cek email anda!");
                            </script>
                            <div class="form-group">
                                <p>Kode Verifikasi</p>
                                <input class="input" type="number" name="kode" placeholder="Masukkan kode verifikasi anda" min="0" step="1" maxlength="6">
                            </div>
                        <?php } else if ($_GET['status'] == "gagal") { ?>
                            <script type="text/javascript">
                                alert("Terdapat masalah pada koneksi, silahkan gunakan email yang valid!");
                            </script>
                            <div class="form-group">
                                <div class="form-group">
                                    <p>Nama</p>
                                    <input class="input" type="text" name="nama" placeholder="Masukkan Nama" maxlength="25">
                                </div>
                                <div class="form-group">
                                    <p>Email</p>
                                    <input class="input" type="email" name="email" placeholder="Masukkan Email" maxlength="40">
                                </div>
                                <div class="form-group">
                                    <p>No.Hp</p>
                                    <input class="input" type="number" name="tel" placeholder="Masukkan No hp" min="0" step="1" maxlength="13">
                                </div>
                                <div class="form-group">
                                    <p>Username</p>
                                    <input class="input" type="text" name="username" placeholder="Masukkan Username" maxlength="15">
                                </div>
                                <div class="form-group">
                                    <p>Password</p>
                                    <input class="input" type="password" name="password" id="password" placeholder="Masukkan Password" maxlength="20">
                                </div>
                                <div class="form-group">
                                    <p>Konfirmasi Password</p>
                                    <input class="input" type="password" name="password2" id="confirmpassword" placeholder="Konfirmasi Password" maxlength="20">
                                </div>
                            <?php }  ?>
                            <br>
                            <div class="form-group">
                                <button class="primary-btn" type="submit" onclick="return valid();" name="submit">DAFTAR</button>
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
                $(this).focus()
            }
        })
    </script>
</body>

</html>