<?php
// Created by: Yacine Ait Chalal -> 12/07/2017
#############################################################
// header('Content-Type: application/json');

define("DIR_ROOT", "../../");

include(DIR_ROOT.'includes/All_files.php');

// security
//include('verif_user.php');


$offers_array = get_mobile_recharge_offers();
// $array_reponse['offers_array'] = $offers_array;

//group By inital
foreach ($offers_array as $key => $value) {
  $offers[$offers_array[$key]['initial']][] = $offers_array[$key];
}

$array_reponse['offers'] = $offers;

// Success
$array_reponse['success'] = "yes";


// var_dump($products);

echo json_encode ($array_reponse);

?>
