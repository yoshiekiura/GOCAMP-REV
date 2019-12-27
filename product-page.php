<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>GOCAMP</title>

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
						<li><a href="<?php echo dirname($_SERVER['REQUEST_URI']) . "/" ?>">Beranda</a></li>
						<li><a href="<?php echo dirname($_SERVER['REQUEST_URI']) . "/statusTransaksi.php" ?>">Transaksi</a></li>
						<li><a href="<?php echo dirname($_SERVER['REQUEST_URI']) . "/checkout.php" ?>">Keranjang</a></li>
						<li><a href="<?php echo dirname($_SERVER['REQUEST_URI']) . "/profil.php" ?>">Profil</a></li>
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
				<li><a href="<?php echo dirname($_SERVER['REQUEST_URI']) . "/" ?>">Beranda</a></li>
				<?php
				if (!isset($_GET['id'])) {
					echo "<script LANGUAGE='JavaScript'>window.location.href='/SOLO';</script>";
				} else {
					$ambil = $koneksi->query("SELECT * FROM tbl_barang JOIN tbl_kategoriBarang ON tbl_barang.id_kategoriBarang=tbl_kategoriBarang.id_kategoriBarang WHERE tbl_barang.id_barang='" . $_GET['id'] . "'") or die("Last error: {$koneksi->error}\n");
					while ($pecah = $ambil->fetch_array()) {
						echo '<li><a href="index.php?kategori=' . $pecah['nama_kategoriBarang'] . '">' . $pecah['nama_kategoriBarang'] . '</a></li>';
					}
				}

				?>
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
				<!--  Product Details -->
				<div class="product product-details clearfix">
					<div class="col-md-6">
						<div id="product-main-view">
							<?php
							$id = $_GET['id'];
							$ambil = $koneksi->query("SELECT * FROM tbl_barang WHERE id_barang='" . $id . "'") or die("Last error: {$koneksi->error}\n");
							while ($pecah = $ambil->fetch_array()) { ?>
								<div class="product-view">
									<img src="./img/<?php echo $pecah['foto_barang'] ?>" alt="">
								</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="product-body">
							<h2 class="product-name"><?php echo $pecah['nama_barang'] ?></h2>
							<h3 class="product-price"><?php echo rupiah($pecah['harga_barang']) ?></h3>
							<p><strong>Stok :</strong> <?php echo $pecah['stok_barang'] ?></p>
							<p><?php echo str_replace(array("\r\n", "\n", "\r"), "<br>", $pecah['deskripsi_barang']); ?></p>
							<br>
							<div class="product-btns">
								<form action="cartUpdate.php" method="get">
									<div class="qty-input">
										<span class="text-uppercase">JUMLAH: </span>
										<input class="input" name="qty" type="number" placeholder="1">
										<input name="addCart" type="hidden" value="<?php echo $pecah['id_barang'] ?>">
										<input name="return_url" type="hidden" value="<?php echo $current_url ?>">
									</div>
									<button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Tambah ke Keranjang</button>
									<div class="pull-right">
										<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
										<button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
										<button class="main-btn icon-btn"><i class="fa fa-share-alt"></i></button>
									</div>
								</form>
							</div>
						</div>
					</div>
				<?php }
				?>
				<!-- /Product Details -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->

		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h2 class="title">SEWA LAINNYA</h2>
						</div>
					</div>
					<!-- section title -->

					<!-- Product Single -->
					<?php
					$ambil = $koneksi->query("SELECT * FROM tbl_barang LIMIT 4") or die("Last error: {$koneksi->error}\n");
					while ($pecah = $ambil->fetch_array()) { ?>
						<div class="col-md-3 col-sm-6 col-xs-6">
							<div class="product product-single">
								<div class="product-thumb">
									<a href="product-page.php?id=<?php echo $pecah['id_barang'] ?>"><button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button></a>
									<img src="./img/<?php echo $pecah['foto_barang'] ?>" alt="">
								</div>
								<div class="product-body">
									<h3 class="product-price"><?php echo rupiah($pecah['harga_barang']) ?></h3>
									<div class="product-rating">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-o empty"></i>
									</div>
									<h2 class="product-name"><a href="#"><?php echo $pecah['nama_barang'] ?></a></h2>
									<div class="product-btns">
										<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
										<button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
										<a href="<?php echo "cartUpdate.php?addCart=" . $pecah['id_barang'] . "&&return_url=" . $current_url ?>"><button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i>Masukan Ke Keranjang</button></a>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
					<!-- /Product Single -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->


		<!-- FOOTER -->
		<footer id="footer" class="section section-grey">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- footer widget -->
					<div class="col-md-3 col-sm-6 col-xs-6">
						<div class="footer">
							<!-- footer logo -->
							<div class="footer-logo">
								<a class="logo" href="#">
									<img src="./img/logo.png" alt="">
								</a>
							</div>
							<!-- /footer logo -->

							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna</p>

							<!-- footer social -->
							<ul class="footer-social">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-instagram"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
							</ul>
							<!-- /footer social -->
						</div>
					</div>
					<!-- /footer widget -->

					<!-- footer widget -->
					<div class="col-md-3 col-sm-6 col-xs-6">
						<div class="footer">
							<h3 class="footer-header">Akun Saya</h3>
							<ul class="list-links">
								<li><a href="#">Akun Saya</a></li>
								<li><a href="#">Disukai</a></li>
								<li><a href="#">Checkout</a></li>
								<li><a href="#">Masuk</a></li>
							</ul>
						</div>
					</div>
					<!-- /footer widget -->

					<div class="clearfix visible-sm visible-xs"></div>

					<!-- footer widget -->
					<div class="col-md-3 col-sm-6 col-xs-6">
						<div class="footer">
							<h3 class="footer-header">Customer Service</h3>
							<ul class="list-links">
								<li><a href="#">Tentang Kami</a></li>
								<li><a href="#">Syarat & Ketentuan</a></li>
								<li><a href="#">Panduan Booking</a></li>
								<li><a href="#">FAQ</a></li>
							</ul>
						</div>
					</div>
					<!-- /footer widget -->

					<!-- footer subscribe -->
					<div class="col-md-3 col-sm-6 col-xs-6">
						<div class="footer">
							<h3 class="footer-header">Stay Connected</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>
							<form>
								<div class="form-group">
									<input class="input" placeholder="Enter Email Address">
								</div>
								<button class="primary-btn">Join Newslatter</button>
							</form>
						</div>
					</div>
					<!-- /footer subscribe -->
				</div>
				<!-- /row -->
				<hr>
				<!-- row -->
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center">
						<!-- footer copyright -->
						<div class="footer-copyright">
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							Copyright &copy;<script>
								document.write(new Date().getFullYear());
							</script> All rights reserved | GOCAMP<a href="https://colorlib.com" target="_blank"></a>
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						</div>
						<!-- /footer copyright -->
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</footer>
		<!-- /FOOTER -->

		<!-- jQuery Plugins -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/slick.min.js"></script>
		<script src="js/nouislider.min.js"></script>
		<script src="js/jquery.zoom.min.js"></script>
		<script src="js/main.js"></script>

</body>

</html>