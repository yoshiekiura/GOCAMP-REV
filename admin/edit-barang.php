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
  <link rel="stylesheet" href="./plugins/ekko-lightbox/ekko-lightbox.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="./plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
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
              <a href="./barang.php" class="nav-link active">
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
              <h3 class="card-title">Data Barang</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <?php
            $current_url = base64_encode($url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME']);
            if (isset($_GET['id'])) {
              $id = $_GET['id'];
            } else {
              $id = "";
            }
            $ambil = $koneksi->query("SELECT * FROM tbl_barang WHERE id_barang='" . $id . "'");
            $pecah = $ambil->fetch_array();
            ?>
            <div class="card-body">
              <div class="form-group">
                <label for="ID Barang">ID Barang</label>
                <input type="text" id="idbarang" class="form-control" value="<?php echo $pecah['id_barang'] ?>" disabled>
              </div>
              <div class="form-group">
                <label for="inputName">Nama Barang</label>
                <input type="text" id="namabarang" class="form-control" value="<?php echo $pecah['nama_barang'] ?>">
              </div>
              <div class="form-group">
                <label for="inputDescription">Deskripsi Barang</label>
                <textarea id="deskripsibarang" class="form-control" rows="4"><?php echo $pecah['deskripsi_barang'] ?></textarea>
              </div>
              <div class="form-group">
                <label for="inputStatus">Kategori</label>
                <select class="form-control custom-select" id="kategoribarang">
                  <?php $ambilCat = $koneksi->query("SELECT * FROM tbl_kategoribarang");
                  while ($pecahCat = $ambilCat->fetch_array()) {
                    echo '<option value="' . $pecahCat['id_kategoriBarang'] . '">' . $pecahCat['nama_kategoriBarang'] . '</option>';
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="inputHarga">Harga Barang</label>
                <input type="number" id="hargabarang" class="form-control" value="<?php echo $pecah['harga_barang'] ?>">
              </div>
              <div class="form-group">
                <label for="stokHarga">Stok Barang</label>
                <input type="number" id="stokbarang" class="form-control" value="<?php echo $pecah['stok_barang'] ?>">
              </div>
              <div class="form-group">
                <label for="customFile">Upload Foto</label>

                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="gambar[]" multiple id="customFile">
                  <label class="custom-file-label d-inline-block text-truncate" for="customFile">Upload Foto</label>
                </div>
              </div>
            </div>
            <div class="col-12 mb-2">
              <a href="#" class="btn btn-secondary">Batal</a>
              <button type="submit" id="simpan" class="btn btn-success float-right">Simpan</button>
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
                  <a href="../img/<?php echo $pecah['foto_barang'] ?>" data-toggle="lightbox" data-title="<?php echo $pecah['nama_barang'] ?>" data-gallery="gallery">
                    <img src="../img/<?php echo $pecah['foto_barang'] ?>" class="img-fluid mb-2" alt="white sample" />
                  </a>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Foto Barang</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body p-0">
              <table class="table">
                <thead>
                  <tr>
                    <th>Nama Foto</th>
                    <th>Ukuran Foto</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>

                  <tr>
                    <td>Functional-requirements.docx</td>
                    <td>49.8005 kb</td>
                    <td class="text-right py-0 align-middle">
                      <div class="btn-group btn-group-sm">
                        <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                        <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                      </div>
                    </td>
                  <tr>
                    <td>UAT.pdf</td>
                    <td>28.4883 kb</td>
                    <td class="text-right py-0 align-middle">
                      <div class="btn-group btn-group-sm">
                        <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                        <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                      </div>
                    </td>
                  <tr>
                    <td>Email-from-flatbal.mln</td>
                    <td>57.9003 kb</td>
                    <td class="text-right py-0 align-middle">
                      <div class="btn-group btn-group-sm">
                        <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                        <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                      </div>
                    </td>
                  <tr>
                    <td>Logo.png</td>
                    <td>50.5190 kb</td>
                    <td class="text-right py-0 align-middle">
                      <div class="btn-group btn-group-sm">
                        <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                        <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                      </div>
                    </td>
                  <tr>
                    <td>Contract-10_12_2014.docx</td>
                    <td>44.9715 kb</td>
                    <td class="text-right py-0 align-middle">
                      <div class="btn-group btn-group-sm">
                        <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                        <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                      </div>
                    </td>

                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
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
  <!-- SweetAlert2 -->
  <script src="./plugins/sweetalert2/sweetalert2.min.js"></script>
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

      $('.btn[data-filter]').on('click', function() {
        $('.btn[data-filter]').removeClass('active');
        $(this).addClass('active');
      });
    });
    $(document).ready(function() {
      bsCustomFileInput.init();
    });

    $(document).ready(function() {
      $('#simpan').on('click', function() {
        var idbarang = $('#idbarang').val();
        var namabarang = $('#namabarang').val();
        var deskripsibarang = $('#deskripsibarang').val();
        var kategoribarang = $('#kategoribarang option:selected').val();
        var hargabarang = $('#hargabarang').val();
        var stokbarang = $('#stokbarang').val();
        // alert(email_user+alamat_user+nama_user+id_user);
        $.ajax({
          url: "edit-barang-action.php",
          type: "POST",
          data: {
            simpan: "yes",
            namabarang: namabarang,
            deskripsibarang: deskripsibarang,
            kategoribarang: kategoribarang,
            hargabarang: hargabarang,
            stokbarang: stokbarang,
            idbarang: idbarang
          },
          success: function(data) {
            data = jQuery.parseJSON(data);
            // alert(data);
            if (data.status == "sukses") {
              Swal.fire(
                'Sukses!',
                'Data berhasil diperbarui',
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
    });
  </script>
</body>

</html>