<?php

define("DIR_ROOT", "../../");
require DIR_ROOT."includes/class/phpqrcode/qrlib.php";

require DIR_ROOT.'includes/All_files.php';


// security
// include('verif_csrf_token.php');
//require 'verif_user.php';


if(isset($_GET["qr_type"]) && $_GET["qr_type"] == "identity") {
    $array_imp =db_rows(
        "SELECT * FROM `{$data['DbPrefix']}members`".
        "WHERE `id`={$user_id}"
    );

    $qr_str = $array_imp[0]['mem_id'];

}elseif(isset($_GET["qr_type"]) && $_GET["qr_type"] == "order") {
    $qr_str = clean_var($_GET['trx_id']);
}


if(isset($qr_str)){
    QRcode::png($qr_str, false, 20, 10, false);
}


