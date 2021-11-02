<?php
// Created by: Yacine Ait Chalal -> 18/08/2017
// 
header('Content-Type: application/json');

define("DIR_ROOT", "../../");

require DIR_ROOT.'includes/All_files.php';

// security
require 'verif_user.php';

$mode = isset($_REQUEST['mode']) ? clean_var($_REQUEST['mode']) : '';

$array_reponse = array('success'=>'yes' );


$subscribers = select_subscriptions($user_id);


$array_reponse["subscribers"] = $subscribers;

// var_dump($subscribers);

echo json_encode($array_reponse);
