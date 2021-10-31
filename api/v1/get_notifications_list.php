<?php
// Created by: Yacine Ait Chalal -> 12/07/2017
// 
header('Content-Type: application/json');

define("DIR_ROOT", "../../");

require DIR_ROOT.'includes/All_files.php';

// security
require 'verif_user.php';

$user_notifications = get_user_notifications($user_id);

$array_reponse = array( 'notifications' => $user_notifications,
                        'success'=>'yes' );


echo json_encode($array_reponse);
