<?php
include('./session.php');
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Invoice</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
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
          <a href="./index.php" class="nav-link active">
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
            <h1>Detail Transaksi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
              <li class="breadcrumb-item active">Detail Transaksi</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
              Page ini dapat dicetak, untuk mencetak silahkan pencet tombol "CETAK" dipojok kiri bawah.
            </div>

            <?php
            if (isset($_GET['id'])) {
              $id = $_GET['id'];
              $ambil = $koneksi->query("SELECT * FROM tbl_peminjaman JOIN tbl_user ON tbl_peminjaman.id_user=tbl_user.id_user WHERE id_peminjaman='" . $id . "'");
              $pecah = $ambil->fetch_array();

              ?>
              <!-- Main content -->
              <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                  <div class="col-12">
                    <h4>
                      <i class="fas fa-globe"></i> GoCamp, Inc.
                      <small class="float-right">Date: <?php echo $pecah['tgl_booking'] ?></small>
                    </h4>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                  <div class="col-sm-4 invoice-col">
                    Dari
                    <address>
                      <strong>GoCamp, Inc.</strong><br>
                      Jalan Pattimura<br>
                      Kaliwates, Jember 68133<br>
                      Telepon: 085959591196<br>
                      Email: info@gocampjember.com
                    </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 invoice-col">
                    Kepada
                    <address>
                      <strong><?php echo $pecah['nama_user'] ?></strong><br>
                      <?php echo $pecah['alamat_user'] ?><br>
                      Telepon: <?php echo $pecah['nohp_user'] ?><br>
                      Email: <?php echo $pecah['email_user'] ?>
                    </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 invoice-col">
                    <b>Invoice #<?php echo $pecah['id_peminjaman'] ?></b><br>
                    <br>
                    <b>Transaksi ID:</b> <?php echo $pecah['id_peminjaman'] ?><br>
                    <b>Tanggal Pinjam:</b> <?php echo $pecah['tgl_booking'] ?><br>
                    <b>Status:</b> <?php echo $pecah['status_peminjaman'] ?><br>
                    <b>Metode Pembayaran:</b> <?php echo $pecah['metode_pembayaran'] ?>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                  <div class="col-12 table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Kode Barang</th>
                          <th>Nama Barang</th>
                          <th>Jumlah</th>
                          <th>Harga</th>
                          <th>Subtotal</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $ambilKatalog = $koneksi->query("SELECT * FROM tbl_detailpeminjaman JOIN tbl_barang ON tbl_detailpeminjaman.id_barang = tbl_barang.id_barang WHERE id_peminjaman='" . $id . "'");
                          $subtotal = 0;
                          while ($pecahKatalog = $ambilKatalog->fetch_array()) { ?>
                          <tr>
                            <td><?php echo $pecahKatalog['id_barang'] ?></td>
                            <td><?php echo $pecahKatalog['nama_barang'] ?></td>
                            <td><?php echo $pecahKatalog['jumlah_detailBarang'] ?></td>
                            <td><?php echo rupiah($pecahKatalog['harga_barang']) ?></td>
                            <td><?php echo rupiah($subtotal = $pecahKatalog['harga_barang'] * $pecahKatalog['jumlah_detailBarang']) ?></td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                  <!-- accepted payments column -->
                  <div class="col-6">
                    <p class="lead">Keterangan:</p>

                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                      Jangan lupa membawa KTP atau Kartu Identitas saat pengambilan barang.
                    </p>
                  </div>
                  <!-- /.col -->
                  <div class="col-6">
                    <p class="lead">Amount Due <?php echo $pecah['tgl_booking'] ?></p>

                    <div class="table-responsive">
                      <table class="table">
                        <tr>
                          <th style="width:50%">Subtotal:</th>
                          <td><?php echo rupiah($subtotal) ?></td>
                        </tr>
                        <tr>
                          <th>Durasi Pinjam</th>
                          <td><?php echo $pecah['durasi_peminjaman'] ?></td>
                        </tr>
                        <tr>
                          <th>Total:</th>
                          <td><?php echo rupiah($subtotal * $pecah['durasi_peminjaman']) ?></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                  <div class="col-12">
                    <a href="detail-transaksi-print.php?id=<?php echo $pecah['id_peminjaman'] ?>" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                    <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                      Payment
                    </button>
                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                      <i class="fas fa-download"></i> Generate PDF
                    </button>
                  </div>
                </div>
              </div>
            <?php } else { ?>
              <h1>TIDAK ADA BARANG</h1>
            <?php } ?>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
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
  <!-- AdminLTE for demo purposes -->
  <script src="./dist/js/demo.js"></script>
</body>

</html>