<?php
include('./session.php');
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Project Edit</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="./pages/plugins/ekko-lightbox/ekko-lightbox.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
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
        <li class="nav-item has-treeview menu-open">
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
              <a href="./paket-barang.php" class="nav-link active">
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
            <h1>Tambah Barang</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Detail Barang</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Data Paket Barang</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <form action="paket-barang-action.php" role="form" method="post" enctype="multipart/form-data">
              <div class="card-body">
                <div class="form-group">
                  <label for="inputName">Nama Paket Barang</label>
                  <input type="text" id="inputName" name="namaPaket" class="form-control" placeholder="Masukkan nama barang">
                </div>
                <div class="form-group">
                  <label for="inputDescription">Deskripsi Paket Barang</label>
                  <textarea id="inputDescription" name="deskripsiPaket" class="form-control" rows="4"> </textarea>
                </div>
                <div class="form-group">
                  <label for="inputStatus">Kategori</label>
                  <select class="form-control custom-select" name="kategoriPaket">
                    <?php $ambil = $koneksi->query("SELECT * FROM tbl_kategoribarang");
                    while ($pecah = $ambil->fetch_array()) {
                      echo '<option>' . $pecah['nama_kategoriBarang'] . '</option>';
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="inputPaket">Barang</label>
                  <select class="form-control custom-select" id="pilihBarang" name="pilihBarang">
                    <?php $ambil = $koneksi->query("SELECT * FROM tbl_barang");
                    while ($pecah = $ambil->fetch_array()) {
                      echo '<option value="' . $pecah['id_barang'] . '">' . $pecah['nama_barang'] . '</option>';
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="inputHarga">Harga Paket Barang</label>
                  <input type="number" id="inputHarga" name="hargaPaket" class="form-control" placeholder="Masukkan harga barang">
                </div>
                <div class="form-group">
                  <label for="stokHarga">Stok Paket Barang</label>
                  <input type="number" id="stokHarga" name="stokPaket" class="form-control" placeholder="Masukkan stok barang">
                </div>
                <div class="form-group">
                  <label for="customFile">Upload Foto</label>

                  <div class="custom-file">
                    <input type="file" id="fotoBarang" class="custom-file-input" name="fotoPaket[]" multiple>
                    <label class="custom-file-label d-inline-block text-truncate" for="customFile">Upload Foto</label>
                  </div>
                </div>
              </div>

              <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-6">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Foto Barang</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <a href="https://via.placeholder.com/1200/FFFFFF.png?text=1" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery">
                    <img src="#" class="img-fluid mb-2" id="preview0" alt="white sample" />
                  </a>
                </div>
                <div class="col-sm-3">
                  <a href="https://via.placeholder.com/1200/000000.png?text=2" data-toggle="lightbox" data-title="sample 2 - black" data-gallery="gallery">
                    <img src="#" class="img-fluid mb-2" id="preview1" alt="white sample" />
                  </a>
                </div>
                <div class="col-sm-3">
                  <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=3" data-toggle="lightbox" data-title="sample 3 - red" data-gallery="gallery">
                    <img src="#" class="img-fluid mb-2" id="preview2" alt="white sample" />
                  </a>
                </div>
                <div class="col-sm-3">
                  <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=4" data-toggle="lightbox" data-title="sample 4 - red" data-gallery="gallery">
                    <img src="#" class="img-fluid mb-2" id="preview3" alt="white sample" />
                  </a>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Daftar Paket Barang</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <table class="table table-condensed">
                <thead>
                  <tr>
                    <th style="width: 10px">Kode</th>
                    <th>Nama Barang</th>
                    <th>Perintah</th>
                  </tr>
                </thead>
                <tbody id="showPaketBarang">
                  <?php if (isset($_SESSION['paketbarang'])) {
                    foreach ($_SESSION['paketbarang'] as $id_barang => $jumlah) {
                      $ambil = $koneksi->query("SELECT * FROM tbl_barang WHERE id_barang='$id_barang'") or die("Last error: {$koneksi->error}\n");
                      $pecah = $ambil->fetch_array(); ?>
                      <tr>
                        <td id='td_id'><?php echo $id_barang ?></td>
                        <td><?php echo $pecah['nama_barang'] ?></td>
                        <td><a class="btn btn-danger btn-sm" id="hapuspaket" href="#"><i class="fas fa-trash"> </i>Delete</a></td>
                      </tr>
                  <?php }
                  } ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <div id="message">
        <div class="row">
          <div class="col-12">
            <a href="#" class="btn btn-secondary">Cancel</a>
            <input type="submit" value="Save Changes" name="submit" class="btn btn-success float-right">
          </div>
          </form>
        </div>
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
  <!-- jQuery UI -->
  <script src="./plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Ekko Lightbox -->
  <script src="./plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
  <!-- bs-custom-file-input -->
  <script src="./plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <!-- AdminLTE App -->
  <script src="./dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="./dist/js/demo.js"></script>
  <!-- Page specific script -->
  <script>
    $(function() {
      $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({
          alwaysShowClose: true
        });
      });

      $('.filter-container').filterizr({
        gutterPixels: 3
      });
      $('.btn[data-filter]').on('click', function() {
        $('.btn[data-filter]').removeClass('active');
        $(this).addClass('active');
      });
    });
    $(document).ready(function() {
      bsCustomFileInput.init();
    });

    function readURL(input) {
      var filesAmount = input.files.length;
      for (i = 0; i < filesAmount; i++) {
        if (input.files && input.files[i]) {
          var reader = new FileReader();

          reader.onload = function(e) {
            $("#preview" + i).attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[i]);
        }
      }
    }

    $("#fotoBarang").change(function() {
      readURL(this);
    });


    $(document).ready(function() {
      $('#pilihBarang').on('change', function() {
        var id = $(this).parent().find('#pilihBarang option:selected').val();
        var nama = $(this).parent().find('#pilihBarang option:selected').text();
        $.ajax({
          url: "paket-barang-action.php",
          type: "POST",
          data: {
            id_barang: id,
            tipe: 'add'
          },
          success: function(data) {
            var htmlToAppend = "<tr><td id='td_id'>" + id + "</td><td>" + nama + "</td>" + '<td><a class="btn btn-danger btn-sm" id="hapuspaket" href="#"><i class="fas fa-trash"> </i>Delete</a></td></tr>';
            $("#showPaketBarang").append(htmlToAppend);
          }
        });
      });
    });


    $(document).ready(function() {
      $('#showPaketBarang').on('click', '#hapuspaket', function() {
        var id_barang = $(this).closest('tr').children('#td_id').text();
        $.ajax({
          url: "paket-barang-action.php",
          type: "POST",
          data: {
            id_barang: id_barang,
            tipe: 'hapus'
          },
          success: function(data) {}
        });
        $(this).closest('tr').remove();
      });
    });

    $(document).ready(function() {
      $.ajax({
        url: "paket-barang-action.php",
        type: "POST",
        data: {
          tipe: 'reset'
        },
        success: function(data) {}
      });
    });
    // indirect ajax
    // file collection array
    // var fileCollection = new Array();
    // $('#fotoBarang').on('change', function(e) {
    //   var files = e.target.files;
    //   $.each(files, function(i, file) {
    //     fileCollection.push(file);
    //     var reader = new FileReader();
    //     reader.readAsDataURL(file);
    //     reader.onload = function(e) {
    //       $('#preview').attr('src', e.target.result);
    //     }
    //   });
    // });
  </script>
</body>

</html>