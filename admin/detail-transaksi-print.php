<?php
include('./session.php');
?>
<!DOCTYPE html>
<html>

<?php
include('../config/koneksi.php');
?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Invoice</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4 -->

  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body>
  <div class="wrapper">
    <!-- Main content -->
    <?php
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $ambil = $koneksi->query("SELECT * FROM tbl_peminjaman JOIN tbl_user ON tbl_peminjaman.id_user=tbl_user.id_user WHERE id_peminjaman='" . $id . "'");
      $pecah = $ambil->fetch_array();

      ?>
      <section class="invoice">
        <!-- title row -->
        <div class="row">
          <div class="col-12">
            <h2 class="page-header">
              <i class="fas fa-globe"></i> AdminLTE, Inc.
              <small class="float-right">Date: 2/10/2014</small>
            </h2>
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
            <p class="lead">Metode Pembayaran:</p>
            <h1><?php echo $pecah['metode_pembayaran'] ?></h1>

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
      <?php } ?>
      </section>
      <!-- /.content -->
  </div>
  <!-- ./wrapper -->

  <script type="text/javascript">
    window.addEventListener("load", window.print());
  </script>
</body>

</html>