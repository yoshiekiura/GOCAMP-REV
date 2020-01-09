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

	<title>Status Transaksi</title>

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
				<li class="active">Checkout</li>
			</ul>
		</div>
	</div>
	<!-- /BREADCRUMB -->

	<!-- section -->

	<div class="col-md-12">
		<div class="container">
			<div class="order-summary clearfix">
				<div class="section-title">
					<h3 class="title">Status Pembayaran
					</h3>
				</div>
				<table class="shopping-cart-table table">
					<thead>
						<tr>
							<th>No Transaksi</th>
							<th>Total Pembayaran</th>
							<th>Status Transaksi</th>
						</tr>
					</thead>

					<!---no transaki-->
					<tbody>
						<?php

						$ambil = $koneksi->query("SELECT * FROM tbl_peminjaman WHERE id_user='" . $_SESSION['id_login'] . "' ORDER BY status_peminjaman = 'BELUM DIBAYAR' DESC");
						while ($pecah = $ambil->fetch_array()) {
						?>
							<tr>
								<td><?php echo $pecah['id_peminjaman'] ?></td>
								<td><?php echo rupiah($pecah['total_harga']) ?> </td>
								<td><?php echo $pecah['status_peminjaman'] ?> </td>
								<td class="text-center">
									<?php if ($pecah['metode_pembayaran'] != "COD" && $pecah['status_peminjaman'] == "BELUM DIBAYAR") { ?>
										<a href="pembayaran.php?id=<?php echo $pecah['id_peminjaman'] ?>"><button class="main-btn ">Bayar Sekarang</button></a>
									<?php } else { ?>
										<a href="detail-transaksi.php?id=<?php echo $pecah['id_peminjaman'] ?>"><button class="main-btn ">Detail Transaksi</button></a>
									<?php } ?>
								</td>
							</tr>
						<?php }
						?>
					</tbody>
				</table>
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
	</div>
	</div>
	<!-- /section -->

	<?php //include('./component/footer.php'); ?>

	<!-- jQuery Plugins -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/slick.min.js"></script>
	<script src="js/nouislider.min.js"></script>
	<script src="js/jquery.zoom.min.js"></script>
	<script src="js/main.js"></script>

</body>

</html>