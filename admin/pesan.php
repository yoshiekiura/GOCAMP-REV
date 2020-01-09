<?php
include('./session.php');
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PESAN</title>
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
  <!-- summernote -->
  <link rel="stylesheet" href="./plugins/summernote/summernote-bs4.css">
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
          <a href="./index.php" class="nav-link">
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
              <a href="./pelanggan.php" class="nav-link">
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
          <a href="./setting.php" class="nav-link active">
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
            <h1>Pesan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Beranda</a></li>
              <li class="breadcrumb-item active">Setting</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <?php
          $ambil = $koneksi->query("SELECT * FROM tbl_setting");
          $pecah = $ambil->fetch_array();
          ?>
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Lupa Password</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <?php
              if (!file_exists("./config/lupapassword.txt")) {
                $fp = fopen("./config/lupapassword.txt", "wb");
                if ($fp == false) {
                  header('Location: pesan.php?status=nothingconfig');
                } else {
                  fwrite($fp, "");
                  fclose($fp);
                }
              } else {
                $files = fopen("./config/lupapassword.txt", "rb");
                $lupapassword = fgets($files);
              }
              ?>
              <div class="card-body">
                <div class="form-group">
                  <label for="pesansms">Pesan</label>
                  <textarea class="textarea" id="pesanfpassword" name="pesanfpassword" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $lupapassword ?></textarea>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" id="lupapassword" class="btn btn-primary">Submit</button>
                <button type="submit" name="resetlupapassword" id="reset-smtp" class="btn btn-danger">Reset</button>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Daftar</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <?php
              if (!file_exists("./config/daftar.txt")) {
                $fp = fopen("./config/daftar.txt", "wb");
                if ($fp == false) {
                  header('Location: pesan.php?status=nothingconfig');
                } else {
                  fwrite($fp, "");
                  fclose($fp);
                }
              } else {
                $files = fopen("./config/daftar.txt", "rb");
                $daftar = fgets($files);
              }
              ?>
              <div class="card-body">
                <div class="form-group">
                  <label for="pesansms">Pesan</label>
                  <textarea class="textarea" id="pesandaftar" name="pesanemail" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $daftar ?></textarea>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" id="daftarsubmit" class="btn btn-primary">Submit</button>
                <button type="submit" name="resetdaftar" id="reset-smtp" class="btn btn-danger">Reset</button>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">SMS</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <?php
              if (!file_exists("./config/sms.txt")) {
                $fp = fopen("./config/sms.txt", "wb");
                if ($fp == false) {
                  header('Location: pesan.php?status=nothingconfig');
                } else {
                  fwrite($fp, "");
                  fclose($fp);
                }
              } else {
                $files = fopen("./config/sms.txt", "rb");
                $sms = fgets($files);
              }
              ?>
              <div class="card-body">
                <div class="form-group">
                  <label for="pesansms">Pesan</label>
                  <textarea class="textarea" id="pesansms" name="pesanemail" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $sms ?></textarea>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" id="smssubmit" class="btn btn-primary">Submit</button>
                <button type="submit" name="resetsms" id="reset-smtp" class="btn btn-danger">Reset</button>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.1
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>

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
  <!-- bs-custom-file-input -->
  <script src="./plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <!-- Bootstrap Switch -->
  <script src="./plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="./plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Summernote -->
  <script src="./plugins/summernote/summernote-bs4.min.js"></script>
  <!-- AdminLTE App -->
  <script src="./dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="./dist/js/demo.js"></script>
  <script type="text/javascript">
    $(function() {
      // Summernote
      $('#pesansms').summernote({
        placeholder: 'Masukkan pesan SMS anda.',
        tabsize: 2,
        height: 200
      })
      $('#pesanfpassword').summernote({
        placeholder: 'Masukkan pesan SMS anda.',
        tabsize: 2,
        height: 200
      })
      $('#pesandaftar').summernote({
        placeholder: 'Masukkan pesan Email anda.',
        tabsize: 2,
        height: 200
      })
    })

    $('#lupapassword').click(function() {
      var pesanfpassword = $('#pesanfpassword').val();
      $.ajax({
        url: "pesan-action.php",
        type: "POST",
        data: {
          lupapassword: "submit",
          pesanfpassword: pesanfpassword
        },
        success: function(data) {
          data = jQuery.parseJSON(data);
          if (data.status == "sukses") {
            Swal.fire(
              'Berhasil!',
              'Pesan lupa password berhasil diperbarui.',
              'info'
            ).then((result) => {
              if (result.value) {
                location.reload();
              }
            })
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Sepertinya ada yang salah.',
              // footer: '<a href>Why do I have this issue?</a>'
            })
          }
        }
      });
    });

    $('#daftarsubmit').click(function() {
      var pesanfdaftar = $('#pesandaftar').val();
      $.ajax({
        url: "pesan-action.php",
        type: "POST",
        data: {
          daftar: "submit",
          pesanfdaftar: pesanfdaftar
        },
        success: function(data) {
          data = jQuery.parseJSON(data);
          if (data.status == "sukses") {
            Swal.fire(
              'Berhasil!',
              'Pesan daftar berhasil diperbarui.',
              'info'
            ).then((result) => {
              if (result.value) {
                location.reload();
              }
            })
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Sepertinya ada yang salah.',
              // footer: '<a href>Why do I have this issue?</a>'
            })
          }
        }
      });
    });

    $('#smssubmit').click(function() {
      var pesansms = $('#pesansms').val();
      $.ajax({
        url: "pesan-action.php",
        type: "POST",
        data: {
          sms: "submit",
          pesansms: pesansms
        },
        success: function(data) {
          data = jQuery.parseJSON(data);
          if (data.status == "sukses") {
            Swal.fire(
              'Berhasil!',
              'Pesan SMS berhasil diperbarui.',
              'info'
            ).then((result) => {
              if (result.value) {
                location.reload();
              }
            })
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Sepertinya ada yang salah.',
              // footer: '<a href>Why do I have this issue?</a>'
            })
          }
        }
      });
    });
  </script>
</body>

</html>