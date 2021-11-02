<?php
// Created by: Yacine Ait Chalal -> 12/07/2017
// 
header('Content-Type: application/json');

define("DIR_ROOT", "../../");

require DIR_ROOT.'includes/All_files.php';

// security
require 'verif_user.php';


$mode       = isset($_REQUEST['mode'])          ? clean_var($_REQUEST['mode']) : '';
$product_id = isset($_REQUEST['product_id'])    ? clean_var($_REQUEST['product_id']) : '';


$array_reponse = array('success'=>'yes' );


if($mode == "single" && $product_id != "") {
    $products = select_products($user_id, 0, $product_id, true);
}else{
    $products = select_products($user_id, 0);
}


$array_reponse["products"] = $products;

echo json_encode($array_reponse);
