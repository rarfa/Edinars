<?php
// Created by: Yacine Ait Chalal -> 12/07/2017
// 
// header('Content-Type: application/json');

define("DIR_ROOT", "../../");

require DIR_ROOT.'includes/All_files.php';

// security
require 'verif_user.php';


// types
$array_reponse['voucher_types'] = get_voucher_types();

// offers
$array_reponse['offers'] = get_voucher_offers(); 


// Success
$array_reponse['success'] = "yes";


// var_dump($products);

echo json_encode($array_reponse);