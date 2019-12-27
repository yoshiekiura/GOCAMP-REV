<?php
include('./session.php');
require('./ovo.php');
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
  <!-- DataTables -->
  <link rel="stylesheet" href="./plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="./plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
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
              <a href="./paket-barang.php" class="nav-link">
                <i class="fas fa-plus nav-icon"></i>
                <p>Tambah Paket Barang</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./kategori.php" class="nav-link active">
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
            <h1>Manajemen OVO</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manajemen OVO</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <?php
    $p = new Ovo;
    $ovocash = 0;
    $ovopoint = 0;
    if ($p->get_info_account()->data) {
      $data = convert_to_array($p->get_info_account()->data);
      $ovocash = $data['001']['card_balance'];
      $ovopoint = $data['600']['card_balance'];
    }

    ?>
    <!-- Main content -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">New message</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Recipient:</label>
                <input type="text" class="form-control" id="recipient-name">
              </div>
              <div class="form-group">
                <label for="message-text" class="col-form-label">Message:</label>
                <textarea class="form-control" id="message-text"></textarea>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Send message</button>
          </div>
        </div>
      </div>
    </div>
    <!-- /.modal -->
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

                <h3 class="profile-username text-center">Abdul Kholiq</h3>

                <p class="text-muted text-center">Premier</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>OVO Cash</b> <a class="float-right"><?php echo rupiah($ovocash) ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>OVO Point</b> <a class="float-right"><?php echo rupiah($ovopoint) ?></a>
                  </li>
                </ul>

                <a href="#kirim" class="btn btn-primary btn-block" data-toggle="tab"><b>Kirim</b></a>
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
                  <li class="nav-item"><a class="nav-link active" href="#mutasi" data-toggle="tab">Mutasi</a></li>
                  <li class="nav-item"><a class="nav-link" href="#kirim" data-toggle="tab">Kirim</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane" id="kirim">
                    <!-- Post -->
                    <div class="form-group row">
                      <label for="inputjenistransfer" class="col-sm-2 col-form-label">Jenis Transfer</label>
                      <div class="col-sm-10">
                        <select class="form-control select2" name="jenistransfer" id="jenistransfer" style="width: 100%;">
                          <option value="bank" selected="selected">Pilih Jenis Transfer</option>
                          <option value="ovo">Transfer OVO ke OVO</option>
                          <option value="bank">Transfer OVO ke BANK</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-horizontal" id="form-bank">
                      <div class="form-group row">
                        <label for="inputpilihbank" class="col-sm-2 col-form-label">Bank Tujuan</label>
                        <div class="col-sm-10">
                          <select class="form-control select2" name="banktujuan" id="banktujuan" style="width: 100%;">
                            <option selected="selected">Pilih Bank Tujuan</option>
                            <?php
                            $list_bank = $p->get_listbank()->bankTypes;
                            foreach ($list_bank as $key => $val) { ?>
                              <option value="<?php echo $val->value ?>"><?php echo $val->name ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputrekeningtujuan" class="col-sm-2 col-form-label">Rekening Tujuan</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" name="rekeningtujuan" id="rekeningtujuan" placeholder="Masukkan rekening tujuan">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputjumlahtransfer" class="col-sm-2 col-form-label">Jumlah Transfer</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" name="jumlahtransfer_bank" id="jumlahtransfer_bank" placeholder="Masukkan jumlah transfer">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputpesan" class="col-sm-2 col-form-label">Pesan</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="pesantransfer_bank" name="pesantransfer_bank" placeholder="Masukkan pesan"></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" id="kirimbank" class="btn btn-danger">Kirim</button>
                        </div>
                      </div>
                    </div>
                    <div class="form-horizontal" id="form-ovo">
                      <div class="form-group row">
                        <label for="inputovotujuan" class="col-sm-2 col-form-label">Nomor OVO Tujuan</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" name="ovotujuan" id="ovotujuan" placeholder="Masukkan ovo tujuan">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputjumlahtransfer" class="col-sm-2 col-form-label">Jumlah Transfer</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" name="jumlahtransfer" id="jumlahtransfer_ovo" placeholder="Masukkan jumlah transfer">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputpesan" class="col-sm-2 col-form-label">Pesan</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="pesantransfer_ovo" name="pesantransfer_ovo" placeholder="Masukkan pesan"></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" id="kirimovo" class="btn btn-danger">Kirim</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="active tab-pane" id="mutasi">
                    <!-- The timeline -->
                    <table id="example2" class="table table-bordered table-hover text-center">
                      <thead>
                        <tr>
                          <th>Tanggal</th>
                          <th>Jam</th>
                          <th>Pengirim</th>
                          <th>Jumlah</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if ($p->get_mutasi_account(trim(20))->data) {
                          $data = $p->get_mutasi_account(trim(20))->data;
                          $array = $data["0"]->complete;
                        }
                        $total = 0;
                        foreach ($array as $key => $value) {
                          if ($value->desc2 == "Incoming Transfer" || $value->desc2 == "Transfer Masuk") {
                            ?>
                            <tr>
                              <td><?php echo $value->transaction_date ?></td>
                              <td><?php echo $value->transaction_time ?></td>
                              <td><?php echo $value->desc3 ?></td>
                              <td><?php echo rupiah($value->transaction_amount) ?></td>
                              <?php $total = $total + $value->transaction_amount ?>
                            </tr>
                        <?php }
                        } ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th colspan="3">Total</th>
                          <th><?php echo rupiah($total) ?></th>
                        </tr>
                      </tfoot>
                    </table>
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
  <!-- DataTables -->
  <script src="./plugins/datatables/jquery.dataTables.js"></script>
  <script src="./plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
  <!-- SweetAlert2 -->
  <script src="./plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- AdminLTE App -->
  <script src="./dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="./dist/js/demo.js"></script>
  <script>
    $(function() {
      $("#example1").DataTable();
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
      });
    });

    $(document).ready(function() {
      $('#kirimbank').on('click', function() {
        var bankcode = $('#banktujuan').val();
        var banktujuan = $('#banktujuan option:selected').text();
        var rekeningtujuan = $('#rekeningtujuan').val();
        var jumlahtransfer = $('#jumlahtransfer_bank').val();
        var pesantransfer = $('#pesantransfer_bank').val();
        $.ajax({
          url: "movo-action.php",
          type: "POST",
          data: {
            jenistransfer: "bank",
            bankcode: bankcode,
            banktujuan: banktujuan,
            rekeningtujuan: rekeningtujuan,
            jumlahtransfer: jumlahtransfer,
            pesantransfer: pesantransfer
          },
          success: function(data) {
            data = jQuery.parseJSON(data);
            // console.log(data);
            var fee = data.adminFee;
            Swal.fire({
              title: 'Konfirmasi Pengiriman?',
              html: '<b>Nama Bank</b> = ' + data.bankName + '<br><b>Nama Penerima</b> = ' + data.accountName+'<br><b>Biaya Transaksi</b> = ' + data.adminFee,
              icon: 'question',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Kirim Sekarang'
            }).then((result) => {
              if (result.value) {
                $.ajax({
                  url: "movo-action.php",
                  type: "POST",
                  data: {
                    jenistransfer: "bank",
                    banktujuan: banktujuan,
                    bankcode: bankcode,
                    bankconfirm: "yes",
                    rekeningtujuan: rekeningtujuan,
                    jumlahtransfer: jumlahtransfer,
                    pesantransfer: pesantransfer
                  },
                  success: function(datas) {
                    datas = jQuery.parseJSON(datas);
                    // console.log(datas);
                    if (datas.status == "SUCCESS") {
                      Swal.fire(
                        'Terkirim!',
                        'Dana berhasil dikirim sebesar '+jumlahtransfer+' dengan biaya '+fee,
                        'success'
                      )
                    } else {
                      Swal.fire(
                        'Gagal!',
                        'Gagal mengirim dana, harap periksa nomor rekening dan nominal yang anda miliki.',
                        'danger'
                      )
                    }

                  }
                });

              }
            })

          },
          error: function() {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Sepertinya anda memasukkan data yang salah.',
              // footer: '<a href>Why do I have this issue?</a>'
            })
          }
        });
      });
    });

    $(document).ready(function() {
      $('#kirimovo').on('click', function() {
        var ovotujuan = $('#ovotujuan').val();
        var jumlahtransfer = $('#jumlahtransfer_ovo').val();
        var pesantransfer = $('#pesantransfer_ovo').val();
        $.ajax({
          url: "movo-action.php",
          type: "POST",
          data: {
            jenistransfer: "ovo",
            ovotujuan: ovotujuan,
            jumlahtransfer: jumlahtransfer,
            pesantransfer: pesantransfer
          },
          success: function(data) {
            data = jQuery.parseJSON(data);
            // var output = "Ovo = " + data.fullName;
            Swal.fire({
              title: 'Konfirmasi Pengiriman?',
              html: '<b>Nama Penerima</b> = ' + data.fullName + '<br><b>Nomer</b> = ' + data.mobile,
              icon: 'question',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Kirim Sekarang'
            }).then((result) => {
              if (result.value) {
                $.ajax({
                  url: "movo-action.php",
                  type: "POST",
                  data: {
                    jenistransfer: "ovo",
                    ovoconfirm: 1,
                    ovotujuan: ovotujuan,
                    jumlahtransfer: jumlahtransfer,
                    pesantransfer: pesantransfer
                  },
                  success: function(datas) {
                    datas = jQuery.parseJSON(datas);
                    if (datas.status == true) {
                      Swal.fire(
                        'Terkirim!',
                        'Anda berhasil mengirim dana ke ' + ovotujuan,
                        'success'
                      )
                    } else {
                      Swal.fire(
                        'Gagal!',
                        'Anda gagal mengirim dana, harap perika nomor ovo tujuan atau nominal transaksi anda.',
                        'danger'
                      )
                    }

                  }
                });

              }
            })

          },
          error: function() {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Sepertinya anda memasukkan data yang salah.',
              // footer: '<a href>Why do I have this issue?</a>'
            })
          }
        });
      });
    });

    $(document).ready(function() {
      $('#kirim').on('click', function() {
        tujuan = $(this).parent().find('#jenistransfer option:selected').val();
        $('#jenistransfer').on('change', function() {
          tujuan = $(this).parent().find('#jenistransfer option:selected').val();
        });
        if (tujuan == "bank") {
          $("#form-ovo").hide();
          $("#form-bank").show();
        } else if (tujuan == 'ovo') {
          $("#form-bank").hide();
          $("#form-ovo").show();
        }
      });
    });



    // $(document).ready(function() {
    //   $('#jenistransfer').on('change', function() {
    //     var tujuan = $(this).parent().find('#jenistransfer option:selected').val();
    //     if (tujuan == "bank") {
    //       $("#form-ovo").hide();
    //       $("#form-bank").show();
    //     } else if (tujuan == 'ovo') {
    //       $("#form-bank").hide();
    //       $("#form-ovo").show();
    //     }
    //     // $.ajax({
    //     //   url: "tambah-paket-barang.php",
    //     //   type: "POST",
    //     //   data: {
    //     //     id_barang: id,
    //     //     tipe: 'add'
    //     //   },
    //     //   success: function(data) {
    //     //     var bank = "<tr><td id='td_id'>" + id + "</td><td>" + nama + "</td>" + '<td><a class="btn btn-danger btn-sm" id="hapuspaket" href="#"><i class="fas fa-trash"> </i>Delete</a></td></tr>';
    //     //     $("#form-horizontal").append(htmlToAppend);
    //     //   }
    //     // });
    //   });
    // });
  </script>
</body>

</html>