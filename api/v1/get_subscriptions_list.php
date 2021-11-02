<?php
// Created by: Yacine Ait Chalal -> 18/08/2017
// 
header('Content-Type: application/json');

define("DIR_ROOT", "../../");

require DIR_ROOT.'includes/All_files.php';

// security
require 'verif_user.php';


$mode            = isset($_REQUEST['mode']) ? clean_var($_REQUEST['mode']) : '';
$subscription_id = isset($_REQUEST['subscription_id']) ? clean_var($_REQUEST['subscription_id']) : '';



$array_reponse = array('success'=>'yes' );


// $info_user = select_info($user_id, $post);

if( $mode == "single" && $subscription_id != "") {
    $subscriptions = select_products($user_id, 1, $subscription_id, true);
}else{
    $subscriptions = select_products($user_id, 1);
}


$array_reponse["subscriptions"] = $subscriptions;

echo json_encode($array_reponse);
