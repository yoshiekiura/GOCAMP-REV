<?php
include('./session.php');
include('../config/koneksi.php');
$output = '';
if (isset($_POST["export"]) && isset($_POST["start"]) && isset($_POST["end"])) {
    $start = $_POST["start"];
    $end = $_POST["end"];
    $query = $koneksi->query("SELECT * FROM tbl_peminjaman JOIN tbl_user ON tbl_peminjaman.id_user=tbl_user.id_user WHERE tgl_booking<'$end'");

    if ($query->num_rows > 0) {
        $output .= '
   <table class="table" bordered="0">  
                    <tr>  
                         <th>Kode</th>  
                         <th>Nama Pelanggan</th>  
                         <th>Tgl Booking</th>  
       <th>Status</th>
       <th>Total</th>
                    </tr>
  ';
        while ($row = $query->fetch_array()) {
            $output .= '
    <tr>  
                         <td>' . $row["id_peminjaman"] . '</td>  
                         <td>' . $row["nama_user"] . '</td>  
                         <td>' . $row["tgl_booking"] . '</td>  
       <td>' . $row["status_peminjaman"] . '</td>  
       <td>' . $row["total_harga"] . '</td>
                    </tr>
   ';
        }
        $output .= '</table>';
        $response = array(
            'status' => true,
            'html' => $output
        );

        header('Content-type: application/json');

        // and in the end you respond back to javascript the file location
        echo json_encode($response);
    }
}
