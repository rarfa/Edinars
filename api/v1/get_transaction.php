<?php
header('Content-Type: application/json');

define("DIR_ROOT", "../../");

require DIR_ROOT.'includes/All_files.php';

// security
require 'verif_user.php';
// include('verif_csrf_token.php');

$array_reponse = array( 'success'=>'yes', 'success_viewed' => 'yes' );

$transaction_id = isset($_REQUEST['transaction_id']) ? clean_var($_REQUEST['transaction_id']) : '';

$transaction = get_transaction_by_id($user_id, $transaction_id);

if($transaction['id']) {
    $array_reponse['transaction'] = $transaction;

    //set_notification_viewed
    $viewed = set_notification_viewed($user_id, "", $transaction_id);
    if(!$viewed) {
        $array_reponse['success_viewed'] = "no";
    }

}else{
    $array_reponse['success'] = 'no';
}

echo json_encode($array_reponse);