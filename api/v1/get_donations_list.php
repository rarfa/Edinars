<?php
// Created by: Yacine Ait Chalal -> 12/07/2017
// 
header('Content-Type: application/json');

define("DIR_ROOT", "../../");

require DIR_ROOT.'includes/All_files.php';

// security
require 'verif_user.php';

$mode = !empty($_GET['mode'])? clean_var($_GET['mode']):clean_var($_POST['mode']);
$donation_id = !empty($_GET['donation_id'])? clean_var($_GET['donation_id']):clean_var($_POST['donation_id']);

$array_reponse = array('success'=>'yes' );


if($mode=="single" && $donation_id!="") {
    $donations = select_products($user_id, 2, $donation_id, true);
}else{
    $donations = select_products($user_id, 2);
}


$array_reponse["donations"] = $donations;

// var_dump($donations);

echo json_encode($array_reponse);
