<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Checkout</title>
	<?php
	if (isset($_GET['status']) && $_GET['status'] == "tanggalsalah") {
		echo '<script type="text/javascript">alert("Harap masukkan tanggal pinjam tidak kurang dari hari ini! ");</script>';
	}
	?>
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
				<li class="active">Checkout</li>
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
				<form action="checkoutAction.php" method="get" id="checkout-form" class="clearfix">
					<div class="col-md-12">
						<div class="order-summary clearfix">
							<div class="section-title">
								<h3 class="title">Order Review</h3>
							</div>
							<table class="shopping-cart-table table">
								<thead>
									<tr>
										<th>Barang</th>
										<th></th>
										<th class="text-center">Harga</th>
										<th class="text-center">Jumlah</th>
										<th class="text-center">Total</th>
										<th class="text-right"></th>
									</tr>
								</thead>
								<tbody>
									<?php
									$totalBarang = 0;
									$totalHarga = 0;
									$subTotal = 0;
									if (isset($_SESSION['cart'])) {
										foreach ($_SESSION['cart'] as $id_barang => $jumlah) {
											$ambil = $koneksi->query("SELECT * FROM tbl_barang WHERE id_barang='" . $id_barang . "'") or die("Last error: {$koneksi->error}\n");
											$pecah = $ambil->fetch_array();
											$totalBarang = $totalBarang + $jumlah;
											$totalHarga = $pecah['harga_barang'] * $jumlah;
											$subTotal = $subTotal + $totalHarga;
											echo '<tr>';
											echo '<td class="thumb"><img src="./img/' . $pecah['foto_barang'] . '" alt=""></td>';
											echo '<td class="details">';
											echo 	'<a href="#">' . $pecah['nama_barang'] . '</a>';
											echo '</td>';
											echo '<td class="price text-center" id="hargabarang-' . $id_barang . '" value="' . $pecah['harga_barang'] . '"><strong>' . rupiah($pecah['harga_barang']) . '</strong></td>';
											echo '<td class="qty text-center"><input class="input" type="number" id="qty-' . $id_barang . '" onkeyup="update(this)" name="' . $pecah['id_barang'] . '" value="' . $jumlah . '" maxlength="2"></td>';
											echo '<td class="total text-center" ><strong class="primary-color" value="'.$totalHarga.'" id="showqty-' . $id_barang . '">' . rupiah($totalHarga) . '</strong></td>';
											echo '<td class="text-center"><a href="cartUpdate.php?hapuscart=' . $id_barang . '&return_url=' . $current_url . '"><i class="fa fa-close fa-lg"></i></a></td>';
											echo '</tr>';
										}
									} else if (isset($_SESSION['id_login'])) {
										$ambilCart = $koneksi->query("SELECT * FROM tbl_cart WHERE id_user='" . $_SESSION['id_login'] . "'") or die("Last error: {$koneksi->error}\n");
										$rowcountCart = mysqli_num_rows($ambilCart);
										if ($rowcountCart > 0) {
											while ($pecahCart = $ambilCart->fetch_array()) {
												$ambil = $koneksi->query("SELECT * FROM tbl_barang WHERE id_barang='" . $pecahCart['id_barang'] . "'") or die("Last error: {$koneksi->error}\n");
												while ($pecah = $ambil->fetch_array()) {
													$totalBarang = $totalBarang + $pecahCart["jumlah_cart"];
													$totalHarga = $pecah['harga_barang'] * $pecahCart["jumlah_cart"];
													$subTotal = $subTotal + $totalHarga;
													echo '<tr>';
													echo '<td class="thumb"><img src="./img/' . $pecah['foto_barang'] . '" alt=""></td>';
													echo '<td class="details">';
													echo 	'<a href="#">' . $pecah['nama_barang'] . '</a>';
													echo '</td>';
													echo '<td class="price text-center" id="hargabarang-' . $pecahCart["id_barang"] . '" value="' . $pecah['harga_barang'] . '"><strong>' . rupiah($pecah['harga_barang']) . '</strong></td>';
													echo '<td class="qty text-center"><input class="input" id="qty-' . $pecahCart["id_barang"] . '" onkeyup="update(this)" name="' . $pecahCart['id_barang'] . '" type="number" value="' . $pecahCart["jumlah_cart"] . '" maxlength="2"></td>';
													echo '<td class="total text-center" ><strong class="primary-color" value="'.$totalHarga.'" id="showqty-' . $pecahCart["id_barang"] . '">' . rupiah($totalHarga) . '</strong></td>';
													echo '<td class="text-center"><a href="cartUpdate.php?hapuscart=' . $pecahCart["id_barang"] . '&return_url=' . $current_url . '"><i class="fa fa-close fa-lg"></i></a></td>';
													echo '</tr>';
												}
											}
										} else {
											echo '<h2>Tidak ada Barang</h2>';
										}
									}  ?>
								</tbody>
								<tfoot>
									<tr>
										<th>TANGGAL PINJAM</th>
										<th class="detail-checkout" colspan="2">
											<input class="input" name="tanggal_pinjam" type="date">
										</th>
										<th>SUBTOTAL</th>
										<th colspan="2" class="sub-total" id="sub-total"><?php echo rupiah($subTotal) ?></th>
									</tr>
									<tr>
										<th>DURASI PEMINJAMAN</th>
										<th class="detail-checkout" colspan="2">
											<input class="input" id="durasipinjam" onkeyup="compute()" name="durasi_pinjam" type="number" maxlength="3">
										</th>
										<th>PROMO</th>
										<td colspan="2" id="biayapinjam"></td>
									</tr>
									<tr>
										<th>METODE PEMBAYARAN</th>
										<th class="detail-checkout" colspan="2">
											<select class="input" name="metode_pembayaran">
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
										</th>
										<th>TOTAL</th>
										<th colspan="2" id="total-harga" class="total"></th>
									</tr>
								</tfoot>
							</table>
							<input type="hidden" id="subTotal" name="subTotal" value="<?php echo $subTotal ?>">
							<input type="hidden" name="return_url" value="<?php echo $current_url ?>">
							<div class="pull-right">
								<button class="primary-btn" name="submit">Pesan Sekarang</button>
							</div>
						</div>

					</div>
				</form>
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
		function compute() {
			if ($('input[name=durasi_pinjam]').val() != NaN) {
				var a = parseInt($('input[name=subTotal]').val());
				var b = parseInt($('input[name=durasi_pinjam]').val());
				var total = a * b;
				// console.log($('#total-harga').html(total));
				$('#total-harga').text('Rp ' + rupiah(total));
			}
		}

		function rupiah(nStr) {
			nStr += ',00';
			x = nStr.split('.');
			x1 = x[0];
			x2 = x.length > 1 ? '' + x[1] : '';
			var rgx = /(\d+)(\d{3})/;
			while (rgx.test(x1)) {
				x1 = x1.replace(rgx, '$1' + '.' + '$2');
			}
			return x1 + x2;
		}

		// check if input is bigger than 3
		$("input").on("keyup", function() {
			var maxLength = $(this).attr("maxlength");
			if (maxLength == $(this).val().length) {
				alert("Anda hanya bisa mengisi sebanyak " + maxLength + " karakter")
				// this.val("");
			}
		})

		// $('#pilihBarang').on('change', function() {
		// 	var id = $(this).parent().find('#pilihBarang option:selected').val();
		// 	var nama = $(this).parent().find('#pilihBarang option:selected').text();
		// 	$.ajax({
		// 		url: "paket-barang-action.php",
		// 		type: "POST",
		// 		data: {
		// 			id_barang: id,
		// 			tipe: 'add'
		// 		},
		// 		success: function(data) {
		// 			var htmlToAppend = "<tr><td id='td_id'>" + id + "</td><td>" + nama + "</td>" + '<td><a class="btn btn-danger btn-sm" id="hapuspaket" href="#"><i class="fas fa-trash"> </i>Delete</a></td></tr>';
		// 			$("#showPaketBarang").append(htmlToAppend);
		// 		}
		// 	});
		// });

		// function increment_quantity(cart_id) {
		// 	var inputQuantityElement = $("#input-quantity-" + cart_id);
		// 	var newQuantity = parseInt($(inputQuantityElement).val()) + 1;
		// 	save_to_db(cart_id, newQuantity);
		// }

		// function decrement_quantity(cart_id) {
		// 	var inputQuantityElement = $("#input-quantity-" + cart_id);
		// 	if ($(inputQuantityElement).val() > 1) {
		// 		var newQuantity = parseInt($(inputQuantityElement).val()) - 1;
		// 		save_to_db(cart_id, newQuantity);
		// 	}
		// }

		// function save_to_db(cart_id, new_quantity) {
		// 	var inputQuantityElement = $("#input-quantity-" + cart_id);
		// 	$.ajax({
		// 		url: "update_cart_quantity.php",
		// 		data: "cart_id=" + cart_id + "&new_quantity=" + new_quantity,
		// 		type: 'post',
		// 		success: function(response) {
		// 			$(inputQuantityElement).val(new_quantity);
		// 		}
		// 	});
		// }

		// $("input").on("keyup", function() {
		function update(e) {
			var total = 0;
			var totals = 0;
			var subtotal = 0;
			var id = $(e).attr('name');
			var hargabarang = parseInt($("#hargabarang-" + id).attr("value"));
			// console.log(id);
			// console.log(hargabarang);
			// var a = parseInt($('input[name=subTotal]').val());
			// 	var b = parseInt($('input[name=durasi_pinjam]').val());
			// var showqty = $("#hargabarang-" + id);
			// var id = $('input[name=' + name + ']').val();
			// alert(id);
			// alert(hargabarang);
			var jumlahcart = $(e).val();
			var totals = jumlahcart * hargabarang;
			
			// console.log(hargabarang);
			$.ajax({
				url: "checkoutAction.php",
				type: "POST",
				data: {
					action: "jumlahcart",
					id: id,
					jumlahcart: jumlahcart,
				},
				success: function(data) {
					data = jQuery.parseJSON(data);
					// console.log(data.status);
					if (data.status == true) {
						$("#jumlahcart").focus();
						$("#showqty-" + id).text('Rp ' + rupiah(totals));
						var a = parseInt($('input[name=subTotal]').val());
						var showqty = parseInt($("#showqty-" + id).attr("value"));
						subtotal = showqty+a-totals;
						total = a * b;
						$('#sub-total').text('Rp ' + rupiah(total));
						// console.log($('#total-harga').html(total));
						$('#total-harga').text('Rp ' + rupiah(total));
					} else {
						alert("Sepertinya ada yang salah");
					}
				}
			});
		}
		// })
	</script>

</body>

</html>