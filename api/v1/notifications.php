<?php
// by: Yacine Ait Chalal -> 26/09/2017
// 
header('Content-Type: application/json');


define("DIR_ROOT", "../../");

require DIR_ROOT.'includes/All_files.php';


// security
require 'verif_user.php';

$user_notifications = get_user_notifications($user_id, "no");

$array_reponse = array( 'notifications' => $user_notifications,
                        'success'=>'yes' );

echo json_encode($array_reponse);
