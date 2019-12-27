<?php
include('./session.php');
require('ovo.php');

$p = new Ovo;
if (!empty($_POST['jenistransfer']) && $_POST['jenistransfer'] == "bank" && !empty($_POST['banktujuan']) && !empty($_POST['rekeningtujuan']) && !empty($_POST['jumlahtransfer']) && !empty($_POST['pesantransfer'])) {
    $jenistransfer = $_POST['jenistransfer'];
    $bankcode = $_POST['bankcode'];
    $banktujuan = $_POST['banktujuan'];
    $rekeningtujuan = $_POST['rekeningtujuan'];
    $jumlahtransfer = $_POST['jumlahtransfer'];
    $pesantransfer = $_POST['pesantransfer'];
    $bankconfirm = @$_POST['bankconfirm'];

    $postdata1 = [
        "accountNo" => trim($rekeningtujuan),
        "amount" => trim($jumlahtransfer),
        "bankCode" => trim($bankcode),
        "bankName" => trim($banktujuan),
        "message" => trim($pesantransfer)
    ];
    $trx = $p->trf_to_bank($postdata1);
    if (!isset($_POST['bankconfirm'])) {
        // exit(header("location: movo.php?status=gagal"));
        echo json_encode($trx);
    } else {
        if ($_POST['bankconfirm'] != "yes") {
            $array = array(
                'bankName' => $trx->bankName,
                'accountName' => $trx->accountName,
                'rekening' => $trx->accountNo,
                'jumlah' => $trx->amount,
                'fee' => $trx->adminFee
            );
            echo json_encode($array);
        } else {
            $jml = ["jenis" => "trf_other_bank", "amount" => $postdata1["amount"]];
            $trxid = $p->get_trxid($jml)->trxId;
            $account = convert_to_array($p->get_info_account()->data);
            $param = [
                "accountName" => trim($trx->accountName),
                "accountNo" => $account['001']['card_no'],
                "accountNoDestination" => trim($rekeningtujuan),
                "amount" => trim($jumlahtransfer),
                "bankCode" => trim($bankcode),
                "bankName" => trim($banktujuan),
                "message" => trim($pesantransfer),
                "notes" => trim($pesantransfer),
                "transactionId" => $trxid
            ];
            $result = $p->direct_tf_bank($param);
            // $arr['status'] = true;
            // if ($result->status == "SUCCESS") {
            //     $arr['status'] = true;
            // } else {
            //     $arr['status'] = false;
            // }
            echo json_encode($result);
        }
    }
} else if (!empty($_POST['jenistransfer']) && $_POST['jenistransfer'] == "ovo" && !empty($_POST['ovotujuan']) && !empty($_POST['jumlahtransfer']) && !empty($_POST['pesantransfer'])) {
    $jenistransfer = $_POST['jenistransfer'];
    $ovotujuan = $_POST['ovotujuan'];
    $jumlahtransfer = $_POST['jumlahtransfer'];
    $pesantransfer = $_POST['pesantransfer'];

    $postdata2 = ["totalAmount" => trim($jumlahtransfer), "mobile" => trim($ovotujuan)];

    $trx = $p->trf_to_ovo($postdata2);
    if (isset($trx->status)) {
        exit(header("location: movo.php?status=gagal"));
    } else {
        if (empty($_POST['ovoconfirm'])) {
            $array = array(
                'fullName' => $trx->fullName,
                'nickName' => $trx->nickName,
                'mobile' => $trx->mobile,
            );
            echo json_encode($array);
        } else {
            $jml = ["jenis" => "trf_ovo", "amount" => $postdata2["totalAmount"]];
            $trxid = $p->get_trxid($jml)->trxId;
            $param = [
                "amount" => trim($jumlahtransfer),
                "message" => trim($pesantransfer),
                "to" => trim($ovotujuan),
                "trxId" => $trxid
            ];
            $result = $p->direct_tf_ovo($param);
            if ($result->message == "Transfer Success") {
                $arr['status'] = true;
            } else {
                $arr['status'] = false;
            }
            echo json_encode($arr);
        }
    }
}
