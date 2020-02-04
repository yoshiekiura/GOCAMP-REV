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


</head>

<body>
	<?php include('./component/nav.php'); ?>
	<!-- NAVIGATION -->
	<div id="navigation">
		<!-- container -->
		<div class="container">
			<div id="responsive-nav">
				<!-- category nav -->
				<div class="category-nav">
					<span class="category-header">Kategori <i class="fa fa-list"></i></span>
					<ul class="category-list" style="width: 270px; height: 489px; overflow: -moz-scrollbars-vertical; overflow-y: scroll;">
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
						<li><a href="./">Beranda</a></li>
						<li><a href="./statusTransaksi.php">Transaksi</a></li>
						<li><a href="./checkout.php">Keranjang</a></li>
						<li><a href="./profil.php">Profil</a></li>
						<li><a href="#">Ulasan</a></li>
					</ul>
				</div>
				<!-- menu nav -->
			</div>
		</div>
		<!-- /container -->
	</div>
	<!-- /NAVIGATION -->

	<!-- HOME -->
	<div id="home">
		<!-- container -->
		<div class="container">
			<!-- home wrap -->
			<div class="home-wrap">
				<!-- home slick -->
				<div id="home-slick">
					<!-- banner -->
					<div class="banner banner-1">
						<img src="./img/bn3.jpg" alt="">
						<div class="banner-caption text-center">
							<h1>Tenda</h1>
							<h3 class="white-color font-weak">Promo Sewa Tenda</h3>
							<button class="primary-btn">Sewa Sekarang</button>
						</div>
					</div>
					<!-- /banner -->
					<!-- banner -->
					<div class="banner banner-1">
						<img src="./img/bn2.jpg" alt="">
						<div class="banner-caption text-center">
							<h1>Tenda</h1>
							<h3 class="white-color font-weak">Promo Sewa Tenda</h3>
							<button class="primary-btn">Sewa Sekarang</button>
						</div>
					</div>
					<!-- /banner -->
					<!-- banner -->
					<div class="banner banner-1">
						<img src="./img/bn1.jpg" alt="">
						<div class="banner-caption">
							<h1 class="white-color">Barang Baru</h1>
							<button class="primary-btn">Sewa Now</button>
						</div>
					</div>
					<!-- /banner -->
				</div>
				<!-- /home slick -->
			</div>
			<!-- /home wrap -->
		</div>
		<!-- /container -->
	</div>
	<!-- /HOME -->

	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- section title -->
				<div class="col-md-12">
					<div class="section-title">
						<h2 class="title">Semua Produk</h2>
					</div>
				</div>
				<!-- section title -->

				<!-- Product Single -->
				<?php
				$halaman = 8; //batasan halaman
				$page = isset($_GET['halaman']) ? (int) $_GET["halaman"] : 1;
				$mulai = ($page > 1) ? ($page * $halaman) - $halaman : 0;
				if (isset($_GET['kategori'])) {
					$ambil = $koneksi->query("SELECT * FROM tbl_barang JOIN tbl_kategoribarang ON tbl_barang.id_kategoriBarang=tbl_kategoribarang.id_kategoriBarang WHERE tbl_kategoribarang.nama_kategoriBarang='" . $_GET['kategori'] . "' LIMIT $mulai, $halaman") or die("Last error: {$koneksi->error}\n");
				} else if (isset($_GET['q'])) {
					$search = $_GET['q'];
					$ambil = $koneksi->query("SELECT * FROM tbl_barang JOIN tbl_kategoribarang ON tbl_barang.id_kategoriBarang=tbl_kategoribarang.id_kategoriBarang WHERE tbl_kategoribarang.nama_kategoriBarang LIKE '%" . $search . "%' OR tbl_barang.nama_barang LIKE '%" . $search . "%'  LIMIT $mulai, $halaman") or die("Last error: {$koneksi->error}\n");
				} else {
					$ambil = $koneksi->query("SELECT * FROM tbl_barang ORDER BY RAND() LIMIT $mulai, $halaman") or die("Last error: {$koneksi->error}\n");
				}
				$ambiltotal = $koneksi->query("SELECT * FROM tbl_barang") or die("Last error: {$koneksi->error}\n");
				$total = mysqli_num_rows($ambiltotal);
				$pages = ceil($total / $halaman);
				while ($pecah = $ambil->fetch_array()) { 
					$foto_barang = explode(',' , $pecah['foto_barang']);
					$hitungFoto = count($foto_barang);
					?>
					<div class="col-md-3 col-sm-6 col-xs-6">
						<div class="product product-single">
							<div class="product-thumb">
								<a href="product-page.php?id=<?php echo $pecah['id_barang'] ?>"><button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button></a>
								<img src="./img/<?php echo $foto_barang[0] ?>" alt="">
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
								<a href="product-page.php?id=<?php echo $pecah['id_barang'] ?>">
									<h2 class="product-name"><?php echo $pecah['nama_barang'] ?></h2>
								</a>
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
			<?php
			echo '<div class="text-center">';
			echo '<nav aria-label="Page navigation example">';
			echo '<ul class="pagination">';
			for ($i = 1; $i <= $pages; $i++) {
				echo '<li class="page-item"><a class="page-link" href="index.php?halaman=' . $i . '">' . $i . '</a></li>';
			}
			echo '</ul>';
			echo '</nav>';
			echo '</div>';
			?>
			<!-- /row -->
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