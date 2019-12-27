<?php
include('./session.php');
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | User Profile</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="./plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <?php
    include('includes/nav.php');
    ?>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="./" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Beranda</p>
          </a>
        </li>
        </li>
        <li class="nav-item">
          <a href="./transaksi.php" class="nav-link">
            <i class="nav-icon fas fa-exchange-alt"></i>
            <p>Transaksi</p>
          </a>
        </li>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Barang
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="./barang.php" class="nav-link">
                <i class="fas fa-table nav-icon"></i>
                <p>Daftar Barang</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./tambah-barang.php" class="nav-link">
                <i class="far fa-plus-square nav-icon"></i>
                <p>Tambah Barang</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./paket-barang.php" class="nav-link">
                <i class="fas fa-plus nav-icon"></i>
                <p>Tambah Paket Barang</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./kategori.php" class="nav-link">
                <i class="fas fa-plus-circle nav-icon"></i>
                <p>Kategori Barang</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Pelanggan
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="./pelanggan.php" class="nav-link active">
                <i class="fas fa-table nav-icon"></i>
                <p>Data Pelanggan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./tambah-pelanggan.php" class="nav-link">
                <i class="fas fa-user-plus nav-icon"></i>
                <p>Tambah Pelanggan</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="./setting.php" class="nav-link">
            <i class="nav-icon fas fa-cogs"></i>
            <p>Pengaturan</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <?php
    $ambil = $koneksi->query("SELECT * FROM tbl_admin");
    $pecah = $ambil->fetch_array();
    ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="./dist/img/user4-128x128.jpg" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?php echo $pecah['nama_admin'] ?></h3>

                <p class="text-muted text-center">Admin</p>
                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Pengaturan</a></li>
                  <li class="nav-item"><a class="nav-link " href="#changepassword" data-toggle="tab">Ubah Password</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="settings">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputNama" value="<?php echo $pecah['nama_admin'] ?>" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" value="<?php echo $pecah['email_admin'] ?>" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Telepom</label>
                        <div class="col-sm-10">
                          <input type="tel" class="form-control" id="inputtelepon" value="<?php echo $pecah['nohp_admin'] ?>" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" id="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="changepassword">
                      <div class="form-group row">
                        <label for="inputOldPassword" class="col-sm-4 col-form-label">Password Lama</label>
                        <div class="col-sm-6">
                          <input type="password" class="form-control" id="OldPassword" placeholder="Masukkan password lama anda">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputNewPassword" class="col-sm-4 col-form-label">Password Baru</label>
                        <div class="col-sm-6">
                          <input type="password" class="form-control" id="NewPassword" placeholder="Masukkan password baru anda">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputConfirmNewPassword" class="col-sm-4 col-form-label">Konfirmasi Password Baru</label>
                        <div class="col-sm-6">
                          <input type="password" class="form-control" id="ConfirmNewPassword" placeholder="Konfirmasi password baru anda">
                          <span id="msg"></span>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-4 col-sm-10">
                          <button type="submit" id="ubah" onclick="return valid();" class="btn btn-danger">Ubah</button>
                        </div>
                      </div>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
  include('includes/foot.php');
  ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="./plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="./dist/js/adminlte.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="./plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="./dist/js/demo.js"></script>

  <script>
    $(document).ready(function() {
      $("#ConfirmNewPassword").keyup(function() {
        if ($("#NewPassword").val() != $("#ConfirmNewPassword").val()) {
          $("#msg").html("Password tidak sama").css("color", "red");
          $("#ConfirmNewPassword").addClass("is-warning");
          $("#ConfirmNewPassword").removeClass("is-valid");
        } else {
          $("#NewPassword").addClass("is-valid");
          $("#ConfirmNewPassword").addClass("is-valid");
          $("#ConfirmNewPassword").removeClass("is-warning");
          $("#msg").remove();
        }
      });
    });

    function valid() {
      if ($("#NewPassword").val() != $("#ConfirmNewPassword").val()) {
        $("#ConfirmNewPassword").focus();
        return false;
      } else {
        return true;
      }
    }

    $('#ubah').click(function() {
      var OldPassword = $('#OldPassword').val();
      var NewPassword = $('#NewPassword').val();
      var ConfirmNewPassword = $('#ConfirmNewPassword').val();
      $.ajax({
        url: "profile-action.php",
        type: "POST",
        data: {
          action: "ubah",
          OldPassword: OldPassword,
          NewPassword: NewPassword,
          ConfirmNewPassword: ConfirmNewPassword,
        },
        success: function(data) {
          data = jQuery.parseJSON(data);
          if (data.status == "sukses") {
            Swal.fire(
              'Diperbarui!',
              'Profil anda berhasil diperbarui.',
              'success'
            ).then((result) => {
              if (result.value) {
                location.reload();
              }
            })
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Sepertinya anda memasukkan data yang salah.',
              // footer: '<a href>Why do I have this issue?</a>'
            })
          }
        }
      });
    });

    $('#submit').click(function() {
      var nama = $('#inputNama').val();
      var email = $('#inputEmail').val();
      var nohp = $('#inputtelepon').val();
      $.ajax({
        url: "profile-action.php",
        type: "POST",
        data: {
          action: "simpan",
          nama: nama,
          email: email,
          nohp: nohp,
        },
        success: function(data) {
          data = jQuery.parseJSON(data);
          if (data.status == "sukses") {
            Swal.fire(
              'Diperbarui!',
              'Password anda berhasil diperbarui.',
              'success'
            ).then((result) => {
              if (result.value) {
                location.reload();
              }
            })
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Sepertinya anda memasukkan data yang salah.',
              // footer: '<a href>Why do I have this issue?</a>'
            })
          }
        }
      });
    });
  </script>
</body>

</html>