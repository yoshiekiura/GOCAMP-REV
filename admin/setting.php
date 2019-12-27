<?php
include('./session.php');
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | General Form Elements</title>
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
            <h1>Setting</h1>
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
                <h3 class="card-title">Site Setting</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label for="inputJudulWebsite">Judul Website</label>
                  <input type="text" id="inputJudulWebsite" class="form-control" placeholder="Masukkan Judul Website">
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">OVO Setting</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <form action="setting-action.php" method="post">
                  <div class="form-group">
                    <label for="exampleInputNoOVO">Nomor OVO</label>
                    <input type="tel" class="form-control" name="no_ovo" id="no_ovo" placeholder="Masukkan nomor OVO" value="<?php echo $pecah['no_ovo'] ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPIN">Pin OVO</label>
                    <input type="password" class="form-control" name="pin_ovo" id="exampleInputPIN" placeholder="Masukkan PIN OVO" value="<?php echo $pecah['pin_ovo'] ?>">
                  </div>
                  <?php
                  if (isset($_GET['status']) && isset($pecah['no_ovo']) && $_GET['status'] == 'otp') { ?>
                    <div class="form-group">
                      <label for="exampleInputVerifikasi">Kode Verifikasi</label>
                      <input type="password" class="form-control" name="kode_verifikasi" id="exampleInputVerifikasi" placeholder="Masukkan Kode Verifikasi OVO">
                    </div>
                    <input type="hidden" name="rand" value="<?php if (isset($_SESSION['rand'])) {
                                                              echo $_SESSION['rand'];
                                                            } ?>">
                  <?php } ?>
              </div>
              <div class="card-footer">
                <button type="submit" name="setting-ovo" class="btn btn-primary">Submit</button>
                <button type="submit" name="reset-ovo" class="btn btn-danger">Reset</button>
                <?php if (!file_exists("config.txt") && !empty($pecah['no_ovo'])) { ?>
                  <button type="submit" name="login-ovo" class="btn btn-success">Login</button>
                <?php } ?>
              </div>
              </form>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">SMTP Setting</h3>
                <div class="card-tools">
                  <?php
                  if (empty($pecah['smtp_status']) || $pecah['smtp_status'] == 0) {
                    echo '<input type="checkbox" id="smtp_status" data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                  } else {
                    echo '<input type="checkbox" id="smtp_status" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                  }
                  ?>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label for="inputSMTPServer">SMTP Server</label>
                  <input type="text" id="inputSMTPServer" class="form-control" placeholder="Masukkan SMTP Server" value="<?php echo $pecah['smtp_server'] ?>">
                </div>
                <div class="form-group">
                  <label for="inputSMTPUsername">SMTP Username</label>
                  <input type="text" id="inputSMTPUsername" class="form-control" placeholder="Masukkan SMTP Username" value="<?php echo $pecah['smtp_username'] ?>">
                </div>
                <div class="form-group">
                  <label for="inputSMTPPassword">SMTP Password</label>
                  <input type="password" id="inputSMTPPassword" class="form-control" placeholder="Masukkan SMTP Password" value="<?php echo $pecah['smtp_password'] ?>">
                </div>
                <div class="form-group">
                  <label for="inputSMTPPort">SMTP Port</label>
                  <select class="form-control custom-select" id="smtpport">
                    <option selected disabled><?php if (!empty($pecah['smtp_port'])) {
                                                echo $pecah['smtp_port'];
                                              } else {
                                                echo "Pilih SMTP Port";
                                              } ?></option>
                    <option>465</option>
                    <option>587</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="inputSMTPSecure">SMTP Secure</label>
                  <select class="form-control custom-select" id="smtpsecure">
                    <option selected disabled><?php if (!empty($pecah['smtp_secure'])) {
                                                echo $pecah['smtp_secure'];
                                              } else {
                                                echo "Pilih SMTP Secure";
                                              } ?></option>
                    <option>TLS</option>
                    <option>SSL</option>
                  </select>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" id="smtpsubmit" class="btn btn-primary">Submit</button>
                <button type="submit" name="reset-smtp" id="reset-smtp" class="btn btn-danger">Reset</button>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">SMS Gateway</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label for="inputSMSAPI">SMS API</label>
                  <input type="text" id="smsapi" class="form-control" placeholder="Masukkan SMS API" value="<?php echo $pecah['api_sms'] ?>">
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" name="sms-api" id="sms-api" class="btn btn-primary">Submit</button>
                <button type="submit" name="resetsms" id="resetsms" class="btn btn-danger">Reset</button>
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
    $(document).ready(function() {
      bsCustomFileInput.init();
    });

    $("input[data-bootstrap-switch]").each(function() {
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
      $("input[data-bootstrap-switch]").on('switchChange.bootstrapSwitch', function() {
        // var status = $(this).attr("checked");
        if ($(this).attr("checked")) {
          status = 0;
        } else {
          status = 1;
        }
        $.ajax({
          url: 'setting-action.php',
          method: 'post',
          data: 'value=' + status,
          success: function(data) {
            // alert("Auto Reply has been Turned On");
            location.reload();
            // location.load('setting.php');
          },
          error: function() {}
        });
      });
    });

    $('#reset-smtp').click(function() {
      $.ajax({
        url: "setting-action.php",
        type: "POST",
        data: {
          resetsmtp: "submit",
        },
        success: function(data) {
          data = jQuery.parseJSON(data);
          if (data.status == "sukses") {
            Swal.fire(
              'Direset!',
              'Pengaturan SMTP berhasil direset.',
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

    $('#resetsms').click(function() {
      $.ajax({
        url: "setting-action.php",
        type: "POST",
        data: {
          resetsms: "submit",
        },
        success: function(data) {
          data = jQuery.parseJSON(data);
          if (data.status == "sukses") {
            Swal.fire(
              'Direset!',
              'Pengaturan SMS API berhasil direset.',
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

    $('#smtpsubmit').click(function() {
      var smtpserver = $('#inputSMTPServer').val();
      var smtpusername = $('#inputSMTPUsername').val();
      var smtppassword = $('#inputSMTPPassword').val();
      var smtpport = $('#smtpport option:selected').text();
      var smtpsecure = $('#smtpsecure option:selected').text();
      $.ajax({
        url: "setting-action.php",
        type: "POST",
        data: {
          smtpserver: smtpserver,
          smtpusername: smtpusername,
          smtppassword: smtppassword,
          smtpport: smtpport,
          smtpsecure: smtpsecure,
        },
        success: function(data) {
          data = jQuery.parseJSON(data);
          if (data.status == "sukses") {
            Swal.fire(
              'Diperbarui!',
              'Pengaturan SMTP berhasil diperbarui.',
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

    $('#sms-api').click(function() {
      var smsapi = $('#smsapi').val();
      $.ajax({
        url: "setting-action.php",
        type: "POST",
        data: {
          smsapi: smsapi,
        },
        success: function(data) {
          data = jQuery.parseJSON(data);
          if (data.status == "sukses") {
            Swal.fire(
              'Diperbarui!',
              'SMS API berhasil diperbarui.',
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
    // $("[name='auto_reply']").bootstrapSwitch();
    // $(document).ready(function() {
    //   $("[name='auto_reply']").on('switchChange.bootstrapSwitch', function() {
    //     var currentValue = $(this).attr("value");
    //     var station = $(this).attr("id");
    //     $.ajax({
    //       url: 'updateReplyFlag',
    //       method: 'post',
    //       data: {
    //         id: currentValue,
    //         _token: $('input[name="_token"]').val(),
    //         reply_flag: currentValue,
    //         station: station
    //       },
    //       success: function(data) {
    //         alert("Auto Reply has been Turned On");
    //       },
    //       error: function() {}
    //     });
    //   });
    // });


    // $('input[data-bootstrap-switch]').click(function() {
    //   var mode = $(this).prop('checked');
    //   // // submit the form 
    //   // $(#myForm).ajaxSubmit(); 
    //   // // return false to prevent normal browser submit and page navigation 
    //   // return false; 
    //   if ($(this).prop('checked')) {
    //     status = 0;
    //   } else {
    //     status = 1;
    //   }
    //   $.ajax({
    //     type: 'POST',
    //     url: 'setting-action.php',
    //     data: 'value=' + status,
    //     success: function(data) {
    //       alert(fata);
    //     },
    //     error: function() {}
    //   });
    // });
  </script>
</body>

</html>