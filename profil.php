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

	<title>PROFIL USER</title>

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
				<div class="col-md-6">
					<div class="billing-details">
						<div class="section-title">
							<h4 class="title">Informasi Profil</h4>
						</div>
						<form action="input-aksi.php" method="post">
							<div class="form-group">
								<h4>Nama Lengkap</h4>
								<input class="input" type="text" name="nama_user" placeholder="Masukkan Nama Lengkap" value="<?php echo $pecah['nama_user'] ?>">
							</div>
							<div class="form-group">
								<h4>Email</h4>
								<input class="input" type="email" name="email_user" placeholder="Masukkan Email" value="<?php echo $pecah['email_user'] ?>">
							</div>
							<div class="form-group">
								<h4>No.Hp</h4>
								<input class="input" type="tel" name="nohp_user" placeholder="Masukkan No hp" value="<?php echo $pecah['nohp_user'] ?>">
							</div>
							<div class="form-group">
								<h4>Alamat</h4>
								<input class="input" type="text" name="alamat_user" placeholder="Alamat" value="<?php echo $pecah['alamat_user'] ?>">
							</div>
							<div class="form-group">
								<button class="primary-btn" name="submit">SIMPAN</button>
							</div>
						</form>
					</div>
				</div>
				<div class="col-md-6">
					<div class="billing-details">
						<div class="section-title">
							<h4 class="title">Foto Profil</h4>
						</div>
						<div class="card card-primary card-outline">
							<div class="card-body box-profile">
								<div class="text-center profile-container">
									<img class="profile-user-img img-fluid img-circle" style="width: 15opx; height : 150px" id="profileImage" src="admin/dist/img/user4-128x128.jpg" alt="User profile picture">
									<input id="imageUpload" type="file" style="display: none" name="profile_photo" placeholder="Photo" required="" capture>
								</div>

								<h3 class="profile-username text-center"><?php echo $pecah['nama_user'] ?></h3>

								<p class="text-muted text-center"><?php echo $pecah['status_user'] ?></p>

								<a href="./verifikasi.php" class="rounded-lg primary-btn btn-block btn-flat text-center"><b>Verifikasi Akun Sekarang</b></a>
								<!-- <button class="primary-btn btn-block btn-flat" onclick="return valid();" type="submit" name="submit">Kirim</button> -->
							</div>
						</div>
						<br>
						<div class="section-title">
							<h4 class="title">Ubah Password</h4>
						</div>
						<div class="form-group">
							<h4>Password Baru</h4>
							<input class="input" type="password" name="password_baru" placeholder="Masukkan password baru anda">
						</div>
						<div class="form-group">
							<h4>Konfirmasi Password Baru</h4>
							<input class="input" type="password" name="konfirmasipassword_baru" placeholder="Masukkan konfirmasi password baru anda">
						</div>
						<div class="form-group">
							<button class="primary-btn" name="submit">UBAH</button>
						</div>
					</div>
				</div>

				<!--<div class="col-md-6">
					<img alt="" src="data:image/png;base64,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" class="c-avatar__image" height="450px" width="550px">
						<button class="primary-btn" name="submit">Upload</button>
						<button class="primary-btn" name="submit">Hapus</button
						<button class="main-btn icon-btn"><i class="fa fa-trash fa-lg"></i></button>
						<form action="aksi.php" method="post" enctype="multipart/form-data">
							<button class="main-btn icon-btn"><i class="fa fa-edit fa-lg"></i></button>
						</form>
							<h4 style= "text-align:center">FOTO PROFIL USER</h4>
						</div>
					</div> 
					> -->
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

		
	</script>
</body>

</html>