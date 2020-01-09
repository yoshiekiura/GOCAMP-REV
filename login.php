<?php
if (!isset($_SESSION)) {
	session_start();
}
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

    <title>LOGIN USER</title>

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
                    <form action="loginAction.php" method="post" id="checkout-form" class="clearfix" style="padding:20px;margin:45px;float:none;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);border-radius: 25px">
                        <div class="text-center">
                            <h3 class="title">LOGIN</h3>
                            <span>Belum punya akun? <a href="daftar.php"><strong class="text-success">Daftar</strong></a></span>
                        </div>
                        <br>
                        <div class="form-group">
                            <p>Email</p>
                            <input class="input" type="email" name="email" placeholder="Masukkan Email" maxlength="40">
                        </div>
                        <div class="form-group">
                            <p>Password</p>
                            <input class="input" type="password" name="password" placeholder="Masukkan Password" maxlength="20">
                        </div>
                        <div class="form-group">
                            <div class="checkbox icheck">
                                <label class="text-left">
                                    <input type="checkbox"> Ingat Saya</input>
                                </label>
                                <label class="text-right">
                                    <a href="lupaPassword.php">Lupa Password?</a>
                                </label>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <input class="primary-btn" type="submit" name="submit" value="Login">
                        </div>

                        <?php if (isset($_GET['status']) && $_GET['status'] == "sukses") { ?>
                            <script type="text/javascript">
                                alert("Akun anda berhasil diaktivasi, silahkan login!");
                            </script>
                        <?php } else if (isset($_GET['status']) && $_GET['status'] == "gagal") {
                            echo '<script type="text/javascript">alert("Email atau password anda salah!");</script>';
                        } ?>

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