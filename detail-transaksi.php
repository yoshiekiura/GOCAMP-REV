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

	<title>Detail Transaksi</title>

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
						<?php
						$ambil = $koneksi->query("SELECT * FROM tbl_kategoriBarang") or die("Last error: {$koneksi->error}\n");
						while ($pecah = $ambil->fetch_array()) {
							echo '<li><a href="index.php?kategori=' . $pecah['nama_kategoriBarang'] . '">' . $pecah['nama_kategoriBarang'] . '</a></li>';
						}
						?>
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
				<div class="col-md-12">
					<div class="order-summary clearfix">
						<div class="section-title">
							<h3 class="title">Status Pembayaran</h3>
						</div>
					</div>
				</div>
				<div class="col-md-9">
					<table class="shopping-cart-table table">
						<tbody>
							<?php
							if (isset($_GET['id'])) {
								$id = mysqli_real_escape_string($koneksi, $_GET['id']);
								$ambil = $koneksi->query("SELECT * FROM tbl_detailpeminjaman JOIN tbl_barang ON tbl_detailpeminjaman.id_barang=tbl_barang.id_barang WHERE id_peminjaman='$id'");
							}
							while ($pecah = $ambil->fetch_array()) { ?>

								<tr>
									<td class="thumb"><img src="./img/<?php echo $pecah['foto_barang'] ?>" alt=""></td>
									<td class="details">
										<a href="#"><?php echo $pecah['nama_barang'] ?></a>
										<ul>
											<li><strong><?php echo $pecah['id_barang'] ?></strong></li>
										</ul>
									</td>
									<td class="price text-center"><small>Jumlah : </small><strong><?php echo $pecah['jumlah_detailBarang'] ?></strong><br></td>
									<td class="total text-center"><strong class="primary-color"><?php echo rupiah($pecah['harga_barang']) ?></strong></td>
								</tr>
							<?php }
							?>
						</tbody>
					</table>
				</div>
				<div class="col-md-3">
					<?php
					if (isset($_GET['id'])) {
						$id = mysqli_real_escape_string($koneksi, $_GET['id']);
						$ambil = $koneksi->query("SELECT * FROM tbl_peminjaman WHERE id_peminjaman='$id'");
						$pecah = $ambil->fetch_array();
					}
					?>
					<div class="section-title">
						<h4 class="title">No Transaksi</h4>
					</div>
					<div>
						<span class="badge badge-dark">#<?php echo $pecah['id_peminjaman'] ?></span>
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
						<span class="badge badge-dark"><?php echo $pecah['metode_pembayaran'] ?></span>
					</div>

					<div class="section-title">
						<h4 class="title">Total Pembayaran</h4>
					</div>
					<div>
						<span class="badge badge-dark"><?php echo rupiah($pecah['total_harga']) ?></span>
					</div>
					<div class="section">
						<a href="detail-transaksi-print.php?id=<?php echo $pecah['id_peminjaman'] ?>"><button class="main-btn ">Cetak Bukti Pembayaran</button></a>
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

</body>

</html>