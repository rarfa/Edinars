<?php
// Created by: Yacine Ait Chalal -> 12/07/2017
//
header('Content-Type: application/json');

define("DIR_ROOT", "../../");

require DIR_ROOT . 'includes/All_files.php';

// security
require 'verif_user.php';

$mode        = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : '';
$donation_id = isset($_REQUEST['donation_id']) ? $_REQUEST['donation_id'] : '';

$array_reponse = array('success'=>'yes' );


if($mode=="single" && $donation_id!="") {
    $donations = select_products($user_id, 2, $donation_id, true);
}else{
    $donations = select_products($user_id, 2);
}


$array_reponse["donations"] = $donations;

// var_dump($donations);

echo json_encode($array_reponse);
