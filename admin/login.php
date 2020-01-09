<?php
if (!isset($_SESSION)) {
  session_start();
}
if (isset($_SESSION['logged-admin'])) {
  header('location: ./index.php');
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LOGIN ADMIN</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="./plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="./index2.html"><b>Admin</b>GOCAMP</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Silahkan masuk bosku</p>
        <div class="input-group mb-3">
          <input type="email" class="form-control" id="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Jangan lupakan aku
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" id="masuk" class="btn btn-primary btn-block">Masuk</button>
          </div>
          <!-- /.col -->
        </div>

      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="./plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="./dist/js/adminlte.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="./plugins/sweetalert2/sweetalert2.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#masuk').on('click', function() {
        var email = $('#email').val();
        var password = $('#password').val();
        $.ajax({
          url: "login-action.php",
          type: "POST",
          data: {
            email: email,
            password: password,
          },
          success: function(data) {
            data = jQuery.parseJSON(data);
            if (data.status == true) {
              location.reload();
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Sepertinya anda memasukkan email atau password yang salah.',
                // footer: '<a href>Why do I have this issue?</a>'
              })
            }
          }
        });
      });
    });
  </script>
</body>

</html>