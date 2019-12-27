<?php
require('ovo.php');

$p = new Ovo;
$jenistransfer = $_GET['jenistransfer'];
$ovotujuan = $_GET['ovotujuan'];
$jumlahtransfer = $_GET['jumlahtransfer'];
$pesantransfer = $_GET['pesantransfer'];

$postdata2 = ["totalAmount" => trim($jumlahtransfer), "mobile" => trim($ovotujuan)];

$trx = $p->trf_to_ovo($postdata2);
if (isset($trx->status)) {
    exit(header("location: movo.php?status=gagal"));
} else {
    $array = array(
        'fullName' => $trx->fullName,
        'nickName' => $trx->nickName,
        'mobile' => $trx->mobile,
    );
    echo json_encode($array);
}
