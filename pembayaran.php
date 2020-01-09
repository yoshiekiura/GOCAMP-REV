<?php
include('config/session.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Pembayaran</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="css/slick.css" />
	<link type="text/css" rel="stylesheet" href="css/slick-theme.css" />

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css/style.css" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>
	<?php include('./component/nav.php'); ?>

	<!-- NAVIGATION -->
	<div id="navigation">
		<!-- container -->
		<div class="container">
			<div id="responsive-nav">
				<!-- category nav -->
				<div class="category-nav show-on-click">
					<span class="category-header">Kategori <i class="fa fa-list"></i></span>
					<ul class="category-list">
						<li><a href="#">Tenda</a></li>
						<li><a href="#">Tas</a></li>
						<li><a href="#">Jaket</a></li>
						<li><a href="#">Cooking Set</a></li>
						<li><a href="#">Sepatu</a></li>
						<li><a href="#">Cooking Set</a></li>
						<li><a href="#">Sepatu</a></li>
						<li><a href="#">Lainnya</a></li>
						<li><a href="#">Lihat Semua</a></li>
					</ul>
				</div>
				<!-- /category nav -->

				<!-- menu nav -->
				<div class="menu-nav">
					<span class="menu-header">Menu <i class="fa fa-bars"></i></span>
					<ul class="menu-list">
						<li><a href="#">Beranda</a></li>
						<li><a href="#">Barang</a></li>
						<li><a href="#">Transaksi</a></li>
						<li><a href="#">Denda</a></li>
						<li><a href="#">Ulasan</a></li>
					</ul>
				</div>
				<!-- menu nav -->
			</div>
		</div>
		<!-- /container -->
	</div>
	<!-- /NAVIGATION -->

	<!-- BREADCRUMB -->
	<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="#">Home</a></li>
				<li class="active">Detail Transaksi</li>
			</ul>
		</div>
	</div>
	<!-- /BREADCRUMB -->

	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<?php
				if (isset($_GET['id'])) {
					$id = mysqli_real_escape_string($koneksi, $_GET['id']);
					$ambil = $koneksi->query("SELECT * FROM tbl_peminjaman WHERE id_peminjaman='$id'");
				}
				$pecah = $ambil->fetch_array();
				?>
				<div class="col-md-12">
					<div class="order-summary clearfix">
						<div class="section-title">
							<h3 class="title">Status Pembayaran</h3>
						</div>
					</div>
				</div>
				<div class="col-md-8">
					<div class="col-md-6">
						<h4 class="title text-center">Jumlah Tagihan</h4>

						<div class="text-center">
							<span class="h3"><?php echo rupiah($pecah['total_harga']) ?></span>
						</div>
						<div class="text-center">
							<button type="button" class="btn btn-sm btn-secondary">Salin</button>
						</div>

					</div>
					<div class="col-md-6">
						<h4 class="title text-center">Nomor Rekening</h4>
						<div class="text-center">

							<span class="h3"><?php
												$ambilRek = $koneksi->query("SELECT * FROM tbl_setting");
												$pecahRek = $ambilRek->fetch_array();
												$bataswaktu = date('Y-m-d', strtotime($pecah['tgl_booking'] . ' + 1 days'));
												if ($pecah['metode_pembayaran'] == 'BANK BCA') {
													echo "39358" . $pecahRek['no_ovo'];
												} else if ($pecah['metode_pembayaran'] == 'BANK BNI') {
													if (strlen($pecahRek['no_ovo']) == 12) {
														echo "8740" . $pecahRek['no_ovo'];
													} else if (strlen($pecahRek['no_ovo']) == 13) {
														echo "874" . $pecahRek['no_ovo'];
													} else if (strlen($pecahRek['no_ovo']) == 11) {
														echo "87400" . $pecahRek['no_ovo'];
													} else if (strlen($pecahRek['no_ovo']) == 10) {
														echo "874000" . $pecahRek['no_ovo'];
													}
												} else if ($pecah['metode_pembayaran'] == 'BANK BTPN') {
													echo "8099" . $pecahRek['no_ovo'];
												} else if ($pecah['metode_pembayaran'] == 'BANK BRI') {
													echo "88099" . $pecahRek['no_ovo'];
												} else if ($pecah['metode_pembayaran'] == 'PERMATA BANK') {
													echo "84" . $pecahRek['no_ovo'];
												} else if ($pecah['metode_pembayaran'] == 'MAYBANK') {
													echo "8099" . $pecahRek['no_ovo'];
												} else if ($pecah['metode_pembayaran'] == 'DBS BANK') {
													echo "8099" . $pecahRek['no_ovo'];
												} else if ($pecah['metode_pembayaran'] == 'PANIN BANK') {
													echo "8099" . $pecahRek['no_ovo'];
												} else if ($pecah['metode_pembayaran'] == 'OVO') {
													echo $pecahRek['no_ovo'];
												} else {
													echo 'COD';
													$bataswaktu = date('Y-m-d', strtotime($pecah['tgl_pinjam'] . ' + 1 days'));
												}
												?>
							</span>
						</div>
						<div class="text-center">
							<button type="button" class="btn btn-sm btn-secondary">Salin</button>
						</div>
					</div>
					<div class="col-md-12">
						<div class="text-center">
							<h4 class="title text-center">Batas Waktu Pembayaran</h4>
							<span class="h3"><?php echo $bataswaktu; ?></span>
						</div>
					</div>
					<div class="col-md-12">
						<br>
						<div class="text-left">
							<p class="h4">GoCamp akan memverifikasi otomatis paling lama 30 menit setelah kamu melakukan pembayaran.</p>
						</div>
						<br><br><br>
					</div>
					<div class="col-md-12">
						<div class="text-left">
							<p class="h4">Pembayaran anda belum diverifikasi? upload bukti pembayaran <a href="#" id="upload">disini</a>.</p>
						</div>
						<div class="form-group" id="uploadpembayaran">
							<input type="file" id="buktipembayaran" class="custom-file-input" name="buktipembayaran">
						</div>
					</div>
				</div>
				<div class="col-md-4">

					<div class="section-title">
						<h4 class="title">No Transaksi</h4>
					</div>
					<div>
						<span class="badge badge-dark">#<?php echo $pecah['id_peminjaman'] ?></span>
						<input id="id_peminjaman" type="hidden" value="<?php echo $pecah['id_peminjaman'] ?>">
					</div>
					<div class="section-title">
						<h4 class="title">Tanggal Booking / Pinjam</h4>
					</div>
					<div>
						<span class="badge badge-dark"><?php echo $pecah['tgl_booking'] ?></span> / <span class="badge badge-dark"><?php echo $pecah['tgl_pinjam'] ?></span>
					</div>
					<div class="section-title">
						<h4 class="title">Status Transaksi</h4>
					</div>
					<div>
						<span class="badge badge-dark"><?php echo $pecah['status_peminjaman'] ?></span>
					</div>

					<div class="section-title">
						<h4 class="title">Metode Pembayaran</h4>
					</div>
					<div>
						<span class="badge badge-dark"><?php echo $pecah['metode_pembayaran'] ?></span><span><a href="#" id="ubahPembayaran">(Ubah Metode Pembayaran)</a></span>
					</div>
					<div id="ubah-pembayaran">
						<select id="pilihpembayaran" class="input mx-5" style="width: 210px;margin-top:10px" name="metode_pembayaran">
							<option>Pilih Metode Pembayaran</option>
							<option>COD</option>
							<option>BANK BCA</option>
							<option>BANK BRI</option>
							<option>BANK BNI</option>
							<option>BANK BTPN</option>
							<option>PERMATA BANK</option>
							<option>MAYBANK</option>
							<option>DBS BANK</option>
							<option>PANIN BANK</option>
							<option>OVO</option>
						</select>
					</div>

					<div class="section-title">
						<h4 class="title">Total Pembayaran</h4>
					</div>
					<div>
						<span class="badge badge-dark"><?php echo rupiah($pecah['total_harga']) ?></span>
					</div>
					<div class="section">
						<a href="detail-transaksi.php?id=<?php echo $pecah['id_peminjaman'] ?>"><button class="main-btn ">Detail Transaksi</button></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>

	</div>
	<!-- /row -->
	</div>
	<!-- /container -->
	</div>
	<!-- /section -->

	<?php include('./component/footer.php'); ?>

	<!-- jQuery Plugins -->

	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/slick.min.js"></script>
	<script src="js/nouislider.min.js"></script>
	<script src="js/jquery.zoom.min.js"></script>
	<script src="js/main.js"></script>
	<script>
		$(document).ready(function() {
			$("#pilihpembayaran").hide();
		});
		$(document).ready(function() {
			$('#ubahPembayaran').on('click', function() {
				$("#pilihpembayaran").show();
				$(this).hide();
			});

		});

		$(document).ready(function() {
			$("#uploadpembayaran").hide();
		});
		$(document).ready(function() {
			$('#upload').on('click', function() {
				$("#uploadpembayaran").show();
				$(this).hide();
			});

		});

		$(document).ready(function() {
			$('#pilihpembayaran').on('change', function() {
				var metode = $(this).parent().find('#pilihpembayaran option:selected').text();
				var id = $("#id_peminjaman").val();
				$.ajax({
					url: "pembayaran-action.php",
					type: "POST",
					data: {
						id: id,
						metode: metode,
						tipe: "ubah-pembayaran"
					},
					success: function(data) {
						data = jQuery.parseJSON(data);
						if (data.status == 1) {
							alert('sukses');
							$("#pilihpembayaran").hide();
							$("#ubahPembayaran").show();
							location.reload();
						} else {
							alert('gagal');
						}
					}
				});
			});
		});

		$(document).ready(function(e) {
			$('#buktipembayaran').on('change', function() {
				var file_data = $('#buktipembayaran').prop('files')[0];
				var form_data = new FormData();
				form_data.append('file', file_data);
				console.log(form_data);
				// $.ajax({
				// 	url: "pembayaran-action.php",
				// 	type: "POST",
				// 	dataType: 'text', // what to expect back from the server
				// 	cache: false,
				// 	contentType: false,
				// 	processData: false,
				// 	data: form_data,
				// 	data: {
				// 		id: id,
				// 		metode: metode,
				// 		tipe: "ubah-pembayaran"
				// 	},
				// 	success: function(data) {
				// 		data = jQuery.parseJSON(data);
				// 		if (data.status == 1) {
				// 			alert('sukses');
				// 			$("#pilihpembayaran").hide();
				// 			$("#ubahPembayaran").show();
				// 			location.reload();
				// 		} else {
				// 			alert('gagal');
				// 		}
				// 	},
				// 	error: function(response) {
				// 		$('#msg').html(response); // display error response from the server
				// 	}
				// });
			});
		});
	</script>
</body>

</html>