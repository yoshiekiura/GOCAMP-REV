<?php
include('./session.php');
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>AdminLTE 3 | DataTables</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css" />
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
  <!-- DataTables -->
  <link rel="stylesheet" href="./plugins/datatables-bs4/css/dataTables.bootstrap4.css" />
  <!-- daterange picker -->
  <link rel="stylesheet" href="./plugins/daterangepicker/daterangepicker.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="./plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="./plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="./plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css" />
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet" />
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
          <a href="./transaksi.php" class="nav-link active">
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
            <h1>Transaksi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Transaksi</li>
            </ol>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="input-group" id="export">
                <button type="button" class="btn btn-default float-right" id="daterange-btn">
                  <i class="far fa-calendar-alt"></i> Export
                  <i class="fas fa-caret-down"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Pilih</th>
                    <th>Kode</th>
                    <th>Nama Pelanggan</th>
                    <th>Tgl Booking</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Perintah</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $current_url = base64_encode($url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME']);
                  $ambil = $koneksi->query("SELECT * FROM tbl_peminjaman JOIN tbl_user ON tbl_peminjaman.id_user=tbl_user.id_user");
                  while ($pecah = $ambil->fetch_array()) { ?>
                    <tr>
                      <td>
                        <input type="checkbox" name="pilih[]" id="pilih" />
                      </td>
                      <td><?php echo $pecah['id_peminjaman'] ?></td>
                      <td><?php echo $pecah['nama_user'] ?></td>
                      <td><?php echo $pecah['tgl_booking'] ?></td>
                      <td><?php echo $pecah['status_peminjaman'] ?></td>
                      <td><?php echo rupiah($pecah['total_harga']) ?></td>
                      <td class="d-inline-block text-truncate">
                        <a class="btn btn-info btn-sm" href="edit-transaksi.php?id=<?php echo $pecah['id_peminjaman'] ?>">
                          <i class="fas fa-pencil-alt">
                          </i>
                          Edit
                        </a>
                        <a class="btn btn-danger btn-sm" href="./deleted.php?utm_source=transaksi&id_peminjaman=<?php echo $pecah['id_peminjaman'] ?>&return=<?php echo $current_url ?>">
                          <i class="fas fa-trash">
                          </i>
                          Delete
                        </a>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Pilih</th>
                    <th>Kode</th>
                    <th>Nama Pelanggan</th>
                    <th>Tgl Booking</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Perintah</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
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
  <!-- DataTables -->
  <script src="./plugins/datatables/jquery.dataTables.js"></script>
  <script src="./plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
  <!-- AdminLTE App -->
  <script src="./dist/js/adminlte.min.js"></script>
  <!-- InputMask -->
  <script src="./plugins/moment/moment.min.js"></script>
  <script src="./plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
  <!-- Select2 -->
  <script src="./plugins/select2/js/select2.full.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="./plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- date-range-picker -->
  <script src="./plugins/daterangepicker/daterangepicker.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="./dist/js/demo.js"></script>
  <!-- page script -->
  <script>
    $(function() {
      $("#example1").DataTable();
      $("#example2").DataTable({
        paging: true,
        lengthChange: false,
        searching: false,
        ordering: true,
        info: true,
        autoWidth: false
      });
      $('#daterange-btn').daterangepicker({
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function(start, end) {
          // $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
          // alert(start.format('YYYY-M-D') + ' - ' + end.format('YYYY-M-D'));
          $.ajax({
            url: "export.php",
            type: "POST",
            data: {
              export: true,
              start: start.format('YYYY-M-D'),
              end: end.format('YYYY-M-D'),
            },
            success: function(data) {
              data = JSON.parse(JSON.stringify(data))
              if (data.status == true) {
                alert("berhasil");
                var htmls = "";
                var uri = 'data:application/vnd.ms-excel;base64,';
                var template = data.html;
                var base64 = function(s) {
                  return window.btoa(unescape(encodeURIComponent(s)))
                };

                var format = function(s, c) {
                  return s.replace(/{(\w+)}/g, function(m, p) {
                    return c[p];
                  })
                };

                htmls = "YOUR HTML AS TABLE";

                var ctx = {
                  worksheet: 'Worksheet',
                  table: htmls
                }


                var link = document.createElement("a");
                link.download = start+".xls";
                link.href = uri + base64(format(template, ctx));
                link.click();
              }
            }
          });
        }
      )
      // $('#masuk').on('click', function() {
      //   var email = $('#email').val();
      //   var password = $('#password').val();
      //   $.ajax({
      //     url: "login-action.php",
      //     type: "POST",
      //     data: {
      //       email: email,
      //       password: password,
      //     },
      //     success: function(data) {
      //       data = jQuery.parseJSON(data);
      //       if (data.status == true) {
      //         location.reload();
      //       } else {
      //         Swal.fire({
      //           icon: 'error',
      //           title: 'Oops...',
      //           text: 'Sepertinya anda memasukkan email atau password yang salah.',
      //           // footer: '<a href>Why do I have this issue?</a>'
      //         })
      //       }
      //     }
      //   });
      // });
    });
  </script>
</body>

</html>