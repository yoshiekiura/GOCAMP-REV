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
              <a href="./tambah-barang.php" class="nav-link active">
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
            <form action="barang-action.php" role="form" method="post" enctype="multipart/form-data">
              <div class="card-body">
                <div class="form-group">
                  <label for="inputName">Nama Barang</label>
                  <input type="text" id="inputName" name="namaBarang" class="form-control" placeholder="Masukkan nama barang">
                </div>
                <div class="form-group">
                  <label for="inputDescription">Deskripsi Barang</label>
                  <textarea id="inputDescription" name="deskripsiBarang" class="form-control" rows="4"> </textarea>
                </div>
                <div class="form-group">
                  <label for="inputStatus">Kategori</label>
                  <select class="form-control custom-select" name="kategoriBarang">
                    <?php $ambil = $koneksi->query("SELECT * FROM tbl_kategoribarang");
                    while ($pecah = $ambil->fetch_array()) {
                      echo '<option>' . $pecah['nama_kategoriBarang'] . '</option>';
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="inputHarga">Harga Barang</label>
                  <input type="number" id="inputHarga" name="hargaBarang" class="form-control" placeholder="Masukkan harga barang">
                </div>
                <div class="form-group">
                  <label for="stokHarga">Stok Barang</label>
                  <input type="number" id="stokHarga" name="stokBarang" class="form-control" placeholder="Masukkan stok barang">
                </div>
                <div class="form-group">
                  <label for="customFile">Upload Foto</label>

                  <div class="custom-file">
                    <input type="file" id="fotoBarang" class="custom-file-input" name="fotoBarang" multiple>
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
                <div class="col-sm-3" class="preview">
                  <a href="https://via.placeholder.com/1200/FFFFFF.png?text=1" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery">
                    <img src="#" class="img-fluid mb-2" id="thispreview" alt="white sample" />
                  </a>
                </div>
                <div class="col-sm-3">
                  <a href="https://via.placeholder.com/1200/000000.png?text=2" data-toggle="lightbox" data-title="sample 2 - black" data-gallery="gallery">
                    <img src="#" class="img-fluid mb-2" id="thispreview" alt="white sample" />
                  </a>
                </div>
                <div class="col-sm-3">
                  <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=3" data-toggle="lightbox" data-title="sample 3 - red" data-gallery="gallery">
                    <img src="#" class="img-fluid mb-2" id="thispreview" alt="white sample" />
                  </a>
                </div>
                <div class="col-sm-3">
                  <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=4" data-toggle="lightbox" data-title="sample 4 - red" data-gallery="gallery">
                    <img src="#" class="img-fluid mb-2" id="thispreview" alt="white sample" />
                  </a>
                </div>
              </div>
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

      $('.btn[data-filter]').on('click', function() {
        $('.btn[data-filter]').removeClass('active');
        $(this).addClass('active');
      });
    });
    $(document).ready(function() {
      bsCustomFileInput.init();
    });

    $('#fotoBarang').change(function() {
      var error_images = '';
      var form_data = new FormData();
      var files = $('#fotoBarang')[0].files;
      var anyWindow = window.URL || window.webkitURL;
      if (files.length > 10) {
        error_images += 'You can not select more than 10 files';
      } else {
        for (var i = 0; i < files.length; i++) {
          var name = document.getElementById("fotoBarang").files[i].name;
          var ext = name.split('.').pop().toLowerCase();
          if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
            error_images += '<p>Invalid ' + i + ' File</p>';
          }
          var oFReader = new FileReader();
          oFReader.readAsDataURL(document.getElementById("fotoBarang").files[i]);
          var f = document.getElementById("fotoBarang").files[i];
          var fsize = f.size || f.fileSize;
          if (fsize > 2000000) {
            error_images += '<p>' + i + ' File Size is very big</p>';
          } else {
            var reader = new FileReader();
            var target = null;

            reader.onload = function(e) {
              target = e.target || e.srcElement;
              $("img").prop("src", target.result);
              $("#thispreview" + i).attr('src', e.target.result);
            };
            reader.readAsDataURL(obj.files[0]);
          }
        }
      }
      if (error_images == '') {
        alert("monggo diupload");
        // console.log(form_data);
        // $.ajax({
        //   url: "upload.php",
        //   method: "POST",
        //   data: form_data,
        //   contentType: false,
        //   cache: false,
        //   processData: false,
        //   beforeSend: function() {
        //     $('#error_multiple_files').html('<br /><label class="text-primary">Uploading...</label>');
        //   },
        //   success: function(data) {
        //     $('#error_multiple_files').html('<br /><label class="text-success">Uploaded</label>');
        //     load_image_data();
        //   }
        // });
      } else {
        $('#fotoBarang').val('');
        // $('#error_multiple_files').html("<span class='text-danger'>" + error_images + "</span>");
        alert("gagal");
        return false;
      }
    });


    // function readURL(input) {
    //   var filesAmount = input.files.length;
    //   for (i = 0; i < filesAmount; i++) {
    //     if (input.files && input.files[i]) {
    //       var reader = new FileReader();

    //       reader.onload = function(e) {
    //         $("#preview" + i).attr('src', e.target.result);
    //       }

    //       reader.readAsDataURL(input.files[i]);
    //     }
    //   }
    // }

    // $("#fotoBarang").change(function() {
    //   readURL(this);
    // });

    // $(function() {
    //   // Multiple images preview in browser
    //   var imagesPreview = function(input, placeToInsertImagePreview) {

    //     if (input.files) {
    //       var filesAmount = input.files.length;

    //       for (i = 0; i < filesAmount; i++) {
    //         var reader = new FileReader();

    //         // reader.onload = function(event) {
    //         //   // $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
    //         //   $('#thispreview').attr('src', event.target.result).appendTo(placeToInsertImagePreview);
    //         // }
    //         reader.onload = (function(event) {
    //           console.log(event);
    //           return function(e) {
    //             // Here you can use `e.target.result` or `this.result`
    //             // and `f.name`.
    //             $('#thispreview').attr('src', event.target.result).appendTo(placeToInsertImagePreview);
    //             // $('#preview' + i).attr('src', e.target.result);
    //           };
    //         })(input.files[i]);

    //         reader.readAsDataURL(input.files[i]);
    //       }
    //     }

    //   };

    //   $('#fotoBarang').on('change', function() {
    //     imagesPreview(this, 'div.preview');
    //   });
    // });

    // function readURL(input) {
    //   for (var i = 0; i < input.files.length; i++) {

    //     if (input.files && input.files[i]) {
    //       var file = input.files[i];
    //       var reader = new FileReader();
    //       reader.onload = (function(f) {
    //         return function(e) {
    //           // Here you can use `e.target.result` or `this.result`
    //           // and `f.name`.
    //           $('#preview' + i).attr('src', e.target.result);
    //         };
    //       })(file);
    //       reader.readAsDataURL(file);
    //       // console.log(reader.readAsDataURL(input.files[0]));
    //     }
    //   }
    // }

    // $("#fotoBarang").change(function() {
    //   readURL(this);
    // });

    // $('#fotoBarang').change(function() {
    //   var error_images = '';
    //   var form_data = new FormData();
    //   var files = $('#fotoBarang')[0].files;
    //   if (files.length > 3) {
    //     error_images += 'You can not select more than 3 files';
    //   } else {
    //     for (var i = 0; i < files.length; i++) {
    //       var name = document.getElementById("fotoBarang").files[i].name;
    //       var ext = name.split('.').pop().toLowerCase();
    //       if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
    //         error_images += '<p>Invalid ' + i + ' File</p>';
    //       }
    //       var oFReader = new FileReader();
    //       oFReader.readAsDataURL(document.getElementById("fotoBarang").files[i]);
    //       var f = document.getElementById("fotoBarang").files[i];
    //       var fsize = f.size || f.fileSize;
    //       if (fsize > 2000000) {
    //         error_images += '<p>' + i + ' File Size is very big</p>';
    //       } else {
    //         // form_data.append("file[]", document.getElementById('fotoBarang').files[i]);
    //         // $("#preview" + i).attr('src', document.getElementById('fotoBarang').files[i]);
    //         // alert(document.getElementById('fotoBarang').files[i]);

    //         oFReader.onload = function(event) {
    //           // $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
    //           $('img').attr('src', event.target.result).appendTo('#preview');
    //         }

    //         oFReader.readAsDataURL(files[i]);
    //       }
    //     }
    //   }
    //   // if (error_images == '') {
    //   //   $.ajax({
    //   //     url: "upload.php",
    //   //     method: "POST",
    //   //     data: form_data,
    //   //     contentType: false,
    //   //     cache: false,
    //   //     processData: false,
    //   //     beforeSend: function() {
    //   //       $('#error_multiple_files').html('<br /><label class="text-primary">Uploading...</label>');
    //   //     },
    //   //     success: function(data) {
    //   //       $('#error_multiple_files').html('<br /><label class="text-success">Uploaded</label>');
    //   //       load_image_data();
    //   //     }
    //   //   });
    //   // } else {
    //   //   $('#multiple_files').val('');
    //   //   $('#error_multiple_files').html("<span class='text-danger'>" + error_images + "</span>");
    //   //   return false;
    //   // }
    // });


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