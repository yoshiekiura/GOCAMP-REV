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

	<!-- SweetAlert2 -->
	<link rel="stylesheet" href="./admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

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
											$ambilBarang = $koneksi->query("SELECT * FROM tbl_barang WHERE id_barang='" . $id_barang . "' AND '" . $jumlah . "'>stok_barang") or die("Last error1: {$koneksi->error}\n");
											$hitungBarang = mysqli_num_rows($ambilBarang);
											$ambil = $koneksi->query("SELECT * FROM tbl_barang WHERE id_barang='" . $id_barang . "'") or die("Last error: {$koneksi->error}\n");
											$pecah = $ambil->fetch_array();
											$foto_barang = explode(',', $pecah['foto_barang']);
											$totalBarang = $totalBarang + $jumlah;
											$totalHarga = $pecah['harga_barang'] * $jumlah;
											$subTotal = $subTotal + $totalHarga;
											echo '<tr>';
											echo '<td class="thumb"><img src="./img/' . $foto_barang[0] . '" alt=""></td>';
											echo '<td class="details">';
											echo 	'<a href="#">' . $pecah['nama_barang'] . '</a>';
											if ($hitungBarang > 0) {
												echo 	'<p>Stok barang tidak cukup, hanya tersedia ' . $pecah['stok_barang'] . '</p>';
											}
											echo '</td>';
											echo '<td class="price text-center" id="hargabarang-' . $id_barang . '" value="' . $pecah['harga_barang'] . '"><strong>' . rupiah($pecah['harga_barang']) . '</strong></td>';
											echo '<td class="qty text-center"><input class="input" type="number" id="qty-' . $id_barang . '" oninput="update(this)" name="' . $pecah['id_barang'] . '" value="' . $jumlah . '" max="' . $pecah['stok_barang'] . '"></td>';
											echo '<td class="total text-center" ><strong class="primary-color" value="' . $totalHarga . '" id="showqty-' . $id_barang . '">' . rupiah($totalHarga) . '</strong></td>';
											echo '<td class="text-center"><a href="cartUpdate.php?hapuscart=' . $id_barang . '&return_url=' . $current_url . '"><i class="fa fa-close fa-lg"></i></a></td>';
											echo '</tr>';
										}
									} else if (isset($_SESSION['id_login'])) {
										$ambilCart = $koneksi->query("SELECT * FROM tbl_cart WHERE id_user='" . $_SESSION['id_login'] . "'") or die("Last error: {$koneksi->error}\n");
										$rowcountCart = mysqli_num_rows($ambilCart);
										if ($rowcountCart > 0) {
											while ($pecahCart = $ambilCart->fetch_array()) {
												$ambilBarang = $koneksi->query("SELECT * FROM tbl_barang WHERE id_barang='" . $pecahCart['id_barang'] . "' AND '" . $pecahCart['jumlah_cart'] . "'>stok_barang") or die("Last error1: {$koneksi->error}\n");
												$hitungBarang = mysqli_num_rows($ambilBarang);
												$ambil = $koneksi->query("SELECT * FROM tbl_barang WHERE id_barang='" . $pecahCart['id_barang'] . "'") or die("Last error: {$koneksi->error}\n");
												$pecah = $ambil->fetch_array();
												$foto_barang = explode(',', $pecah['foto_barang']);
												$totalBarang = $totalBarang + $pecahCart["jumlah_cart"];
												$totalHarga = $pecah['harga_barang'] * $pecahCart["jumlah_cart"];
												$subTotal = $subTotal + $totalHarga;
												echo '<tr>';
												echo '<td class="thumb"><img src="./img/' . $foto_barang[0] . '" alt=""></td>';
												echo '<td class="details">';
												echo 	'<a href="#">' . $pecah['nama_barang'] . '</a>';
												if ($hitungBarang > 0) {
													echo 	'<p>Stok barang tidak cukup, hanya tersedia ' . $pecah['stok_barang'] . '</p>';
												}
												echo '</td>';
												echo '<td class="price text-center" id="hargabarang-' . $pecahCart["id_barang"] . '" value="' . $pecah['harga_barang'] . '"><strong>' . rupiah($pecah['harga_barang']) . '</strong></td>';
												echo '<td class="qty text-center"><input class="input" id="qty-' . $pecahCart["id_barang"] . '" oninput="update(this)" name="' . $pecahCart['id_barang'] . '" type="number" value="' . $pecahCart["jumlah_cart"] . '" max="' . $pecah['stok_barang'] . '"></td>';
												echo '<td class="total text-center" ><strong class="primary-color" value="' . $totalHarga . '" class="eachsubtotal" id="showqty-' . $pecahCart["id_barang"] . '">' . rupiah($totalHarga) . '</strong></td>';
												echo '<td class="text-center"><a href="cartUpdate.php?hapuscart=' . $pecahCart["id_barang"] . '&return_url=' . $current_url . '"><i class="fa fa-close fa-lg"></i></a></td>';
												echo '</tr>';
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
										<th colspan="2" class="sub-total" id="sub-total" name="<?php echo $subTotal ?>"><?php echo rupiah($subTotal) ?></th>
									</tr>
									<tr>
										<th>DURASI PEMINJAMAN</th>
										<th class="detail-checkout" colspan="2">
											<input class="input" id="durasipinjam" onkeyup="compute();" name="durasi_pinjam" type="number" maxlength="3">
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
										<th colspan="2" id="total-harga" class="total"><?php echo rupiah($subTotal) ?></th>
									</tr>
								</tfoot>
							</table>
							<input type="hidden" id="subTotal" name="subTotal" value="<?php echo $subTotal ?>">
							<input type="hidden" name="return_url" value="<?php echo $current_url ?>">
							<div class="pull-right">
								<button class="primary-btn" name="submit">Pesan Sekarang</button>
								<!-- <button type="submit" id="simpan" class="btn btn-success float-right">Simpan</button> -->
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
	<script src="./admin/plugins/sweetalert2/sweetalert2.min.js"></script>
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
			var a = 0;
			var b = 0;
			var id = $(e).attr('name');
			var hargabarang = parseInt($("#hargabarang-" + id).attr("value"));
			var oldtotals = parseInt($("#showqty-" + id).attr("value"));
			var jumlahcart = $(e).val();
			var totals = jumlahcart * hargabarang;
			$.ajax({
				url: "checkoutAction.php",
				type: "POST",
				data: {
					action: "jumlahcart",
					id: id,
					jumlahcart: jumlahcart,
				},
				success: function(data) {
					response = jQuery.parseJSON(data);
					// console.log(response);
					if (response.status == true) {
						$("#jumlahcart").focus();
						$("#showqty-" + id).attr("value", totals);
						$("#showqty-" + id).text('Rp ' + rupiah(totals));
						a = parseInt($("#sub-total").attr('name'));
						// console.log(oldtotals);
						// console.log(totals);
						// console.log(a);
						if (a > oldtotals) {
							var newtotals = a - oldtotals;
						} else {
							var newtotals = oldtotals - a;
						}
						// if (a > totals) {
						// 	var subtotal = a - oldtotals + totals;
						// } else {
						// 	var subtotal = totals - oldtotals + a;
						// }
						subtotal = a - oldtotals + totals;
						total = 0;
						// alert(a +'-'+ oldtotals +'+'+ totals +'='+ subtotal);
						$("#sub-total").attr('name', subtotal);
						$("#subTotal").val(subtotal);
						$('#sub-total').text('Rp ' + rupiah(subtotal));
						$('#total-harga').text('Rp ' + rupiah(subtotal));
						var dur = parseInt($('input[name=durasi_pinjam]').val());
						// alert(dur);
						if (!isNaN(dur)){
							$newtotal = dur*subtotal;
							$('#total-harga').text('Rp ' + rupiah($newtotal));
						}
						// location.reload();
					} else {
						if (response.stok <= jumlahcart) {
							alert("Stok tidak mencukupi, hanya ada " + response.stok + " stok barang");
						} else {
							alert("Sepertinya ada yang salah atau stok tidak mencukupi");
						}
						location.reload();
					}
				}
			});
		}



		$('#simpan').on('click', function() {
			var return_url = $("input[name='return_url']").val();
			var tanggal_pinjam = $("input[name='tanggal_pinjam']").val();
			var durasi_pinjam = $("input[name='durasi_pinjam']").val();
			var metode_pembayaran = $("input[name='metode_pembayaran']").val();
			var subTotal = $("input[name='subTotal']").val();
			// alert(email_user+alamat_user+nama_user+id_user);
			$.ajax({
				url: "checkoutAction.php",
				type: "POST",
				data: {
					simpan: "yes",
					return_url: return_url,
					tanggal_pinjam: tanggal_pinjam,
					durasi_pinjam: durasi_pinjam,
					metode_pembayaran: metode_pembayaran,
					subTotal: subTotal
				},
				dataType: "json",
				success: function(data) {
					// data = jQuery.parseJSON(data);
					// alert(content);
					if (data.status == "sukses") {
						Swal.fire(
							'Sukses!',
							'Data berhasil diperbarui',
							'success'
						).then((result) => {
							if (result.value) {
								location.reload();
							}
						})
					} else {
						if (data.ket == "stok") {
							Swal.fire(
								'Ada barang yang kosong di tanggal tersebut!',
								data.barang.nama + ' Belum tersedia',
								'error'
							)
						} else {
							Swal.fire({
								icon: 'error',
								title: 'Oops...',
								text: 'Sepertinya anda memasukkan data yang salah.',
								// footer: '<a href>Why do I have this issue?</a>'
							})
						}
					}
				}
			});
		});
		// })
	</script>

</body>

</html>