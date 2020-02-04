<?php
include('./session.php');
include('../config/koneksi.php');
//include merupan perintah untuk menyisipkanfile php ke dalam file php yang lainnya
// $id_lapak= $_POST['d_lapak_laundry'];
if (isset($_POST['submit'])) {
    $id_kategoriBarang = $_POST['kategoriBarang'];
    $nama_barang = $_POST['namaBarang'];
    $deskripsi_barang = $_POST['deskripsiBarang'];
    $harga_barang = $_POST['hargaBarang'];
    $stok_barang = $_POST['stokBarang'];

    $limit = 10 * 1024 * 1024; //10MB. Bisa diubah2
    $gambar = array();
    if (isset($_FILES['fotoBarang'])) {
        //karena ada multiple, jadi dilakukan pengecekan foreach
        $jumlahFile = count($_FILES['fotoBarang']['name']);
        for ($i = 0; $i < $jumlahFile; $i++) {
            $namafile = $_FILES['fotoBarang']['name'][$i];
            $tmp = $_FILES['fotoBarang']['tmp_name'][$i];
            $type = $_FILES['fotoBarang']['type'][$i];
            $error = $_FILES['fotoBarang']['error'][$i];
            $size = $_FILES['fotoBarang']['size'][$i];

            //lakukan pengecekan disini
            if ($size > $limit) {
                $_SESSION['error'] = 'Ukuran gambar yang diupload melebihi yang diizinkan';
                header("location: tambah-barang.php?status=filesize");
                exit();
            }

            if ($error > 0) {
                $_SESSION['error'] = 'Upload gagal (' . $error . ')';
                header("location: tambah-barang.php?status=gagal");
                exit();
            }


            //kalau pengecekan sudah selesai, langsung proses
            move_uploaded_file($tmp, '../img/' . $namafile);
            if ($i == $jumlahFile - 1) {
                array_push($gambar, $namafile);
            } else {
                array_push($gambar, $namafile);
            }
        }
    }
    $hitungGambar = count(array_filter($gambar, function ($x) {
        return !empty($x);
    }));
    if ($hitungGambar > 0 && $hitungGambar< 5) {
        $ambil = $koneksi->query("SELECT id_kategoriBarang FROM tbl_kategoriBarang WHERE nama_kategoriBarang='$id_kategoriBarang'");
        $pecah = $ambil->fetch_array();
        $id_kategoriBarang = $pecah['id_kategoriBarang'];
        $ambil = $koneksi->query("SELECT id_barang FROM tbl_barang ORDER BY id_barang DESC LIMIT 1");
        $pecah = $ambil->fetch_array();
        if (empty($pecah)) {
            $idBarang = "BRG001";
        } else {
            $pre_idBarang = $pecah['id_barang'];
            $num_pre_idBarang = substr($pre_idBarang, 3);
            $input = (int) $num_pre_idBarang + 1;
            $idBarang = str_pad($input, 6, "BRG001", STR_PAD_LEFT);
        }
        $gambar  = implode(",", $gambar);
        // var_dump($gambar); 
        $query = $koneksi->query("INSERT INTO tbl_barang(id_barang, id_kategoriBarang, nama_barang, deskripsi_barang, harga_barang, stok_barang, foto_barang) VALUES('$idBarang','$id_kategoriBarang','$nama_barang','$deskripsi_barang','$harga_barang','$stok_barang','$gambar' )") or die("Last error: {$koneksi->error}\n");
        if ($query) {
            header("location: tambah-barang.php?status=berhasil");
        } else {
            header("location: tambah-barang.php?status=gagal");
        }
    }else{
        header("location: tambah-barang.php?status=gambar");
    }
    //kemungkinan nyampe kesini cuma kalau user ga upload apa2
    // $_SESSION['error'] = 'Silakan upload gambar yang diinginkan';
    // header('location: tambah-barang.php');
    // $foto = $_POST['foto'];
    // if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
    //     if ($ukuran < 104407000) {
    //         move_uploaded_file($file_tmp, '../img/' . $nama_file);
    //         $ambil = $koneksi->query("SELECT id_kategoriBarang FROM tbl_kategoriBarang WHERE nama_kategoriBarang='$id_kategoriBarang'");
    //         $pecah = $ambil->fetch_array();
    //         $id_kategoriBarang = $pecah['id_kategoriBarang'];
    //         $ambil = $koneksi->query("SELECT id_barang FROM tbl_barang ORDER BY id_barang DESC LIMIT 1");
    //         $pecah = $ambil->fetch_array();
    //         if (empty($pecah)) {
    //             $idBarang = "BRG001";
    //         } else {
    //             $pre_idBarang = $pecah['id_barang'];
    //             $num_pre_idBarang = substr($pre_idBarang, 3);
    //             $input = (int) $num_pre_idBarang + 1;
    //             $idBarang = str_pad($input, 6, "BRG001", STR_PAD_LEFT);
    //         }
    //         $query = $koneksi->query("INSERT INTO tbl_barang(id_barang, id_kategoriBarang, nama_barang, deskripsi_barang, harga_barang, stok_barang, foto_barang) VALUES('$idBarang','$id_kategoriBarang','$nama_barang','$deskripsi_barang','$harga_barang','$stok_barang','$nama_file' )") or die("Last error: {$koneksi->error}\n");
    //         // echo "INSERT INTO registrasi_laundry(username, Nama_lapak, Alamat, Kategori, No_Tlp, Email, foto, deskripsi, password)  VALUES('$username','$Nama_lapak','$Alamat','$Kategori','$No_Tlp','$email','$nama_file', '$deskripsi','$password','$nama_file')";
    //         if ($query) {
    //             header("location: tambah-barang.php?status=berhasil");
    //         } else {
    //             header("location: tambah-barang.php?status=gagal");
    //         }
    //     } else {
    //         header("location: tambah-barang.php?status=filesize");
    //     }
    // } else {
    //     header("location: tambah-barang.php?status=ekstensi");
    // }
} else {
    header("location: index.php?page=gagal");
}

 //query mysql untuk menjalankan perintah pada mysql (untuk menampilkan data pada tabel user variabel)

//  header("location:index.php?pesan=input"); //untuk mengalihkan halaman
