<?php
// Created by: Yacine Ait Chalal -> 12/07/2017
#############################################################
header('Content-Type: application/json');

define("DIR_ROOT", "../../");

include(DIR_ROOT.'includes/All_files.php');

// security
include('verif_user.php');


$mode = !empty($_GET['mode'])? clean_var($_GET['mode']):clean_var($_POST['mode']);
$product_id = !empty($_GET['product_id'])? clean_var($_GET['product_id']):clean_var($_POST['product_id']);



$array_reponse = array('success'=>'yes' );



// $info_user = select_info($user_id, $post);

if($mode=="single" && $product_id!=""){
  $products = select_products($user_id, 0, $product_id, true);
}else{
  $products = select_products($user_id, 0);
}


$array_reponse["products"] = $products;

// var_dump($products);

echo json_encode ($array_reponse);

?>
