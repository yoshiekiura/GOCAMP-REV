<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Verifikasi</title>

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

	<!-- CamShoot stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css/jquery.camshoot.css" />

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
					<span class="category-header">Kategori<i class="fa fa-list"></i></span>
					<ul class="category-list">
						<li><a href="#">Tenda</a></li>
						<li><a href="#">Tas</a></li>
						<li><a href="#">Jaket</a></li>
						<li><a href="#">Cooking Set</a></li>
						<li><a href="#">Sepatu</a></li>
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

	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<?php
				$ambil = $koneksi->query("SELECT * FROM tbl_user WHERE id_user='" . $_SESSION['id_login'] . "'");
				$pecah = $ambil->fetch_array();
				?>
				<div style="display: flex;justify-content: center;align-items: center;">
					<div id="cameraContainer"></div>
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
	<script src="js/jquery.camshoot.js"></script>
	<script src="js/slick.min.js"></script>
	<script src="js/nouislider.min.js"></script>
	<script src="js/jquery.zoom.min.js"></script>
	<script src="js/main.js"></script>


	<script>
		$("#profileImage").click(function(e) {
			$("#imageUpload").click();
		});

		function previewProfileImage(uploader) {
			//ensure a file was selected 
			if (uploader.files && uploader.files[0]) {
				var imageFile = uploader.files[0];
				var reader = new FileReader();
				reader.onload = function(e) {
					//set the image data as source
					$('#profileImage').attr('src', e.target.result);
				}
				reader.readAsDataURL(imageFile);
			}
		}

		$("#imageUpload").change(function() {
			previewProfileImage(this);
		});

		$(function() {
			var anu = $("#cameraContainer").camshoot({
				height: 400,
				width: 300
			});


			$("#stop").click(function() {
				anu.stop();
			});
			$("#reset").click(function() {
				anu.reset();
			});

			anu.version();

		});
	</script>
</body>

</html>